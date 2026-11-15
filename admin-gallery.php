<?php
error_reporting(E_ALL & ~E_DEPRECATED & ~E_NOTICE);
@ini_set('display_errors', '0');

session_start();
if (!isset($_SESSION['user'])) {
    header("Location: index.php?error=" . urlencode("Please login as Admin first"));
    exit();
}

require_once('connection.php');
require_once('gallery_helper.php');

$logged_user = htmlspecialchars($_SESSION['user']);
ensureGalleryTable($con);

$upload_dir = __DIR__ . '/upload/gallery';
if (!is_dir($upload_dir)) {
    @mkdir($upload_dir, 0775, true);
}

// Helper to process and optimize uploaded image (supports both $_FILES and base64 fallback for >2MB files)
function saveUploadedGalleryImage($file, $base64_data = '', $prefix = 'gallery_', $target_w = 960, $target_h = 720) {
    $src = null;

    // 1. Try Base64 client-compressed data first if available (prevents >2MB PHP upload_max_filesize errors)
    if (!empty($base64_data) && strpos($base64_data, 'data:image/') === 0) {
        $parts = explode(',', $base64_data, 2);
        if (count($parts) === 2) {
            $raw = base64_decode($parts[1]);
            if ($raw !== false) {
                $src = @imagecreatefromstring($raw);
            }
        }
    }

    // 2. Otherwise try standard $_FILES upload
    if (!$src && isset($file) && isset($file['error']) && $file['error'] === UPLOAD_ERR_OK && !empty($file['tmp_name'])) {
        $tmp = $file['tmp_name'];
        $raw = @file_get_contents($tmp);
        if ($raw !== false) {
            $src = @imagecreatefromstring($raw);
        }
    }

    if (!$src) {
        return false;
    }

    $filename = $prefix . time() . '_' . mt_rand(100, 999) . '.jpg';
    $rel_path = 'upload/gallery/' . $filename;
    $abs_path = __DIR__ . '/' . $rel_path;

    $src_w = imagesx($src);
    $src_h = imagesy($src);

    // Center-crop to target aspect ratio
    $src_ratio = $src_w / $src_h;
    $dst_ratio = $target_w / $target_h;

    if ($src_ratio > $dst_ratio) {
        $new_h = $src_h;
        $new_w = intval($src_h * $dst_ratio);
        $src_x = intval(($src_w - $new_w) / 2);
        $src_y = 0;
    } else {
        $new_w = $src_w;
        $new_h = intval($src_w / $dst_ratio);
        $src_x = 0;
        $src_y = intval(($src_h - $new_h) / 2);
    }

    $dst = imagecreatetruecolor($target_w, $target_h);
    $white = imagecolorallocate($dst, 255, 255, 255);
    imagefill($dst, 0, 0, $white);
    imagecopyresampled($dst, $src, 0, 0, $src_x, $src_y, $target_w, $target_h, $new_w, $new_h);
    imagejpeg($dst, $abs_path, 90);

    return file_exists($abs_path) ? $rel_path : false;
}

// Handle POST Actions with Post-Redirect-Get (PRG) pattern
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $action = $_POST['action'];
    $now = time();

    if ($action === 'replace_slot') {
        $slot_id = intval($_POST['slot_id'] ?? 0);
        $title_en = trim($_POST['title_en'] ?? 'SCAIT Computer Lab');
        $title_hi = trim($_POST['title_hi'] ?? 'कंप्यूटर लैब व प्रैक्टिकल क्लास');
        $b64 = $_POST['photo_base64'] ?? '';

        if ($slot_id > 0) {
            $has_file = (!empty($b64)) || (isset($_FILES['photo']) && $_FILES['photo']['error'] !== UPLOAD_ERR_NO_FILE);
            if ($has_file) {
                $saved = saveUploadedGalleryImage($_FILES['photo'] ?? null, $b64, 'campus_' . $slot_id . '_', 960, 720);
                if ($saved) {
                    $stmt = mysqli_prepare($con, "UPDATE site_gallery SET title_en = ?, title_hi = ?, image_path = ?, updated_at = ? WHERE id = ?");
                    mysqli_stmt_bind_param($stmt, "sssii", $title_en, $title_hi, $saved, $now, $slot_id);
                    mysqli_stmt_execute($stmt);
                    header("Location: admin-gallery.php?status=slot_updated");
                    exit();
                } else {
                    header("Location: admin-gallery.php?status=invalid_img");
                    exit();
                }
            } else {
                $stmt = mysqli_prepare($con, "UPDATE site_gallery SET title_en = ?, title_hi = ?, updated_at = ? WHERE id = ?");
                mysqli_stmt_bind_param($stmt, "ssii", $title_en, $title_hi, $now, $slot_id);
                mysqli_stmt_execute($stmt);
                header("Location: admin-gallery.php?status=caption_updated");
                exit();
            }
        }
    } elseif ($action === 'add_new') {
        $title_en = trim($_POST['title_en'] ?? 'SCAIT Computer Lab');
        $title_hi = trim($_POST['title_hi'] ?? '');
        if ($title_hi === '') $title_hi = $title_en;
        $b64 = $_POST['photo_base64'] ?? '';

        $saved = saveUploadedGalleryImage($_FILES['photo'] ?? null, $b64, 'campus_new_', 960, 720);
        if ($saved) {
            $max_res = mysqli_query($con, "SELECT COALESCE(MAX(sort_order), 0) + 1 AS next_sort FROM site_gallery WHERE slot_type = 'gallery'");
            $next_sort = $max_res ? intval(mysqli_fetch_assoc($max_res)['next_sort']) : 7;
            $stmt = mysqli_prepare($con, "INSERT INTO site_gallery (slot_type, title_en, title_hi, image_path, sort_order, updated_at) VALUES ('gallery', ?, ?, ?, ?, ?)");
            mysqli_stmt_bind_param($stmt, "sssii", $title_en, $title_hi, $saved, $next_sort, $now);
            mysqli_stmt_execute($stmt);
            header("Location: admin-gallery.php?status=added");
            exit();
        } else {
            header("Location: admin-gallery.php?status=invalid_img");
            exit();
        }
    } elseif ($action === 'update_director') {
        $b64 = $_POST['photo_base64'] ?? '';
        $saved = saveUploadedGalleryImage($_FILES['director_photo'] ?? null, $b64, 'director_', 400, 400);
        if ($saved) {
            mysqli_query($con, "DELETE FROM site_gallery WHERE slot_type = 'director'");
            $stmt = mysqli_prepare($con, "INSERT INTO site_gallery (slot_type, title_en, title_hi, image_path, sort_order, updated_at) VALUES ('director', 'Atul Tiwari (Director)', 'अतुल तिवारी (निदेशक)', ?, 1, ?)");
            mysqli_stmt_bind_param($stmt, "si", $saved, $now);
            mysqli_stmt_execute($stmt);
            header("Location: admin-gallery.php?status=director_updated");
            exit();
        } else {
            header("Location: admin-gallery.php?status=invalid_img");
            exit();
        }
    } elseif ($action === 'remove_director') {
        mysqli_query($con, "DELETE FROM site_gallery WHERE slot_type = 'director'");
        header("Location: admin-gallery.php?status=director_reset");
        exit();
    }
}

// Handle GET Delete
if (isset($_GET['del_id'])) {
    $del_id = intval($_GET['del_id']);
    $stmt = mysqli_prepare($con, "DELETE FROM site_gallery WHERE id = ? AND slot_type = 'gallery'");
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $del_id);
        mysqli_stmt_execute($stmt);
    }
    header("Location: admin-gallery.php?status=deleted");
    exit();
}

// Status Feedback Messages
$msg = '';
$msg_hi = '';
$msg_type = 'success';

if (isset($_GET['status'])) {
    switch ($_GET['status']) {
        case 'slot_updated':
            $msg = 'Homepage photo and caption updated successfully!';
            $msg_hi = 'होमपेज फोटो और कैप्शन सफलतापूर्वक अपडेट हो गया है!';
            break;
        case 'caption_updated':
            $msg = 'Photo caption updated successfully!';
            $msg_hi = 'फोटो कैप्शन सफलतापूर्वक अपडेट हो गया है!';
            break;
        case 'added':
            $msg = 'New photo added to the Homepage Gallery!';
            $msg_hi = 'होमपेज गैलरी में नई फोटो सफलतापूर्वक जोड़ दी गई है!';
            break;
        case 'director_updated':
            $msg = 'Director profile photo updated on Homepage!';
            $msg_hi = 'निदेशक (Director) की फोटो होमपेज पर अपडेट हो गई है!';
            break;
        case 'director_reset':
            $msg = 'Director photo reset to default badge.';
            $msg_hi = 'निदेशक की फोटो डिफ़ॉल्ट अवतार पर रीसेट कर दी गई है।';
            break;
        case 'deleted':
            $msg = 'Gallery photo removed from Homepage.';
            $msg_hi = 'होमपेज से फोटो हटा दी गई है।';
            break;
        case 'invalid_img':
            $msg = 'Could not process image. Please select a valid JPG, PNG, or WEBP photo.';
            $msg_hi = 'फोटो अपलोड नहीं हो सकी। कृपया सही JPG, PNG या WEBP फोटो चुनें।';
            $msg_type = 'warning';
            break;
    }
}

$gallery_photos = getHomepageGalleryPhotos($con);
$director_photo = getDirectorPhoto($con);

$inq_res = mysqli_query($con, "SELECT COUNT(*) as c FROM s_adm");
$total_inquiries = $inq_res ? mysqli_fetch_assoc($inq_res)['c'] : 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <title>Homepage Photos | SCAIT Admin Console</title>
    <link rel="shortcut icon" href="images/fav.ico" type="image/x-icon">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Outfit:wght@500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --navy: #06182e;
            --navy-dark: #040d1a;
            --orange: #f97316;
            --orange-hover: #ea580c;
            --slate-50: #f8fafc;
            --slate-100: #f1f5f9;
            --slate-200: #e2e8f0;
            --slate-300: #cbd5e1;
            --slate-400: #94a3b8;
            --slate-500: #64748b;
            --slate-600: #475569;
            --slate-700: #334155;
            --slate-800: #1e293b;
            --white: #ffffff;
            --green: #10b981;
            --radius-md: 12px;
            --radius-lg: 16px;
            --radius-full: 9999px;
            --shadow-sm: 0 1px 3px rgba(6, 24, 46, 0.05);
            --shadow-md: 0 4px 16px rgba(6, 24, 46, 0.08);
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
            background: #f1f5f9;
            color: var(--slate-800);
            min-height: 100vh;
            display: flex;
        }

        /* ── Sidebar ── */
        .admin-sidebar {
            width: 270px;
            background: linear-gradient(180deg, #040d1a 0%, #06182e 100%);
            color: var(--white);
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            z-index: 1000;
            transition: transform 0.3s ease;
            border-right: 1px solid rgba(255, 255, 255, 0.08);
        }
        .sidebar-brand {
            padding: 24px 20px 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        }
        .sidebar-brand img { height: 38px; width: auto; }
        .sidebar-nav {
            padding: 20px 14px;
            flex: 1;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            gap: 6px;
        }
        .sidebar-heading {
            font-size: 10.5px;
            font-weight: 800;
            letter-spacing: 1.2px;
            text-transform: uppercase;
            color: rgba(255, 255, 255, 0.4);
            padding: 10px 12px 4px;
        }
        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 14px;
            border-radius: var(--radius-md);
            color: rgba(255, 255, 255, 0.72);
            text-decoration: none;
            font-size: 13.5px;
            font-weight: 600;
            transition: all 0.2s ease;
        }
        .sidebar-link:hover {
            background: rgba(255, 255, 255, 0.07);
            color: var(--white);
            transform: translateX(2px);
        }
        .sidebar-link.active {
            background: linear-gradient(90deg, rgba(249, 115, 22, 0.22) 0%, rgba(249, 115, 22, 0.08) 100%);
            color: #fdba74;
            border-left: 3px solid var(--orange);
            font-weight: 700;
        }
        .sidebar-link .icon { width: 18px; height: 18px; flex-shrink: 0; }
        .sidebar-user {
            padding: 16px 18px;
            border-top: 1px solid rgba(255, 255, 255, 0.08);
            background: rgba(4, 13, 26, 0.4);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
        }
        .user-info { display: flex; align-items: center; gap: 10px; }
        .user-avatar {
            width: 36px;
            height: 36px;
            border-radius: var(--radius-full);
            background: linear-gradient(135deg, var(--orange) 0%, #c2410c 100%);
            color: var(--white);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 14px;
        }
        .user-name { font-size: 13px; font-weight: 700; color: var(--white); }
        .user-role { font-size: 11px; color: rgba(255, 255, 255, 0.5); }
        .btn-logout-icon {
            background: rgba(255, 255, 255, 0.06);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: #f87171;
            width: 32px;
            height: 32px;
            border-radius: var(--radius-md);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
        }

        /* ── Main Area ── */
        .admin-main {
            margin-left: 270px;
            flex: 1;
            display: flex;
            flex-direction: column;
            min-width: 0;
        }
        .admin-topbar {
            height: 64px;
            background: var(--white);
            border-bottom: 1px solid var(--slate-200);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 28px;
            position: sticky;
            top: 0;
            z-index: 99;
            box-shadow: var(--shadow-sm);
        }
        .topbar-left { display: flex; align-items: center; gap: 14px; }
        .mobile-toggle { display: none; background: none; border: none; cursor: pointer; padding: 6px; color: var(--slate-700); }
        .breadcrumb-text { font-size: 13.5px; color: var(--slate-500); display: flex; align-items: center; gap: 6px; }
        .breadcrumb-text strong { color: var(--navy); font-weight: 700; }
        .topbar-right { display: flex; align-items: center; gap: 12px; }
        .lang-pill {
            display: inline-flex;
            align-items: center;
            background: var(--slate-100);
            border: 1px solid var(--slate-200);
            border-radius: 999px;
            padding: 2px;
        }
        .lang-pill button {
            background: transparent;
            border: none;
            color: var(--slate-600);
            font-size: 11.5px;
            font-weight: 700;
            padding: 4px 10px;
            border-radius: 999px;
            cursor: pointer;
            font-family: inherit;
            transition: all 0.2s ease;
        }
        .lang-pill button.active { background: var(--navy); color: var(--white); }

        .admin-content {
            padding: 28px;
            max-width: 1400px;
            width: 100%;
            margin: 0 auto;
        }

        .alert-banner {
            padding: 14px 18px;
            border-radius: var(--radius-md);
            margin-bottom: 22px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 13.5px;
            font-weight: 600;
        }
        .alert-banner.success { background: #ecfdf5; color: #065f46; border: 1px solid #a7f3d0; }
        .alert-banner.warning { background: #fffbeb; color: #b45309; border: 1px solid #fde68a; }

        /* ── Top Action Row: Add Photo + Director Photo ── */
        .top-panels-grid {
            display: grid;
            grid-template-columns: 1.4fr 1fr;
            gap: 22px;
            margin-bottom: 28px;
        }
        @media (max-width: 992px) {
            .top-panels-grid { grid-template-columns: 1fr; }
        }

        .panel-card {
            background: var(--white);
            border-radius: var(--radius-lg);
            border: 1px solid var(--slate-200);
            box-shadow: var(--shadow-sm);
            padding: 22px;
        }
        .panel-card h3 {
            font-size: 16px;
            font-weight: 800;
            color: var(--navy);
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 6px;
        }
        .panel-card p.sub {
            font-size: 12.5px;
            color: var(--slate-500);
            margin-bottom: 16px;
        }

        .form-grid-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin-bottom: 14px;
        }
        @media (max-width: 600px) {
            .form-grid-2 { grid-template-columns: 1fr; }
        }
        .form-label {
            display: block;
            font-size: 11.5px;
            font-weight: 700;
            color: var(--slate-700);
            margin-bottom: 5px;
        }
        .form-control {
            width: 100%;
            height: 38px;
            padding: 0 12px;
            border-radius: 8px;
            border: 1.5px solid var(--slate-200);
            background: var(--slate-50);
            font-size: 13px;
            font-family: inherit;
            color: var(--slate-800);
            outline: none;
        }
        .form-control:focus {
            border-color: var(--orange);
            background: var(--white);
        }

        .btn-primary {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            padding: 9px 16px;
            border-radius: 9px;
            background: linear-gradient(180deg, #fb923c 0%, #ea580c 100%);
            color: var(--white);
            font-size: 12.5px;
            font-weight: 800;
            border: none;
            cursor: pointer;
            font-family: inherit;
            text-decoration: none;
            transition: all 0.2s ease;
        }
        .btn-primary:hover { transform: translateY(-1px); box-shadow: 0 4px 12px rgba(234, 88, 12, 0.3); }

        .btn-secondary {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            padding: 8px 14px;
            border-radius: 9px;
            background: var(--slate-100);
            color: var(--slate-700);
            border: 1px solid var(--slate-200);
            font-size: 12px;
            font-weight: 700;
            cursor: pointer;
            font-family: inherit;
            text-decoration: none;
            transition: all 0.2s ease;
        }
        .btn-secondary:hover { background: var(--slate-200); color: var(--navy); }

        /* ── Gallery Slots Grid ── */
        .slots-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 22px;
        }
        .slot-card {
            background: var(--white);
            border-radius: var(--radius-lg);
            border: 1px solid var(--slate-200);
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            display: flex;
            flex-direction: column;
        }
        .slot-img-wrap {
            position: relative;
            aspect-ratio: 4 / 3;
            background: var(--slate-100);
            overflow: hidden;
            border-bottom: 1px solid var(--slate-200);
        }
        .slot-img-wrap img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }
        .slot-badge {
            position: absolute;
            top: 12px;
            left: 12px;
            background: rgba(6, 24, 46, 0.85);
            backdrop-filter: blur(6px);
            color: var(--white);
            font-size: 11px;
            font-weight: 800;
            padding: 4px 10px;
            border-radius: 999px;
        }
        .slot-delete-btn {
            position: absolute;
            top: 12px;
            right: 12px;
            width: 32px;
            height: 32px;
            border-radius: 8px;
            background: rgba(239, 68, 68, 0.9);
            color: var(--white);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            transition: all 0.2s ease;
        }
        .slot-delete-btn:hover { background: #dc2626; transform: scale(1.05); }

        .slot-body {
            padding: 16px;
            display: flex;
            flex-direction: column;
            gap: 10px;
            flex: 1;
        }

        .director-preview-row {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 14px;
            padding: 12px;
            background: var(--slate-50);
            border-radius: var(--radius-md);
            border: 1px solid var(--slate-200);
        }
        .director-avatar-img {
            width: 64px;
            height: 64px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--orange);
            flex-shrink: 0;
        }
        .director-avatar-fallback {
            width: 64px;
            height: 64px;
            border-radius: 50%;
            background: var(--navy);
            color: var(--white);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            font-weight: 800;
            flex-shrink: 0;
        }

        .drawer-overlay { display: none; position: fixed; inset: 0; background: rgba(4, 13, 26, 0.6); z-index: 999; }
        @media (max-width: 992px) {
            .admin-sidebar { transform: translateX(-100%); }
            .admin-sidebar.open { transform: translateX(0); }
            .drawer-overlay.open { display: block; }
            .admin-main { margin-left: 0; }
            .mobile-toggle { display: block; }
        }
    </style>
</head>
<body>

    <div class="drawer-overlay" id="drawerOverlay" onclick="toggleSidebar()"></div>

    <!-- ── Left Sidebar ── -->
    <aside class="admin-sidebar" id="adminSidebar">
        <div class="sidebar-brand">
            <a href="index.php" style="display:flex; align-items:center; gap:12px; text-decoration:none;">
                <img src="images/logo-light.svg" alt="SCAIT Academy" onerror="this.src='images/logo.png'">
            </a>
        </div>

        <nav class="sidebar-nav">
            <span class="sidebar-heading" data-en="Certificate Management" data-hi="सर्टिफिकेट प्रबंधन">Certificate Management</span>
            <a href="admin-user-add.php" class="sidebar-link">
                <span class="icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 5v14M5 12h14"/></svg>
                </span>
                <span data-en="Add Student Certificate" data-hi="छात्र सर्टिफिकेट जोड़ें">Add Student Certificate</span>
            </a>
            <a href="admin-user-all.php" class="sidebar-link">
                <span class="icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                </span>
                <span data-en="All Student Records" data-hi="सभी छात्र रिकॉर्ड">All Student Records</span>
            </a>

            <span class="sidebar-heading" style="margin-top:14px;" data-en="Website & Inquiries" data-hi="वेबसाइट एवं पूछताछ">Website & Inquiries</span>
            <a href="admin-gallery.php" class="sidebar-link active">
                <span class="icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                </span>
                <span data-en="Homepage Photos" data-hi="होमपेज फोटो">Homepage Photos</span>
            </a>
            <a href="admin-inquiries.php" class="sidebar-link">
                <span class="icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                </span>
                <span data-en="Admission Inquiries" data-hi="प्रवेश पूछताछ">Admission Inquiries</span>
                <span style="margin-left:auto; background:rgba(249,115,22,0.25); color:#fdba74; font-size:11px; font-weight:800; padding:2px 7px; border-radius:999px;"><?= $total_inquiries ?></span>
            </a>

            <span class="sidebar-heading" style="margin-top:14px;" data-en="Exam Portal" data-hi="परीक्षा पोर्टल">Exam Portal</span>
            <a href="add_question.php" class="sidebar-link">
                <span class="icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
                </span>
                <span data-en="Question Bank" data-hi="प्रश्न बैंक">Question Bank</span>
            </a>

            <span class="sidebar-heading" style="margin-top:14px;" data-en="Quick Actions" data-hi="त्वरित विकल्प">Quick Actions</span>
            <a href="index.php#gallery" target="_blank" class="sidebar-link">
                <span class="icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
                </span>
                <span data-en="View Public Website" data-hi="मुख्य वेबसाइट देखें">View Public Website</span>
            </a>
        </nav>

        <div class="sidebar-user">
            <div class="user-info">
                <div class="user-avatar"><?= strtoupper(substr($logged_user, 0, 1)) ?></div>
                <div>
                    <div class="user-name"><?= $logged_user ?></div>
                    <div class="user-role" data-en="Super Admin" data-hi="सुपर एडमिन">Super Admin</div>
                </div>
            </div>
            <a href="logout.php" class="btn-logout-icon" title="Logout">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
            </a>
        </div>
    </aside>

    <!-- ── Main Content ── -->
    <main class="admin-main">
        <header class="admin-topbar">
            <div class="topbar-left">
                <button class="mobile-toggle" onclick="toggleSidebar()" aria-label="Toggle Menu">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
                </button>
                <div class="breadcrumb-text">
                    <span data-en="Admin Console" data-hi="एडमिन कंसोल">Admin Console</span>
                    <span>/</span>
                    <strong data-en="Homepage Photos & Gallery" data-hi="होमपेज फोटो और गैलरी">Homepage Photos & Gallery</strong>
                </div>
            </div>
            <div class="topbar-right">
                <div class="lang-pill" aria-label="Language Switcher">
                    <button type="button" id="admLangEn" class="active" onclick="setAdminLang('en')">English</button>
                    <button type="button" id="admLangHi" onclick="setAdminLang('hi')">हिन्दी</button>
                </div>
                <a href="index.php#gallery" target="_blank" class="btn-secondary">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
                    <span data-en="Preview Homepage" data-hi="होमपेज देखें">Preview Homepage</span>
                </a>
            </div>
        </header>

        <div class="admin-content">
            <?php if ($msg !== ''): ?>
                <div class="alert-banner <?= $msg_type ?>">
                    <div style="display:flex; align-items:center; gap:10px;">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                        <span data-en="<?= htmlspecialchars($msg) ?>" data-hi="<?= htmlspecialchars($msg_hi) ?>"><?= htmlspecialchars($msg) ?></span>
                    </div>
                    <a href="index.php#gallery" target="_blank" style="color:inherit; font-weight:800; text-decoration:underline;" data-en="View Live on Homepage →" data-hi="होमपेज पर लाइव देखें →">View Live on Homepage &rarr;</a>
                </div>
            <?php endif; ?>

            <!-- Top Row: Add New Campus Photo + Director Profile Photo -->
            <div class="top-panels-grid">
                <!-- Add New Photo to Gallery -->
                <div class="panel-card">
                    <h3>
                        <svg width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="var(--orange)" stroke-width="2.4"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                        <span data-en="Add New Photo to Homepage Gallery" data-hi="होमपेज गैलरी में नई फोटो जोड़ें">Add New Photo to Homepage Gallery</span>
                    </h3>
                    <p class="sub" data-en="Upload a new classroom, computer lab, or batch photo. Automatically cropped & optimized to 4:3 HD." data-hi="कंप्यूटर लैब या छात्रों की नई फोटो अपलोड करें। यह अपने आप 4:3 HD साइज में सेट हो जाएगी।">
                        Upload a new classroom, computer lab, or batch photo. Automatically cropped & optimized to 4:3 HD.
                    </p>
                    <form method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="action" value="add_new">
                        <input type="hidden" name="photo_base64" id="addNewBase64" value="">
                        <div class="form-grid-2">
                            <div>
                                <label class="form-label" data-en="Photo Title (English)" data-hi="फोटो शीर्षक (English)">Photo Title (English)</label>
                                <input type="text" name="title_en" class="form-control" placeholder="e.g. ADCA Practical Lab" required>
                            </div>
                            <div>
                                <label class="form-label" data-en="Photo Title (Hindi - Optional)" data-hi="फोटो शीर्षक (हिन्दी)">Photo Title (Hindi - Optional)</label>
                                <input type="text" name="title_hi" class="form-control" placeholder="उदा. ADCA प्रैक्टिकल लैब">
                            </div>
                        </div>
                        <div id="addNewPreviewWrap" style="display:none; margin-bottom:12px;">
                            <img id="addNewPreviewImg" src="" alt="Preview" style="height:90px; border-radius:8px; border:1px solid var(--slate-200); object-fit:cover;">
                        </div>
                        <div style="display:flex; align-items:center; gap:12px; flex-wrap:wrap;">
                            <input type="file" name="photo" accept="image/*" class="form-control" style="flex:1; padding-top:6px;" onchange="prepareImageUpload(this, 'addNewPreviewImg', 'addNewBase64', 960, 720, 'addNewPreviewWrap')" required>
                            <button type="submit" class="btn-primary">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
                                <span data-en="Upload to Homepage" data-hi="होमपेज पर अपलोड करें">Upload to Homepage</span>
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Director Photo Card -->
                <div class="panel-card">
                    <h3>
                        <svg width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="var(--orange)" stroke-width="2.4"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                        <span data-en="Director Profile Photo (Homepage)" data-hi="निदेशक (Director) प्रोफाइल फोटो">Director Profile Photo (Homepage)</span>
                    </h3>
                    <p class="sub" data-en="Shown next to Atul Tiwari (Director) in the About section on Homepage." data-hi="होमपेज पर 'अतुल तिवारी (निदेशक)' संदेश कार्ड में दिखाई देने वाली फोटो।">
                        Shown next to Atul Tiwari (Director) in the About section on Homepage.
                    </p>

                    <div class="director-preview-row">
                        <img id="directorPreviewImg" src="<?= ($director_photo && !empty($director_photo['image_path'])) ? htmlspecialchars($director_photo['image_path'] . '?v=' . $director_photo['updated_at']) : '' ?>" alt="Director" class="director-avatar-img" style="<?= ($director_photo && !empty($director_photo['image_path'])) ? '' : 'display:none;' ?>">
                        <div id="directorFallbackAvatar" class="director-avatar-fallback" style="<?= ($director_photo && !empty($director_photo['image_path'])) ? 'display:none;' : '' ?>">A</div>
                        <div style="flex:1;">
                            <div style="font-weight:800; font-size:14px; color:var(--navy);">Atul Tiwari (Director)</div>
                            <div style="font-size:12px; color:var(--slate-500);" data-en="Square 1:1 Portrait Recommended" data-hi="चौकोर (1:1) पासपोर्ट फोटो उपयुक्त">Square 1:1 Portrait Recommended</div>
                        </div>
                        <?php if ($director_photo): ?>
                            <form method="POST" style="margin:0;">
                                <input type="hidden" name="action" value="remove_director">
                                <button type="submit" class="btn-secondary" style="color:#ef4444;" data-en="Reset" data-hi="हटाएं">Reset</button>
                            </form>
                        <?php endif; ?>
                    </div>

                    <form method="POST" enctype="multipart/form-data" style="display:flex; gap:10px; align-items:center; flex-wrap:wrap;">
                        <input type="hidden" name="action" value="update_director">
                        <input type="hidden" name="photo_base64" id="directorBase64" value="">
                        <input type="file" name="director_photo" accept="image/*" class="form-control" style="flex:1; padding-top:6px;" onchange="prepareImageUpload(this, 'directorPreviewImg', 'directorBase64', 400, 400, null, 'directorFallbackAvatar')" required>
                        <button type="submit" class="btn-primary">
                            <span data-en="Update Photo" data-hi="फोटो बदलें">Update Photo</span>
                        </button>
                    </form>
                </div>
            </div>

            <!-- Current Homepage Gallery Grid -->
            <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:16px;">
                <h2 style="font-size:18px; font-weight:800; color:var(--navy);" data-en="Current Homepage Gallery Photos (<?= count($gallery_photos) ?>)" data-hi="वर्तमान होमपेज गैलरी फोटो (<?= count($gallery_photos) ?>)">
                    Current Homepage Gallery Photos (<?= count($gallery_photos) ?>)
                </h2>
                <span style="font-size:12.5px; color:var(--slate-500); font-weight:600;" data-en="Choose a new file on any card below to replace that photo on the homepage" data-hi="किसी भी फोटो को बदलने के लिए नीचे कार्ड में नई फोटो चुनें और Save दबाएं">
                    Choose a new file on any card below to replace that photo on the homepage
                </span>
            </div>

            <div class="slots-grid">
                <?php foreach ($gallery_photos as $idx => $item): 
                    $slot_num = $idx + 1;
                    $img_url = $item['image_path'] . (!empty($item['updated_at']) ? '?v=' . $item['updated_at'] : '');
                ?>
                    <div class="slot-card">
                        <div class="slot-img-wrap">
                            <img src="<?= htmlspecialchars($img_url) ?>" alt="<?= htmlspecialchars($item['title_en']) ?>" id="previewSlot<?= $item['id'] ?>">
                            <span class="slot-badge">Photo #<?= $slot_num ?></span>
                            <?php if (count($gallery_photos) > 1): ?>
                                <a href="admin-gallery.php?del_id=<?= $item['id'] ?>" class="slot-delete-btn" title="Delete Photo" onclick="return confirm('Remove this photo from the homepage gallery?');">
                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                                </a>
                            <?php endif; ?>
                        </div>
                        <form method="POST" enctype="multipart/form-data" class="slot-body">
                            <input type="hidden" name="action" value="replace_slot">
                            <input type="hidden" name="slot_id" value="<?= $item['id'] ?>">
                            <input type="hidden" name="photo_base64" id="slotBase64_<?= $item['id'] ?>" value="">

                            <div>
                                <label class="form-label" data-en="Caption (English)" data-hi="कैप्शन (English)">Caption (English)</label>
                                <input type="text" name="title_en" class="form-control" value="<?= htmlspecialchars($item['title_en']) ?>" required>
                            </div>
                            <div>
                                <label class="form-label" data-en="Caption (Hindi)" data-hi="कैप्शन (हिन्दी)">Caption (Hindi)</label>
                                <input type="text" name="title_hi" class="form-control" value="<?= htmlspecialchars($item['title_hi']) ?>" required>
                            </div>
                            <div>
                                <label class="form-label" data-en="Replace Image (Optional)" data-hi="नई फोटो चुनें (बदलने के लिए)">Replace Image (Optional)</label>
                                <input type="file" name="photo" accept="image/*" class="form-control" style="padding-top:6px;" onchange="prepareImageUpload(this, 'previewSlot<?= $item['id'] ?>', 'slotBase64_<?= $item['id'] ?>', 960, 720)">
                            </div>
                            <button type="submit" class="btn-primary" style="margin-top:auto; width:100%;">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4"><polyline points="20 6 9 17 4 12"/></svg>
                                <span data-en="Save / Replace Photo #<?= $slot_num ?>" data-hi="फोटो #<?= $slot_num ?> अपडेट करें">Save / Replace Photo #<?= $slot_num ?></span>
                            </button>
                        </form>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </main>

    <script>
        function toggleSidebar() {
            const sb = document.getElementById('adminSidebar');
            const ov = document.getElementById('drawerOverlay');
            if (sb && ov) {
                sb.classList.toggle('open');
                ov.classList.toggle('open');
            }
        }

        // Instant live preview + client-side canvas resize so even 15MB photos upload cleanly
        function prepareImageUpload(input, previewImgId, base64InputId, targetW, targetH, showWrapId, hideFallbackId) {
            if (!input.files || !input.files[0]) return;
            const file = input.files[0];
            const reader = new FileReader();
            reader.onload = function(e) {
                const dataUrl = e.target.result;
                const previewImg = document.getElementById(previewImgId);
                if (previewImg) {
                    previewImg.src = dataUrl;
                    previewImg.style.display = 'block';
                }
                if (showWrapId) {
                    const wrap = document.getElementById(showWrapId);
                    if (wrap) wrap.style.display = 'block';
                }
                if (hideFallbackId) {
                    const fb = document.getElementById(hideFallbackId);
                    if (fb) fb.style.display = 'none';
                }

                // Compress via HTML5 Canvas into hidden base64 field
                const img = new Image();
                img.onload = function() {
                    const canvas = document.createElement('canvas');
                    canvas.width = targetW;
                    canvas.height = targetH;
                    const ctx = canvas.getContext('2d');

                    const srcRatio = img.width / img.height;
                    const dstRatio = targetW / targetH;
                    let sx = 0, sy = 0, sw = img.width, sh = img.height;
                    if (srcRatio > dstRatio) {
                        sw = img.height * dstRatio;
                        sx = (img.width - sw) / 2;
                    } else {
                        sh = img.width / dstRatio;
                        sy = (img.height - sh) / 2;
                    }
                    ctx.fillStyle = '#ffffff';
                    ctx.fillRect(0, 0, targetW, targetH);
                    ctx.drawImage(img, sx, sy, sw, sh, 0, 0, targetW, targetH);

                    const b64Field = document.getElementById(base64InputId);
                    if (b64Field) {
                        b64Field.value = canvas.toDataURL('image/jpeg', 0.9);
                    }
                };
                img.src = dataUrl;
            };
            reader.readAsDataURL(file);
        }

        function setAdminLang(lang) {
            localStorage.setItem('scait_lang_v2', lang);
            document.documentElement.lang = lang === 'hi' ? 'hi' : 'en';
            const btnEn = document.getElementById('admLangEn');
            const btnHi = document.getElementById('admLangHi');
            if (btnEn && btnHi) {
                btnEn.classList.toggle('active', lang === 'en');
                btnHi.classList.toggle('active', lang === 'hi');
            }
            document.querySelectorAll('[data-en]').forEach(el => {
                const txt = el.getAttribute('data-' + lang);
                if (txt) el.textContent = txt;
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            setAdminLang(localStorage.getItem('scait_lang_v2') || 'en');
        });
    </script>
</body>
</html>
