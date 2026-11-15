<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: index.php?error=" . urlencode("Please login as Admin first"));
    exit();
}

require_once('connection.php');

$logged_user = htmlspecialchars($_SESSION['user']);
$msg = "";
$msg_hi = "";
$msg_type = "";
$new_roll = $_GET['roll'] ?? '';
$new_cor = $_GET['cor'] ?? '';

if (isset($_GET['error'])) {
    $err = $_GET['error'];
    if ($err === 'success') {
        $msg = "Student certificate record has been saved successfully!";
        $msg_hi = "छात्र का रिकॉर्ड सफलतापूर्वक सुरक्षित हो गया है!";
        $msg_type = "success";
    } else {
        $msg = htmlspecialchars($err);
        $msg_hi = htmlspecialchars($err);
        $msg_type = "warning";
    }
}

// Fetch Quick Stats
$total_certs = 0;
$total_adca = 0;
$total_tally = 0;
$total_inquiries = 0;

$res1 = mysqli_query($con, "SELECT COUNT(*) as c FROM s_cer_det");
if ($res1) {
    $row = mysqli_fetch_assoc($res1);
    $total_certs = $row['c'];
}

$res2 = mysqli_query($con, "SELECT COUNT(*) as c FROM s_cer_det WHERE course = 'ADCA'");
if ($res2) {
    $row = mysqli_fetch_assoc($res2);
    $total_adca = $row['c'];
}

$res3 = mysqli_query($con, "SELECT COUNT(*) as c FROM s_cer_det WHERE course = 'TALLY'");
if ($res3) {
    $row = mysqli_fetch_assoc($res3);
    $total_tally = $row['c'];
}

$res4 = mysqli_query($con, "SELECT COUNT(*) as c FROM s_adm");
if ($res4) {
    $row = mysqli_fetch_assoc($res4);
    $total_inquiries = $row['c'];
}

// Fetch 5 Most Recent Students
$recent_students = [];
$res_recent = mysqli_query($con, "SELECT id, name, roll, course, duration, photo FROM s_cer_det ORDER BY id DESC LIMIT 5");
if ($res_recent) {
    while ($r = mysqli_fetch_assoc($res_recent)) {
        $recent_students[] = $r;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <title>Add Student Certificate | SCAIT Admin Console</title>
    <link rel="shortcut icon" href="images/fav.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Outfit:wght@500;600;700;800&display=swap"
        rel="stylesheet">

    <style>
        :root {
            --navy: #06182e;
            --navy-dark: #040d1a;
            --navy-surface: #0a223e;
            --navy-border: rgba(255, 255, 255, 0.12);
            --orange: #f97316;
            --orange-hover: #ea580c;
            --orange-light: #fff7ed;
            --orange-glow: rgba(249, 115, 22, 0.28);
            --slate-50: #f8fafc;
            --slate-100: #f1f5f9;
            --slate-200: #e2e8f0;
            --slate-300: #cbd5e1;
            --slate-400: #94a3b8;
            --slate-500: #64748b;
            --slate-600: #475569;
            --slate-700: #334155;
            --slate-800: #1e293b;
            --slate-900: #0f172a;
            --white: #ffffff;
            --green: #10b981;
            --green-light: #ecfdf5;
            --radius-md: 12px;
            --radius-lg: 16px;
            --radius-xl: 20px;
            --radius-full: 9999px;
            --shadow-sm: 0 1px 3px rgba(6, 24, 46, 0.05);
            --shadow-md: 0 4px 16px rgba(6, 24, 46, 0.08);
            --shadow-lg: 0 12px 32px rgba(6, 24, 46, 0.12);
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

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
            transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            border-right: 1px solid rgba(255, 255, 255, 0.08);
        }

        .sidebar-brand {
            padding: 24px 20px 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .sidebar-brand img {
            height: 38px;
            width: auto;
        }

        .sidebar-brand-badge {
            display: inline-block;
            font-size: 9.5px;
            font-weight: 800;
            letter-spacing: 1px;
            text-transform: uppercase;
            padding: 2px 7px;
            border-radius: var(--radius-full);
            background: rgba(249, 115, 22, 0.2);
            color: #fdba74;
            border: 1px solid rgba(249, 115, 22, 0.35);
            margin-top: 3px;
        }

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

        .sidebar-link .icon {
            width: 18px;
            height: 18px;
            flex-shrink: 0;
        }

        .sidebar-user {
            padding: 16px 18px;
            border-top: 1px solid rgba(255, 255, 255, 0.08);
            background: rgba(4, 13, 26, 0.4);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 10px;
            min-width: 0;
        }

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
            flex-shrink: 0;
        }

        .user-meta {
            min-width: 0;
        }

        .user-name {
            font-size: 13px;
            font-weight: 700;
            color: var(--white);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .user-role {
            font-size: 11px;
            color: rgba(255, 255, 255, 0.5);
        }

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
            cursor: pointer;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .btn-logout-icon:hover {
            background: #ef4444;
            color: var(--white);
        }

        /* ── Main Layout ── */
        .admin-main {
            margin-left: 270px;
            flex: 1;
            display: flex;
            flex-direction: column;
            min-width: 0;
        }

        /* ── Top Bar ── */
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

        .topbar-left {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .mobile-toggle {
            display: none;
            background: none;
            border: none;
            cursor: pointer;
            padding: 6px;
            color: var(--slate-700);
        }

        .breadcrumb-text {
            font-size: 13.5px;
            color: var(--slate-500);
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .breadcrumb-text strong {
            color: var(--navy);
            font-weight: 700;
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 12px;
        }

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

        .lang-pill button.active {
            background: var(--navy);
            color: var(--white);
        }

        .badge-live {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 5px 12px;
            background: #ecfdf5;
            color: #065f46;
            font-size: 12px;
            font-weight: 700;
            border-radius: var(--radius-full);
            border: 1px solid #a7f3d0;
        }

        .badge-live::before {
            content: '';
            width: 7px;
            height: 7px;
            background: #10b981;
            border-radius: 50%;
            display: inline-block;
            box-shadow: 0 0 0 2px rgba(16, 185, 129, 0.3);
        }

        /* ── Content Container ── */
        .admin-content {
            padding: 28px;
            max-width: 1400px;
            width: 100%;
            margin: 0 auto;
        }

        /* ── Metric Cards ── */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(210px, 1fr));
            gap: 18px;
            margin-bottom: 26px;
        }

        .stat-card {
            background: var(--white);
            border-radius: var(--radius-lg);
            padding: 20px;
            border: 1px solid var(--slate-200);
            box-shadow: var(--shadow-sm);
            display: flex;
            align-items: center;
            gap: 16px;
            transition: all 0.2s ease;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: var(--radius-md);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .stat-icon.orange {
            background: #fff7ed;
            color: var(--orange);
        }

        .stat-icon.blue {
            background: #eff6ff;
            color: #2563eb;
        }

        .stat-icon.emerald {
            background: #ecfdf5;
            color: #059669;
        }

        .stat-icon.purple {
            background: #faf5ff;
            color: #9333ea;
        }

        .stat-val {
            font-size: 24px;
            font-weight: 800;
            font-family: 'Outfit', sans-serif;
            color: var(--navy);
            line-height: 1;
        }

        .stat-label {
            font-size: 12.5px;
            color: var(--slate-500);
            margin-top: 4px;
            font-weight: 600;
        }

        /* ── Page Grid: Form + Sidebar ── */
        .workspace-grid {
            display: grid;
            grid-template-columns: 1fr 340px;
            gap: 24px;
            align-items: start;
        }

        @media (max-width: 1100px) {
            .workspace-grid {
                grid-template-columns: 1fr;
            }
        }

        /* ── Form Card ── */
        .panel-card {
            background: var(--white);
            border-radius: var(--radius-lg);
            border: 1px solid var(--slate-200);
            box-shadow: var(--shadow-sm);
            overflow: hidden;
        }

        .panel-header {
            padding: 22px 26px;
            border-bottom: 1px solid var(--slate-200);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            background: linear-gradient(180deg, #ffffff 0%, #fafafa 100%);
        }

        .panel-title-group h2 {
            font-size: 18px;
            font-weight: 800;
            color: var(--navy);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .panel-title-group p {
            font-size: 13px;
            color: var(--slate-500);
            margin-top: 3px;
        }

        .panel-body {
            padding: 26px;
        }

        /* ── Form Sections ── */
        .form-section {
            margin-bottom: 26px;
            padding-bottom: 24px;
            border-bottom: 1px solid var(--slate-100);
        }

        .form-section:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .section-label {
            font-size: 12.5px;
            font-weight: 800;
            letter-spacing: 0.8px;
            text-transform: uppercase;
            color: var(--orange);
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .form-row {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 18px;
            margin-bottom: 16px;
        }

        .form-row.cols-3 {
            grid-template-columns: repeat(3, 1fr);
        }

        @media (max-width: 768px) {

            .form-row,
            .form-row.cols-3 {
                grid-template-columns: 1fr;
            }
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .form-label {
            font-size: 13px;
            font-weight: 700;
            color: var(--slate-700);
        }

        .form-label .req {
            color: #ef4444;
        }

        .form-control {
            height: 44px;
            padding: 0 14px;
            border-radius: var(--radius-md);
            border: 1.5px solid var(--slate-200);
            background: var(--white);
            color: var(--slate-900);
            font-size: 14px;
            font-family: inherit;
            transition: all 0.2s ease;
            outline: none;
        }

        .form-control:focus {
            border-color: var(--orange);
            box-shadow: 0 0 0 3px rgba(249, 115, 22, 0.15);
        }

        select.form-control {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%23475569' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 14px center;
            padding-right: 36px;
            cursor: pointer;
        }

        /* ── Photo Upload Zone ── */
        .photo-upload-wrap {
            display: grid;
            grid-template-columns: 140px 1fr;
            gap: 20px;
            align-items: center;
            background: #fafaf9;
            padding: 18px;
            border-radius: var(--radius-md);
            border: 1.5px dashed var(--slate-300);
            transition: all 0.2s ease;
        }

        .photo-upload-wrap:hover {
            border-color: var(--orange);
            background: #fffaf5;
        }

        .preview-box {
            width: 130px;
            height: 160px;
            border-radius: var(--radius-md);
            background: var(--slate-100);
            border: 1px solid var(--slate-300);
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
            flex-shrink: 0;
            box-shadow: var(--shadow-sm);
        }

        .preview-box img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .preview-placeholder {
            text-align: center;
            color: var(--slate-400);
            font-size: 11px;
            font-weight: 600;
            padding: 8px;
        }

        .preview-placeholder svg {
            width: 32px;
            height: 32px;
            margin-bottom: 6px;
            color: var(--slate-400);
        }

        .upload-input-wrap {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .btn-choose-file {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 9px 16px;
            background: var(--white);
            color: var(--navy);
            border: 1.5px solid var(--slate-300);
            border-radius: var(--radius-md);
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
            width: fit-content;
            transition: all 0.2s ease;
        }

        .btn-choose-file:hover {
            border-color: var(--navy);
            background: var(--slate-50);
        }

        .upload-note {
            font-size: 12px;
            color: var(--slate-500);
            line-height: 1.5;
        }

        /* ── Submit Row ── */
        .form-actions {
            margin-top: 26px;
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .btn-submit {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            background: linear-gradient(180deg, #fb923c 0%, #ea580c 100%);
            color: var(--white);
            font-size: 14px;
            font-weight: 800;
            padding: 12px 28px;
            border-radius: var(--radius-md);
            border: none;
            cursor: pointer;
            box-shadow: 0 4px 14px rgba(234, 88, 12, 0.35);
            transition: all 0.2s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .btn-submit:hover {
            background: linear-gradient(180deg, #f97316 0%, #c2410c 100%);
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(234, 88, 12, 0.45);
        }

        .btn-reset {
            padding: 12px 20px;
            background: var(--white);
            border: 1.5px solid var(--slate-300);
            color: var(--slate-600);
            font-size: 13.5px;
            font-weight: 700;
            border-radius: var(--radius-md);
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .btn-reset:hover {
            background: var(--slate-100);
            color: var(--slate-800);
        }

        /* ── Alert Banners ── */
        .alert-banner {
            padding: 16px 20px;
            border-radius: var(--radius-md);
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 14px;
            font-size: 14px;
            font-weight: 600;
        }

        .alert-banner.success {
            background: #ecfdf5;
            color: #065f46;
            border: 1.5px solid #a7f3d0;
        }

        .alert-banner.warning {
            background: #fffbeb;
            color: #92400e;
            border: 1.5px solid #fde68a;
        }

        .alert-btn {
            background: #059669;
            color: var(--white);
            text-decoration: none;
            padding: 7px 16px;
            border-radius: var(--radius-md);
            font-size: 12.5px;
            font-weight: 800;
            white-space: nowrap;
            transition: all 0.2s ease;
        }

        .alert-btn:hover {
            background: #047857;
            transform: translateY(-1px);
        }

        /* ── Right Quick Records Sidebar ── */
        .quick-records-card {
            background: var(--white);
            border-radius: var(--radius-lg);
            border: 1px solid var(--slate-200);
            box-shadow: var(--shadow-sm);
            padding: 20px;
        }

        .quick-records-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 16px;
            padding-bottom: 12px;
            border-bottom: 1px solid var(--slate-100);
        }

        .quick-records-header h3 {
            font-size: 15px;
            font-weight: 800;
            color: var(--navy);
        }

        .recent-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .recent-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 8px;
            border-radius: var(--radius-md);
            background: var(--slate-50);
            border: 1px solid var(--slate-200);
            transition: all 0.2s ease;
        }

        .recent-item:hover {
            border-color: var(--orange);
            background: var(--white);
            transform: translateX(2px);
        }

        .recent-thumb {
            width: 42px;
            height: 52px;
            border-radius: 6px;
            object-fit: cover;
            background: var(--slate-200);
            flex-shrink: 0;
            border: 1px solid var(--slate-300);
        }

        .recent-meta {
            min-width: 0;
            flex: 1;
        }

        .recent-name {
            font-size: 13px;
            font-weight: 800;
            color: var(--navy);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .recent-roll {
            font-size: 11.5px;
            color: var(--slate-500);
            font-family: monospace;
        }

        .recent-course-tag {
            display: inline-block;
            font-size: 10px;
            font-weight: 800;
            padding: 2px 6px;
            border-radius: 4px;
            background: #fff7ed;
            color: var(--orange);
            margin-top: 2px;
        }

        .recent-action-btn {
            background: rgba(6, 24, 46, 0.06);
            color: var(--navy);
            width: 30px;
            height: 30px;
            border-radius: var(--radius-md);
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            flex-shrink: 0;
            transition: all 0.2s ease;
        }

        .recent-action-btn:hover {
            background: var(--orange);
            color: var(--white);
        }

        /* ── Responsive Drawer for Mobile ── */
        .drawer-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(4, 13, 26, 0.6);
            backdrop-filter: blur(4px);
            z-index: 999;
        }

        @media (max-width: 992px) {
            .admin-sidebar {
                transform: translateX(-100%);
            }

            .admin-sidebar.open {
                transform: translateX(0);
            }

            .drawer-overlay.open {
                display: block;
            }

            .admin-main {
                margin-left: 0;
            }

            .mobile-toggle {
                display: block;
            }
        }
    </style>
</head>

<body>

    <!-- ── Mobile Drawer Overlay ── -->
    <div class="drawer-overlay" id="drawerOverlay" onclick="toggleSidebar()"></div>

    <!-- ── Left Sidebar ── -->
    <aside class="admin-sidebar" id="adminSidebar">
        <div class="sidebar-brand">
            <a href="index.php" style="display:flex; align-items:center; gap:12px; text-decoration:none;">
                <img src="images/logo-light.svg" alt="SCAIT Academy" onerror="this.src='images/logo.png'">
            </a>
        </div>

        <nav class="sidebar-nav">
            <span class="sidebar-heading" data-en="Certificate Management" data-hi="सर्टिफिकेट प्रबंधन">Certificate
                Management</span>
            <a href="admin-user-add.php" class="sidebar-link active">
                <span class="icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M12 5v14M5 12h14" />
                    </svg>
                </span>
                <span data-en="Add Student Certificate" data-hi="छात्र सर्टिफिकेट जोड़ें">Add Student Certificate</span>
            </a>
            <a href="admin-user-all.php" class="sidebar-link">
                <span class="icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                        <circle cx="9" cy="7" r="4" />
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87" />
                        <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                    </svg>
                </span>
                <span data-en="All Student Records" data-hi="सभी छात्र रिकॉर्ड">All Student Records</span>
            </a>

            <span class="sidebar-heading" style="margin-top:14px;" data-en="Institute Inquiries"
                data-hi="संस्थान पूछताछ">Institute Inquiries</span>
            <a href="admin-inquiries.php" class="sidebar-link">
                <span class="icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z" />
                    </svg>
                </span>
                <span data-en="Admission Inquiries" data-hi="प्रवेश पूछताछ">Admission Inquiries</span>
                <span
                    style="margin-left:auto; background:rgba(249,115,22,0.25); color:#fdba74; font-size:11px; font-weight:800; padding:2px 7px; border-radius:999px;"><?= $total_inquiries ?></span>
            </a>

            <span class="sidebar-heading" style="margin-top:14px;" data-en="Exam Portal" data-hi="परीक्षा पोर्टल">Exam
                Portal</span>
            <a href="add_question.php" class="sidebar-link">
                <span class="icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10" />
                        <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3" />
                        <line x1="12" y1="17" x2="12.01" y2="17" />
                    </svg>
                </span>
                <span data-en="Question Bank" data-hi="प्रश्न बैंक">Question Bank</span>
            </a>

            <span class="sidebar-heading" style="margin-top:14px;" data-en="Quick Actions" data-hi="त्वरित विकल्प">Quick
                Actions</span>
            <a href="index.php" target="_blank" class="sidebar-link">
                <span class="icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6" />
                        <polyline points="15 3 21 3 21 9" />
                        <line x1="10" y1="14" x2="21" y2="3" />
                    </svg>
                </span>
                <span data-en="View Public Website" data-hi="मुख्य वेबसाइट देखें">View Public Website</span>
            </a>
        </nav>

        <div class="sidebar-user">
            <div class="user-info">
                <div class="user-avatar"><?= strtoupper(substr($logged_user, 0, 1)) ?></div>
                <div class="user-meta">
                    <div class="user-name"><?= $logged_user ?></div>
                    <div class="user-role" data-en="Super Admin" data-hi="सुपर एडमिन">Super Admin</div>
                </div>
            </div>
            <a href="logout.php" class="btn-logout-icon" title="Logout" aria-label="Logout">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                    <polyline points="16 17 21 12 16 7" />
                    <line x1="21" y1="12" x2="9" y2="12" />
                </svg>
            </a>
        </div>
    </aside>

    <!-- ── Main Area ── -->
    <main class="admin-main">
        <!-- Top Bar -->
        <header class="admin-topbar">
            <div class="topbar-left">
                <button class="mobile-toggle" onclick="toggleSidebar()" aria-label="Toggle Menu">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="3" y1="12" x2="21" y2="12" />
                        <line x1="3" y1="6" x2="21" y2="6" />
                        <line x1="3" y1="18" x2="21" y2="18" />
                    </svg>
                </button>
                <div class="breadcrumb-text">
                    <span data-en="Admin Console" data-hi="एडमिन कंसोल">Admin Console</span>
                    <span>/</span>
                    <strong data-en="Add Student Certificate" data-hi="छात्र सर्टिफिकेट जोड़ें">Add Student
                        Certificate</strong>
                </div>
            </div>
            <div class="topbar-right">
                <div class="lang-pill" aria-label="Language Switcher">
                    <button type="button" id="admLangEn" class="active" onclick="setAdminLang('en')">English</button>
                    <button type="button" id="admLangHi" onclick="setAdminLang('hi')">हिन्दी</button>
                </div>
                <span class="badge-live" data-en="System Active" data-hi="सिस्टम सक्रिय">System Active</span>
                <a href="admin-user-all.php" class="btn-choose-file" style="text-decoration:none;">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                        <circle cx="9" cy="7" r="4" />
                    </svg>
                    <span data-en="All Records" data-hi="सभी रिकॉर्ड">All Records</span>
                </a>
            </div>
        </header>

        <div class="admin-content">
            <!-- Stats Counters -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon orange">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <path d="M22 10v6M2 10l10-5 10 5-10 5z" />
                            <path d="M6 12v5c3 3 9 3 12 0v-5" />
                        </svg>
                    </div>
                    <div>
                        <div class="stat-val"><?= $total_certs ?></div>
                        <div class="stat-label" data-en="Total Certificates" data-hi="कुल सर्टिफिकेट">Total Certificates
                        </div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon blue">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <rect x="2" y="3" width="20" height="14" rx="2" ry="2" />
                            <line x1="8" y1="21" x2="16" y2="21" />
                            <line x1="12" y1="17" x2="12" y2="21" />
                        </svg>
                    </div>
                    <div>
                        <div class="stat-val"><?= $total_adca ?></div>
                        <div class="stat-label" data-en="ADCA Students" data-hi="ADCA छात्र">ADCA Students</div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon emerald">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <line x1="12" y1="1" x2="12" y2="23" />
                            <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6" />
                        </svg>
                    </div>
                    <div>
                        <div class="stat-val"><?= $total_tally ?></div>
                        <div class="stat-label" data-en="Tally Prime Students" data-hi="Tally छात्र">Tally Prime
                            Students</div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon purple">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z" />
                        </svg>
                    </div>
                    <div>
                        <div class="stat-val"><?= $total_inquiries ?></div>
                        <div class="stat-label" data-en="Admission Inquiries" data-hi="प्रवेश पूछताछ">Admission
                            Inquiries</div>
                    </div>
                </div>
            </div>

            <!-- Feedback Alert -->
            <?php if ($msg !== ""): ?>
                <div class="alert-banner <?= $msg_type ?>">
                    <div style="display:flex; align-items:center; gap:10px;">
                        <span style="display:inline-flex;align-items:center;">
                            <?php if ($msg_type === 'success'): ?>
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
                                    <polyline points="22 4 12 14.01 9 11.01" />
                                </svg>
                            <?php else: ?>
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z" />
                                    <line x1="12" y1="9" x2="12" y2="13" />
                                    <line x1="12" y1="17" x2="12.01" y2="17" />
                                </svg>
                            <?php endif; ?>
                        </span>
                        <span data-en="<?= htmlspecialchars($msg) ?>"
                            data-hi="<?= htmlspecialchars($msg_hi) ?>"><?= $msg ?></span>
                    </div>
                    <?php if ($msg_type === 'success' && $new_roll !== '' && $new_cor !== ''): ?>
                        <a href="certificate/index.php?of=<?= urlencode($new_roll) ?>&cor=<?= urlencode($new_cor) ?>"
                            target="_blank" class="alert-btn" style="display:inline-flex;align-items:center;gap:6px;">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                                <circle cx="12" cy="12" r="3" />
                            </svg>
                            <span data-en="View Certificate (Roll: <?= htmlspecialchars($new_roll) ?>)"
                                data-hi="सर्टिफिकेट देखें (रोल: <?= htmlspecialchars($new_roll) ?>)">View Certificate (Roll:
                                <?= htmlspecialchars($new_roll) ?>)</span>
                        </a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <!-- Workspace: Form + Recent Records -->
            <div class="workspace-grid">
                <!-- Form Card -->
                <div class="panel-card">
                    <div class="panel-header">
                        <div class="panel-title-group">
                            <h2>
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--orange)"
                                    stroke-width="2.5">
                                    <path d="M12 5v14M5 12h14" />
                                </svg>
                                <span data-en="Add Student Certificate Record"
                                    data-hi="छात्र सर्टिफिकेट रिकॉर्ड जोड़ें">Add Student Certificate Record</span>
                            </h2>
                            <p data-en="Fill student details and passport photo to synthesize official certificate."
                                data-hi="आधिकारिक सर्टिफिकेट और अंकतालिका बनाने के लिए छात्र का विवरण और पासपोर्ट फोटो भरें।">
                                Fill student details and passport photo to synthesize official certificate.</p>
                        </div>
                        <button type="button" onclick="fillSampleData()" class="btn-choose-file"
                            style="font-size:11.5px; padding:6px 12px;">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                <polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2" />
                            </svg>
                            <span data-en="Sample Fill" data-hi="सैंपल भरें">Sample Fill</span>
                        </button>
                    </div>

                    <div class="panel-body">
                        <form method="POST" action="s_cer_det.php" enctype="multipart/form-data" id="studentCertForm">
                            <!-- Section 1: Student & Family Information -->
                            <div class="form-section">
                                <div class="section-label">
                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                                        <circle cx="12" cy="7" r="4" />
                                    </svg>
                                    <span data-en="1. Student & Family Information"
                                        data-hi="1. छात्र एवं परिवार की जानकारी">1. Student & Family Information</span>
                                </div>

                                <div class="form-row">
                                    <div class="form-group">
                                        <label class="form-label"><span data-en="Student Full Name"
                                                data-hi="छात्र का पूरा नाम">Student Full Name</span> <span
                                                class="req">*</span></label>
                                        <input type="text" name="s_name" id="s_name" class="form-control"
                                            placeholder="e.g. Rahul Kumar" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label"><span data-en="Father's Name"
                                                data-hi="पिता का नाम">Father's Name</span> <span
                                                class="req">*</span></label>
                                        <input type="text" name="f_name" id="f_name" class="form-control"
                                            placeholder="e.g. Ramesh Chandra" required>
                                    </div>
                                </div>

                                <div class="form-row cols-3">
                                    <div class="form-group">
                                        <label class="form-label"><span data-en="Mother's Name"
                                                data-hi="माता का नाम">Mother's Name</span> <span
                                                class="req">*</span></label>
                                        <input type="text" name="m_name" id="m_name" class="form-control"
                                            placeholder="e.g. Sunita Devi" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label"><span data-en="Date of Birth" data-hi="जन्म तिथि">Date
                                                of Birth</span> <span class="req">*</span></label>
                                        <input type="text" name="dob" id="dob" class="form-control"
                                            placeholder="12-May-2000" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label"><span data-en="Gender" data-hi="लिंग">Gender</span>
                                            <span class="req">*</span></label>
                                        <select name="gender" id="gender" class="form-control" required>
                                            <option value="male">Male (He has been Awarded)</option>
                                            <option value="female">Female (She has been Awarded)</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Section 2: Course & Certificate Data -->
                            <div class="form-section">
                                <div class="section-label">
                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2">
                                        <path d="M22 10v6M2 10l10-5 10 5-10 5z" />
                                        <path d="M6 12v5c3 3 9 3 12 0v-5" />
                                    </svg>
                                    <span data-en="2. Course & Enrollment Records"
                                        data-hi="2. कोर्स एवं नामांकन विवरण">2. Course & Enrollment Records</span>
                                </div>

                                <div class="form-row">
                                    <div class="form-group">
                                        <label class="form-label"><span data-en="Enrolled Course"
                                                data-hi="चयनित कोर्स">Enrolled Course</span> <span
                                                class="req">*</span></label>
                                        <select name="course" id="course" class="form-control" required>
                                            <option value="">Select Course...</option>
                                            <option value="ADCA">ADCA (Advance Diploma in Computer Application)</option>
                                            <option value="TALLY">TALLY (Tally Prime with GST)</option>
                                            <option value="TYPING">TYPING (Hindi & English Typing)</option>
                                            <option value="CCC">CCC (Course on Computer Concepts)</option>
                                            <option value="DCA">DCA (Diploma in Computer Application)</option>
                                            <option value="DTP">DTP (Desktop Publishing)</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label"><span data-en="Course Duration"
                                                data-hi="कोर्स की अवधि">Course Duration</span> <span
                                                class="req">*</span></label>
                                        <select name="duration" id="duration" class="form-control" required>
                                            <option value="1 Year">1 Year</option>
                                            <option value="6 Months">6 Months</option>
                                            <option value="3 Months">3 Months</option>
                                            <option value="2 Year">2 Year</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group">
                                        <label class="form-label"><span data-en="Enrollment Number"
                                                data-hi="नामांकन संख्या (Enrollment No)">Enrollment Number</span> <span
                                                class="req">*</span></label>
                                        <input type="text" name="e_number" id="e_number" class="form-control"
                                            placeholder="e.g. UP012695" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label"><span data-en="Roll Number"
                                                data-hi="रोल नंबर (Roll No)">Roll Number</span> <span
                                                class="req">*</span></label>
                                        <input type="text" name="r_number" id="r_number" class="form-control"
                                            placeholder="e.g. UP012595" required>
                                    </div>
                                </div>
                            </div>

                            <!-- Section 3: Academic Marks & Marksheet -->
                            <div class="form-section">
                                <div class="section-label"
                                    style="display:flex; justify-content:space-between; align-items:center;">
                                    <span style="display:flex; align-items:center; gap:8px;">
                                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2">
                                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                                            <polyline points="14 2 14 8 20 8" />
                                            <line x1="16" y1="13" x2="8" y2="13" />
                                            <line x1="16" y1="17" x2="8" y2="17" />
                                            <polyline points="10 9 9 9 8 9" />
                                        </svg>
                                        <span data-en="3. Academic Marks & Marksheet (6 Subjects)"
                                            data-hi="3. शैक्षणिक अंक एवं अंकतालिका (6 विषय)">3. Academic Marks &
                                            Marksheet (6 Subjects)</span>
                                    </span>
                                    <label
                                        style="font-size:12px; font-weight:700; color:var(--orange); display:inline-flex; align-items:center; gap:6px; cursor:pointer;">
                                        <input type="checkbox" id="toggleMarksheet" checked
                                            onchange="toggleMarksheetView(this.checked)">
                                        <span data-en="Enable Marksheet" data-hi="अंकतालिका सक्षम करें">Enable
                                            Marksheet</span>
                                    </label>
                                </div>

                                <div id="marksheetContainer">
                                    <div class="form-row cols-3" style="margin-bottom:14px;">
                                        <div class="form-group">
                                            <label class="form-label" data-en="Academic Session"
                                                data-hi="शैक्षणिक सत्र">Academic Session</label>
                                            <input type="text" name="session" id="session" class="form-control"
                                                value="<?= date('Y') ?>" placeholder="e.g. <?= date('Y') ?>">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label" data-en="Date of Issue"
                                                data-hi="जारी करने की तिथि">Date of Issue</label>
                                            <input type="text" name="issue_date" id="issue_date" class="form-control"
                                                value="<?= date('d-m-Y') ?>" placeholder="DD-MM-YYYY">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Certificate Types</label>
                                            <div
                                                style="font-size:12.5px; font-weight:700; color:var(--navy); padding-top:9px; display:inline-flex; align-items:center; gap:8px;">
                                                <span style="display:inline-flex;align-items:center;gap:4px;"><svg
                                                        width="14" height="14" viewBox="0 0 24 24" fill="none"
                                                        stroke="var(--orange)" stroke-width="2.2">
                                                        <circle cx="12" cy="8" r="6" />
                                                        <path d="M15.477 12.89 17 22l-5-3-5 3 1.523-9.11" />
                                                    </svg> Diploma</span>
                                                <span>+</span>
                                                <span style="display:inline-flex;align-items:center;gap:4px;"><svg
                                                        width="14" height="14" viewBox="0 0 24 24" fill="none"
                                                        stroke="var(--navy)" stroke-width="2.2">
                                                        <path
                                                            d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                                                        <polyline points="14 2 14 8 20 8" />
                                                    </svg> Marksheet</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div
                                        style="overflow-x:auto; border:1px solid var(--slate-200); border-radius:var(--radius-md); margin-bottom:14px;">
                                        <table
                                            style="width:100%; border-collapse:collapse; font-size:13px; text-align:left;">
                                            <thead
                                                style="background:var(--slate-100); color:var(--slate-700); font-weight:700; border-bottom:1px solid var(--slate-200);">
                                                <tr>
                                                    <th style="padding:10px 12px; width:36px;">#</th>
                                                    <th style="padding:10px 12px;">Subject Name</th>
                                                    <th style="padding:10px 12px; width:80px; text-align:center;">Max
                                                    </th>
                                                    <th style="padding:10px 12px; width:100px; text-align:center;">
                                                        Theory</th>
                                                    <th style="padding:10px 12px; width:100px; text-align:center;">
                                                        Practical</th>
                                                    <th style="padding:10px 12px; width:80px; text-align:center;">Total
                                                    </th>
                                                    <th style="padding:10px 12px; width:70px; text-align:center;">Grade
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody id="subjectsTableBody">
                                                <!-- Row 1 -->
                                                <tr style="border-bottom:1px solid var(--slate-100);">
                                                    <td
                                                        style="padding:8px 12px; font-weight:700; color:var(--slate-400);">
                                                        1</td>
                                                    <td style="padding:8px 12px;">
                                                        <input type="text" name="subject_name[]" class="form-control"
                                                            value="Computer Fundamental"
                                                            style="height:32px; font-size:12.5px;" required>
                                                    </td>
                                                    <td
                                                        style="padding:8px 12px; text-align:center; font-weight:700; color:var(--slate-500);">
                                                        100</td>
                                                    <td style="padding:8px 12px;">
                                                        <input type="number" name="theory_marks[]"
                                                            class="form-control sub-theory" value="42" min="0" max="50"
                                                            style="height:32px; text-align:center; font-weight:700;"
                                                            oninput="calcMarks()" required>
                                                    </td>
                                                    <td style="padding:8px 12px;">
                                                        <input type="number" name="practical_marks[]"
                                                            class="form-control sub-practical" value="46" min="0"
                                                            max="50"
                                                            style="height:32px; text-align:center; font-weight:700;"
                                                            oninput="calcMarks()" required>
                                                    </td>
                                                    <td style="padding:8px 12px; text-align:center; font-weight:800; color:var(--navy);"
                                                        class="sub-total">88</td>
                                                    <td style="padding:8px 12px; text-align:center;">
                                                        <span class="sub-grade-badge"
                                                            style="background:#ecfdf5; color:#065f46; font-weight:800; padding:2px 7px; border-radius:4px; font-size:11.5px;">A</span>
                                                        <input type="hidden" name="subject_grade[]"
                                                            class="sub-grade-val" value="A">
                                                    </td>
                                                </tr>
                                                <!-- Row 2 -->
                                                <tr style="border-bottom:1px solid var(--slate-100);">
                                                    <td
                                                        style="padding:8px 12px; font-weight:700; color:var(--slate-400);">
                                                        2</td>
                                                    <td style="padding:8px 12px;">
                                                        <input type="text" name="subject_name[]" class="form-control"
                                                            value="Operating System, Typing"
                                                            style="height:32px; font-size:12.5px;" required>
                                                    </td>
                                                    <td
                                                        style="padding:8px 12px; text-align:center; font-weight:700; color:var(--slate-500);">
                                                        100</td>
                                                    <td style="padding:8px 12px;">
                                                        <input type="number" name="theory_marks[]"
                                                            class="form-control sub-theory" value="44" min="0" max="50"
                                                            style="height:32px; text-align:center; font-weight:700;"
                                                            oninput="calcMarks()" required>
                                                    </td>
                                                    <td style="padding:8px 12px;">
                                                        <input type="number" name="practical_marks[]"
                                                            class="form-control sub-practical" value="45" min="0"
                                                            max="50"
                                                            style="height:32px; text-align:center; font-weight:700;"
                                                            oninput="calcMarks()" required>
                                                    </td>
                                                    <td style="padding:8px 12px; text-align:center; font-weight:800; color:var(--navy);"
                                                        class="sub-total">89</td>
                                                    <td style="padding:8px 12px; text-align:center;">
                                                        <span class="sub-grade-badge"
                                                            style="background:#ecfdf5; color:#065f46; font-weight:800; padding:2px 7px; border-radius:4px; font-size:11.5px;">A</span>
                                                        <input type="hidden" name="subject_grade[]"
                                                            class="sub-grade-val" value="A">
                                                    </td>
                                                </tr>
                                                <!-- Row 3 -->
                                                <tr style="border-bottom:1px solid var(--slate-100);">
                                                    <td
                                                        style="padding:8px 12px; font-weight:700; color:var(--slate-400);">
                                                        3</td>
                                                    <td style="padding:8px 12px;">
                                                        <input type="text" name="subject_name[]" class="form-control"
                                                            value="Ms Word, Excel, PowerPoint"
                                                            style="height:32px; font-size:12.5px;" required>
                                                    </td>
                                                    <td
                                                        style="padding:8px 12px; text-align:center; font-weight:700; color:var(--slate-500);">
                                                        100</td>
                                                    <td style="padding:8px 12px;">
                                                        <input type="number" name="theory_marks[]"
                                                            class="form-control sub-theory" value="41" min="0" max="50"
                                                            style="height:32px; text-align:center; font-weight:700;"
                                                            oninput="calcMarks()" required>
                                                    </td>
                                                    <td style="padding:8px 12px;">
                                                        <input type="number" name="practical_marks[]"
                                                            class="form-control sub-practical" value="46" min="0"
                                                            max="50"
                                                            style="height:32px; text-align:center; font-weight:700;"
                                                            oninput="calcMarks()" required>
                                                    </td>
                                                    <td style="padding:8px 12px; text-align:center; font-weight:800; color:var(--navy);"
                                                        class="sub-total">87</td>
                                                    <td style="padding:8px 12px; text-align:center;">
                                                        <span class="sub-grade-badge"
                                                            style="background:#ecfdf5; color:#065f46; font-weight:800; padding:2px 7px; border-radius:4px; font-size:11.5px;">A</span>
                                                        <input type="hidden" name="subject_grade[]"
                                                            class="sub-grade-val" value="A">
                                                    </td>
                                                </tr>
                                                <!-- Row 4 -->
                                                <tr style="border-bottom:1px solid var(--slate-100);">
                                                    <td
                                                        style="padding:8px 12px; font-weight:700; color:var(--slate-400);">
                                                        4</td>
                                                    <td style="padding:8px 12px;">
                                                        <input type="text" name="subject_name[]" class="form-control"
                                                            value="Programming (HTML)"
                                                            style="height:32px; font-size:12.5px;" required>
                                                    </td>
                                                    <td
                                                        style="padding:8px 12px; text-align:center; font-weight:700; color:var(--slate-500);">
                                                        100</td>
                                                    <td style="padding:8px 12px;">
                                                        <input type="number" name="theory_marks[]"
                                                            class="form-control sub-theory" value="43" min="0" max="50"
                                                            style="height:32px; text-align:center; font-weight:700;"
                                                            oninput="calcMarks()" required>
                                                    </td>
                                                    <td style="padding:8px 12px;">
                                                        <input type="number" name="practical_marks[]"
                                                            class="form-control sub-practical" value="45" min="0"
                                                            max="50"
                                                            style="height:32px; text-align:center; font-weight:700;"
                                                            oninput="calcMarks()" required>
                                                    </td>
                                                    <td style="padding:8px 12px; text-align:center; font-weight:800; color:var(--navy);"
                                                        class="sub-total">88</td>
                                                    <td style="padding:8px 12px; text-align:center;">
                                                        <span class="sub-grade-badge"
                                                            style="background:#ecfdf5; color:#065f46; font-weight:800; padding:2px 7px; border-radius:4px; font-size:11.5px;">A</span>
                                                        <input type="hidden" name="subject_grade[]"
                                                            class="sub-grade-val" value="A">
                                                    </td>
                                                </tr>
                                                <!-- Row 5 -->
                                                <tr style="border-bottom:1px solid var(--slate-100);">
                                                    <td
                                                        style="padding:8px 12px; font-weight:700; color:var(--slate-400);">
                                                        5</td>
                                                    <td style="padding:8px 12px;">
                                                        <input type="text" name="subject_name[]" class="form-control"
                                                            value="Photoshop, Corel Draw"
                                                            style="height:32px; font-size:12.5px;" required>
                                                    </td>
                                                    <td
                                                        style="padding:8px 12px; text-align:center; font-weight:700; color:var(--slate-500);">
                                                        100</td>
                                                    <td style="padding:8px 12px;">
                                                        <input type="number" name="theory_marks[]"
                                                            class="form-control sub-theory" value="40" min="0" max="50"
                                                            style="height:32px; text-align:center; font-weight:700;"
                                                            oninput="calcMarks()" required>
                                                    </td>
                                                    <td style="padding:8px 12px;">
                                                        <input type="number" name="practical_marks[]"
                                                            class="form-control sub-practical" value="47" min="0"
                                                            max="50"
                                                            style="height:32px; text-align:center; font-weight:700;"
                                                            oninput="calcMarks()" required>
                                                    </td>
                                                    <td style="padding:8px 12px; text-align:center; font-weight:800; color:var(--navy);"
                                                        class="sub-total">87</td>
                                                    <td style="padding:8px 12px; text-align:center;">
                                                        <span class="sub-grade-badge"
                                                            style="background:#ecfdf5; color:#065f46; font-weight:800; padding:2px 7px; border-radius:4px; font-size:11.5px;">A</span>
                                                        <input type="hidden" name="subject_grade[]"
                                                            class="sub-grade-val" value="A">
                                                    </td>
                                                </tr>
                                                <!-- Row 6 -->
                                                <tr>
                                                    <td
                                                        style="padding:8px 12px; font-weight:700; color:var(--slate-400);">
                                                        6</td>
                                                    <td style="padding:8px 12px;">
                                                        <input type="text" name="subject_name[]" class="form-control"
                                                            value="Accounting, Tally"
                                                            style="height:32px; font-size:12.5px;" required>
                                                    </td>
                                                    <td
                                                        style="padding:8px 12px; text-align:center; font-weight:700; color:var(--slate-500);">
                                                        100</td>
                                                    <td style="padding:8px 12px;">
                                                        <input type="number" name="theory_marks[]"
                                                            class="form-control sub-theory" value="42" min="0" max="50"
                                                            style="height:32px; text-align:center; font-weight:700;"
                                                            oninput="calcMarks()" required>
                                                    </td>
                                                    <td style="padding:8px 12px;">
                                                        <input type="number" name="practical_marks[]"
                                                            class="form-control sub-practical" value="46" min="0"
                                                            max="50"
                                                            style="height:32px; text-align:center; font-weight:700;"
                                                            oninput="calcMarks()" required>
                                                    </td>
                                                    <td style="padding:8px 12px; text-align:center; font-weight:800; color:var(--navy);"
                                                        class="sub-total">88</td>
                                                    <td style="padding:8px 12px; text-align:center;">
                                                        <span class="sub-grade-badge"
                                                            style="background:#ecfdf5; color:#065f46; font-weight:800; padding:2px 7px; border-radius:4px; font-size:11.5px;">A</span>
                                                        <input type="hidden" name="subject_grade[]"
                                                            class="sub-grade-val" value="A">
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <!-- Live Summary Banner -->
                                    <div
                                        style="background:#f8fafc; border:1.5px dashed var(--slate-300); border-radius:var(--radius-md); padding:12px 18px; display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:12px;">
                                        <div style="display:flex; gap:24px; align-items:center;">
                                            <div>
                                                <span
                                                    style="font-size:11px; color:var(--slate-500); text-transform:uppercase; font-weight:700;">Grand
                                                    Total</span>
                                                <div style="font-size:17px; font-weight:800; color:var(--navy);"><span
                                                        id="lblGrandTotal">527</span> / 600</div>
                                            </div>
                                            <div>
                                                <span
                                                    style="font-size:11px; color:var(--slate-500); text-transform:uppercase; font-weight:700;">Percentage</span>
                                                <div style="font-size:17px; font-weight:800; color:var(--orange);"><span
                                                        id="lblPercentage">87.83</span>%</div>
                                                <input type="hidden" name="total_percentage" id="total_percentage"
                                                    value="87.83">
                                            </div>
                                            <div>
                                                <span
                                                    style="font-size:11px; color:var(--slate-500); text-transform:uppercase; font-weight:700;">Overall
                                                    Grade</span>
                                                <div style="font-size:17px; font-weight:800; color:#059669;"><span
                                                        id="lblOverallGrade">A</span></div>
                                                <input type="hidden" name="overall_grade" id="overall_grade" value="A">
                                            </div>
                                        </div>
                                        <span
                                            style="font-size:12px; color:var(--slate-500); font-weight:600; display:inline-flex; align-items:center; gap:5px;">
                                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none"
                                                stroke="var(--orange)" stroke-width="2.2" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2" />
                                            </svg>
                                            Auto-calculated in real time
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- Section 4: Passport Photo Upload -->
                            <div class="form-section">
                                <div class="section-label">
                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2">
                                        <rect x="3" y="3" width="18" height="18" rx="2" ry="2" />
                                        <circle cx="8.5" cy="8.5" r="1.5" />
                                        <polyline points="21 15 16 10 5 21" />
                                    </svg>
                                    <span data-en="4. Student Passport Photo" data-hi="4. छात्र का पासपोर्ट फोटो">4.
                                        Student Passport Photo</span>
                                </div>

                                <div class="photo-upload-wrap">
                                    <div class="preview-box" id="previewBox">
                                        <div class="preview-placeholder" id="previewPlaceholder">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="1.5">
                                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                                                <circle cx="12" cy="7" r="4" />
                                            </svg>
                                            <span data-en="Photo Preview" data-hi="फोटो पूर्वावलोकन">Photo
                                                Preview</span>
                                        </div>
                                        <img id="photoPreviewImg" src="" alt="Student Preview" style="display:none;">
                                    </div>

                                    <div class="upload-input-wrap">
                                        <input type="file" name="file" id="photoFileInput" accept="image/*"
                                            style="display:none;" onchange="handlePhotoSelect(event)">
                                        <button type="button" class="btn-choose-file"
                                            onclick="document.getElementById('photoFileInput').click()">
                                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2">
                                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                                                <polyline points="17 8 12 3 7 8" />
                                                <line x1="12" y1="3" x2="12" y2="15" />
                                            </svg>
                                            <span data-en="Choose Passport Photo" data-hi="पासपोर्ट फोटो चुनें">Choose
                                                Passport Photo</span>
                                        </button>
                                        <p class="upload-note"
                                            data-en="Upload JPG, PNG or WEBP image. System will automatically resize & optimize it to 413 × 531 px for high-resolution certificate synthesis."
                                            data-hi="JPG, PNG या WEBP फोटो अपलोड करें। सिस्टम इसे हाई-रेज़ोल्यूशन सर्टिफिकेट के लिए स्वतः 413 × 531 px में ऑप्टिमाइज़ करेगा।">
                                            Upload JPG, PNG or WEBP image. System will automatically resize & optimize
                                            it to <strong>413 &times; 531 px</strong> for high-resolution certificate
                                            synthesis.
                                        </p>
                                        <span id="selectedFileName"
                                            style="font-size:12px; font-weight:700; color:var(--orange);"></span>
                                    </div>
                                </div>
                            </div>

                            <!-- Form Actions -->
                            <div class="form-actions">
                                <button type="submit" name="submit" class="btn-submit">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2.5">
                                        <polyline points="20 6 9 17 4 12" />
                                    </svg>
                                    <span data-en="Save Record & Generate Certificate"
                                        data-hi="रिकॉर्ड सुरक्षित करें और सर्टिफिकेट बनाएं">Save Record & Generate
                                        Certificate</span>
                                </button>
                                <button type="reset" class="btn-reset" onclick="resetPreview()" data-en="Clear Form"
                                    data-hi="फॉर्म साफ़ करें">Clear Form</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Right Quick Records Sidebar -->
                <div class="quick-records-card">
                    <div class="quick-records-header">
                        <h3 data-en="Recently Added" data-hi="हाल ही में जोड़े गए">Recently Added</h3>
                        <a href="admin-user-all.php"
                            style="font-size:12px; color:var(--orange); font-weight:700; text-decoration:none;"
                            data-en="View All →" data-hi="सभी देखें →">View All &rarr;</a>
                    </div>

                    <?php if (empty($recent_students)): ?>
                        <p style="font-size:13px; color:var(--slate-500); text-align:center; padding:20px 0;">No student
                            records found.</p>
                    <?php else: ?>
                        <div class="recent-list">
                            <?php foreach ($recent_students as $st):
                                $p_img = !empty($st['photo']) ? 'certificate/' . $st['photo'] : 'certificate/pass.png_thump.png';
                                ?>
                                <div class="recent-item">
                                    <img src="<?= htmlspecialchars($p_img) ?>" alt="Photo" class="recent-thumb"
                                        onerror="this.src='certificate/pass.png_thump.png'">
                                    <div class="recent-meta">
                                        <div class="recent-name"><?= htmlspecialchars($st['name']) ?></div>
                                        <div class="recent-roll">Roll: <?= htmlspecialchars($st['roll']) ?></div>
                                        <span class="recent-course-tag"><?= htmlspecialchars($st['course']) ?></span>
                                    </div>
                                    <a href="certificate/index.php?of=<?= urlencode($st['roll']) ?>&cor=<?= urlencode($st['course']) ?>"
                                        target="_blank" class="recent-action-btn" title="View Certificate">
                                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2">
                                            <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6" />
                                            <polyline points="15 3 21 3 21 9" />
                                            <line x1="10" y1="14" x2="21" y2="3" />
                                        </svg>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
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

        // Live Image Preview Handler
        function handlePhotoSelect(event) {
            const file = event.target.files[0];
            const nameEl = document.getElementById('selectedFileName');
            const previewImg = document.getElementById('photoPreviewImg');
            const placeholder = document.getElementById('previewPlaceholder');

            if (file) {
                nameEl.textContent = 'Selected: ' + file.name + ' (' + Math.round(file.size / 1024) + ' KB)';
                const reader = new FileReader();
                reader.onload = function (e) {
                    previewImg.src = e.target.result;
                    previewImg.style.display = 'block';
                    placeholder.style.display = 'none';
                };
                reader.readAsDataURL(file);
            }
        }

        function resetPreview() {
            const previewImg = document.getElementById('photoPreviewImg');
            const placeholder = document.getElementById('previewPlaceholder');
            const nameEl = document.getElementById('selectedFileName');
            if (previewImg) previewImg.style.display = 'none';
            if (placeholder) placeholder.style.display = 'block';
            if (nameEl) nameEl.textContent = '';
        }

        // Quick Sample Fill for fast testing
        function fillSampleData() {
            const randomRoll = 'UP01' + Math.floor(2500 + Math.random() * 500);
            const randomEnroll = 'UP01' + Math.floor(2600 + Math.random() * 500);
            document.getElementById('s_name').value = 'Amit Kumar';
            document.getElementById('f_name').value = 'Rajesh Kumar';
            document.getElementById('m_name').value = 'Geeta Devi';
            document.getElementById('dob').value = '15-Aug-2002';
            document.getElementById('gender').value = 'male';
            document.getElementById('course').value = 'ADCA';
            document.getElementById('duration').value = '1 Year';
            document.getElementById('e_number').value = randomEnroll;
            document.getElementById('r_number').value = randomRoll;
            calcMarks();
        }

        // Live Marksheet Calculation
        function toggleMarksheetView(enabled) {
            const container = document.getElementById('marksheetContainer');
            if (container) {
                container.style.opacity = enabled ? '1' : '0.4';
                container.querySelectorAll('input').forEach(inp => {
                    if (inp.id !== 'toggleMarksheet') inp.disabled = !enabled;
                });
            }
        }

        function getGradeFromScore(score) {
            if (score >= 90) return 'A+';
            if (score >= 80) return 'A';
            if (score >= 70) return 'B';
            if (score >= 60) return 'C';
            if (score >= 50) return 'D';
            return 'F';
        }

        function calcMarks() {
            const rows = document.querySelectorAll('#subjectsTableBody tr');
            let grandTotal = 0;
            let maxMarks = rows.length * 100;

            rows.forEach(tr => {
                const th = parseFloat(tr.querySelector('.sub-theory').value) || 0;
                const pr = parseFloat(tr.querySelector('.sub-practical').value) || 0;
                const tot = th + pr;
                grandTotal += tot;

                tr.querySelector('.sub-total').textContent = tot;
                const gr = getGradeFromScore(tot);
                tr.querySelector('.sub-grade-badge').textContent = gr;
                tr.querySelector('.sub-grade-val').value = gr;
            });

            const pct = maxMarks > 0 ? ((grandTotal / maxMarks) * 100).toFixed(2) : '0.00';
            const overallGr = getGradeFromScore(parseFloat(pct));

            document.getElementById('lblGrandTotal').textContent = grandTotal;
            document.getElementById('lblPercentage').textContent = pct;
            document.getElementById('lblOverallGrade').textContent = overallGr;

            document.getElementById('total_percentage').value = pct;
            document.getElementById('overall_grade').value = overallGr;
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

        // Run calculation and default English language on initial load
        document.addEventListener('DOMContentLoaded', function () {
            calcMarks();
            setAdminLang(localStorage.getItem('scait_lang_v2') || 'en');
        });
    </script>
</body>

</html>