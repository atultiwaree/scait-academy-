<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: index.php?error=" . urlencode("Please login as Admin first"));
    exit();
}

require_once('connection.php');

$logged_user = htmlspecialchars($_SESSION['user']);
$filter_course = isset($_GET['course']) ? trim($_GET['course']) : '';

if ($filter_course !== '') {
    $stmt = mysqli_prepare($con, "SELECT * FROM s_cer_det WHERE course = ? ORDER BY id DESC");
    mysqli_stmt_bind_param($stmt, "s", $filter_course);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
} else {
    $result = mysqli_query($con, "SELECT * FROM s_cer_det ORDER BY id DESC");
}

// Counts for filter pills
$courses = ['ADCA', 'TALLY', 'TYPING', 'CCC', 'DCA', 'DTP'];
$course_counts = [];
$tot_res = mysqli_query($con, "SELECT COUNT(*) as c FROM s_cer_det");
$total_all = $tot_res ? mysqli_fetch_assoc($tot_res)['c'] : 0;

foreach ($courses as $c) {
    $c_stmt = mysqli_prepare($con, "SELECT COUNT(*) as c FROM s_cer_det WHERE course = ?");
    mysqli_stmt_bind_param($c_stmt, "s", $c);
    mysqli_stmt_execute($c_stmt);
    $c_res = mysqli_stmt_get_result($c_stmt);
    $course_counts[$c] = $c_res ? mysqli_fetch_assoc($c_res)['c'] : 0;
}

$inq_res = mysqli_query($con, "SELECT COUNT(*) as c FROM s_adm");
$total_inquiries = $inq_res ? mysqli_fetch_assoc($inq_res)['c'] : 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <title>All Student Records | SCAIT Admin Console</title>
    <link rel="shortcut icon" href="images/fav.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Outfit:wght@500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --navy: #06182e;
            --navy-dark: #040d1a;
            --navy-surface: #0a223e;
            --orange: #f97316;
            --orange-hover: #ea580c;
            --orange-light: #fff7ed;
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
            --radius-full: 9999px;
            --shadow-sm: 0 1px 3px rgba(6, 24, 46, 0.05);
            --shadow-md: 0 4px 16px rgba(6, 24, 46, 0.08);
        }

        *, *::before, *::after {
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
        .btn-add-primary {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 18px;
            background: linear-gradient(180deg, #fb923c 0%, #ea580c 100%);
            color: var(--white);
            text-decoration: none;
            font-size: 13px;
            font-weight: 800;
            border-radius: var(--radius-md);
            box-shadow: 0 2px 8px rgba(234, 88, 12, 0.3);
            transition: all 0.2s ease;
        }
        .btn-add-primary:hover {
            background: linear-gradient(180deg, #f97316 0%, #c2410c 100%);
            transform: translateY(-1px);
        }

        /* ── Content ── */
        .admin-content {
            padding: 28px;
            max-width: 1400px;
            width: 100%;
            margin: 0 auto;
        }

        /* ── Filter Pills Bar ── */
        .filter-bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            margin-bottom: 22px;
            flex-wrap: wrap;
        }
        .filter-pills {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
        }
        .pill-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 7px 14px;
            border-radius: var(--radius-full);
            background: var(--white);
            border: 1px solid var(--slate-200);
            color: var(--slate-600);
            text-decoration: none;
            font-size: 12.5px;
            font-weight: 700;
            transition: all 0.2s ease;
        }
        .pill-btn:hover {
            border-color: var(--navy);
            color: var(--navy);
        }
        .pill-btn.active {
            background: var(--navy);
            color: var(--white);
            border-color: var(--navy);
        }
        .pill-count {
            display: inline-block;
            font-size: 10.5px;
            padding: 1px 6px;
            border-radius: 999px;
            background: rgba(0, 0, 0, 0.08);
        }
        .pill-btn.active .pill-count {
            background: rgba(255, 255, 255, 0.25);
            color: var(--white);
        }

        .search-input-wrap {
            position: relative;
            min-width: 260px;
        }
        .search-input {
            width: 100%;
            height: 38px;
            padding: 0 14px 0 36px;
            border-radius: var(--radius-full);
            border: 1.5px solid var(--slate-200);
            background: var(--white);
            font-size: 13px;
            outline: none;
            font-family: inherit;
        }
        .search-input:focus {
            border-color: var(--orange);
            box-shadow: 0 0 0 3px rgba(249, 115, 22, 0.12);
        }
        .search-icon {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--slate-400);
            pointer-events: none;
        }

        /* ── Table Container ── */
        .table-card {
            background: var(--white);
            border-radius: var(--radius-lg);
            border: 1px solid var(--slate-200);
            box-shadow: var(--shadow-sm);
            overflow: hidden;
        }
        .table-responsive {
            width: 100%;
            overflow-x: auto;
        }
        table.records-table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
            font-size: 13.5px;
        }
        table.records-table thead th {
            background: #fafaf9;
            color: var(--slate-600);
            font-weight: 800;
            font-size: 11.5px;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            padding: 14px 18px;
            border-bottom: 1.5px solid var(--slate-200);
            white-space: nowrap;
        }
        table.records-table tbody td {
            padding: 14px 18px;
            border-bottom: 1px solid var(--slate-100);
            vertical-align: middle;
            color: var(--slate-700);
        }
        table.records-table tbody tr:hover td {
            background: #fbfcfe;
        }
        .student-cell {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .student-avatar {
            width: 44px;
            height: 54px;
            border-radius: 6px;
            object-fit: cover;
            background: var(--slate-100);
            border: 1px solid var(--slate-200);
            flex-shrink: 0;
        }
        .student-info strong {
            display: block;
            font-size: 13.5px;
            color: var(--navy);
            font-weight: 800;
        }
        .student-info span {
            font-size: 11.5px;
            color: var(--slate-500);
        }
        .code-pill {
            font-family: monospace;
            font-size: 12px;
            font-weight: 700;
            padding: 2px 7px;
            background: var(--slate-100);
            border: 1px solid var(--slate-200);
            border-radius: 4px;
            color: var(--slate-800);
        }
        .course-badge {
            display: inline-block;
            font-size: 11px;
            font-weight: 800;
            padding: 3px 8px;
            border-radius: var(--radius-full);
            background: #fff7ed;
            color: var(--orange);
            border: 1px solid rgba(249, 115, 22, 0.25);
        }
        .action-btns {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .btn-action-view {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            background: rgba(6, 24, 46, 0.05);
            color: var(--navy);
            text-decoration: none;
            font-size: 12px;
            font-weight: 700;
            border-radius: var(--radius-md);
            border: 1px solid rgba(6, 24, 46, 0.1);
            transition: all 0.2s ease;
        }
        .btn-action-view:hover {
            background: var(--navy);
            color: var(--white);
        }
        .btn-action-delete {
            width: 32px;
            height: 32px;
            border-radius: var(--radius-md);
            background: rgba(239, 68, 68, 0.08);
            color: #ef4444;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            border: 1px solid rgba(239, 68, 68, 0.2);
            transition: all 0.2s ease;
        }
        .btn-action-delete:hover {
            background: #ef4444;
            color: var(--white);
        }

        .drawer-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(4, 13, 26, 0.6);
            backdrop-filter: blur(4px);
            z-index: 999;
        }
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

    <!-- ── Mobile Drawer Overlay ── -->
    <div class="drawer-overlay" id="drawerOverlay" onclick="toggleSidebar()"></div>

    <!-- ── Sidebar ── -->
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
            <a href="admin-user-all.php" class="sidebar-link active">
                <span class="icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                </span>
                <span data-en="All Student Records" data-hi="सभी छात्र रिकॉर्ड">All Student Records</span>
            </a>

            <span class="sidebar-heading" style="margin-top:14px;" data-en="Website & Inquiries" data-hi="वेबसाइट एवं पूछताछ">Website & Inquiries</span>
            <a href="admin-gallery.php" class="sidebar-link">
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
            <a href="index.php" target="_blank" class="sidebar-link">
                <span class="icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
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
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
            </a>
        </div>
    </aside>

    <!-- ── Main Area ── -->
    <main class="admin-main">
        <header class="admin-topbar">
            <div class="topbar-left">
                <button class="mobile-toggle" onclick="toggleSidebar()" aria-label="Toggle Menu">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
                </button>
                <div class="breadcrumb-text">
                    <span data-en="Admin Console" data-hi="एडमिन कंसोल">Admin Console</span>
                    <span>/</span>
                    <strong data-en="All Student Records" data-hi="सभी छात्र रिकॉर्ड">All Student Records</strong>
                </div>
            </div>
            <div class="topbar-right">
                <div class="lang-pill" aria-label="Language Switcher">
                    <button type="button" id="admLangEn" class="active" onclick="setAdminLang('en')">English</button>
                    <button type="button" id="admLangHi" onclick="setAdminLang('hi')">हिन्दी</button>
                </div>
                <a href="admin-user-add.php" class="btn-add-primary">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 5v14M5 12h14"/></svg>
                    <span data-en="Add New Student" data-hi="नया छात्र जोड़ें">Add New Student</span>
                </a>
            </div>
        </header>

        <div class="admin-content">
            <!-- Filter Bar -->
            <div class="filter-bar">
                <div class="filter-pills">
                    <a href="admin-user-all.php" class="pill-btn <?= ($filter_course === '') ? 'active' : '' ?>">
                        <span data-en="All Records" data-hi="सभी रिकॉर्ड">All Records</span> <span class="pill-count"><?= $total_all ?></span>
                    </a>
                    <?php foreach ($courses as $c): ?>
                        <a href="admin-user-all.php?course=<?= urlencode($c) ?>" class="pill-btn <?= ($filter_course === $c) ? 'active' : '' ?>">
                            <?= $c ?> <span class="pill-count"><?= $course_counts[$c] ?></span>
                        </a>
                    <?php endforeach; ?>
                </div>

                <div class="search-input-wrap">
                    <svg class="search-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                    <input type="text" id="recordSearch" class="search-input" placeholder="Search by name or roll..." data-ph-en="Search by name or roll..." data-ph-hi="नाम या रोल नंबर से खोजें..." onkeyup="filterTable()">
                </div>
            </div>

            <!-- Table Card -->
            <div class="table-card">
                <div class="table-responsive">
                    <table class="records-table" id="studentsTable">
                        <thead>
                            <tr>
                                <th data-en="Student" data-hi="छात्र">Student</th>
                                <th data-en="Father's Name" data-hi="पिता का नाम">Father's Name</th>
                                <th data-en="Mother's Name" data-hi="माता का नाम">Mother's Name</th>
                                <th data-en="Roll No" data-hi="रोल नंबर">Roll No</th>
                                <th data-en="Enroll No" data-hi="नामांकन सं.">Enroll No</th>
                                <th data-en="Course" data-hi="कोर्स">Course</th>
                                <th data-en="Duration" data-hi="अवधि">Duration</th>
                                <th data-en="DOB" data-hi="जन्म तिथि">DOB</th>
                                <th style="text-align:right;" data-en="Actions" data-hi="कार्य">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($result && mysqli_num_rows($result) > 0): ?>
                                <?php while ($st = mysqli_fetch_assoc($result)): 
                                    $raw_photo = $st['photo'] ?? '';
                                    if (empty($raw_photo)) {
                                        $p_img = 'certificate/pass.png_thump.png';
                                    } elseif (file_exists($raw_photo)) {
                                        $p_img = $raw_photo;
                                    } elseif (file_exists('certificate/' . $raw_photo)) {
                                        $p_img = 'certificate/' . $raw_photo;
                                    } else {
                                        $p_img = $raw_photo;
                                    }
                                ?>
                                    <tr>
                                        <td>
                                            <div class="student-cell">
                                                <img src="<?= htmlspecialchars($p_img) ?>" alt="Photo" class="student-avatar" onerror="this.src='certificate/pass.png_thump.png'">
                                                <div class="student-info">
                                                    <strong class="st-name"><?= htmlspecialchars($st['name']) ?></strong>
                                                    <span><?= htmlspecialchars(ucfirst($st['gender'] ?? 'Student')) ?> <?= !empty($st['session']) ? '· Session ' . htmlspecialchars($st['session']) : '' ?></span>
                                                </div>
                                            </div>
                                        </td>
                                        <td><?= htmlspecialchars($st['fname']) ?></td>
                                        <td><?= htmlspecialchars($st['mname']) ?></td>
                                        <td>
                                            <span class="code-pill st-roll"><?= htmlspecialchars($st['roll']) ?></span>
                                        </td>
                                        <td>
                                            <span class="code-pill"><?= htmlspecialchars($st['enroll']) ?></span>
                                        </td>
                                        <td>
                                            <span class="course-badge"><?= htmlspecialchars($st['course']) ?></span>
                                        </td>
                                        <td style="font-weight:600; font-size:12.5px;"><?= htmlspecialchars($st['duration']) ?></td>
                                        <td style="font-size:12px; color:var(--slate-500);"><?= htmlspecialchars($st['dob']) ?></td>
                                        <td style="text-align:right;">
                                            <div class="action-btns" style="justify-content:flex-end;">
                                                <a href="certificate/index.php?of=<?= urlencode($st['roll']) ?>&cor=<?= urlencode($st['course']) ?>" target="_blank" class="btn-action-view" title="View & Download Certificate/Diploma">
                                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                                    <span data-en="View" data-hi="देखें">View</span>
                                                </a>
                                                <a href="veriy/<?= urlencode($st['roll']) ?>" target="_blank" class="btn-action-view" style="background:#ecfdf5; color:#065f46; border-color:#a7f3d0;" title="Verify Online">
                                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="m9 12 2 2 4-4"/></svg>
                                                    <span data-en="Verify" data-hi="सत्यापन">Verify</span>
                                                </a>
                                                <a href="del_su_cer_det.php?id=<?= $st['id'] ?>" class="btn-action-delete" title="Delete Record" onclick="return confirmDeleteStudent();">
                                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="9" style="text-align:center; padding: 40px 20px; color:var(--slate-400);">
                                        <p style="font-size:15px; font-weight:700; color:var(--slate-600); margin-bottom:8px;" data-en="No student records found" data-hi="कोई छात्र रिकॉर्ड नहीं मिला">No student records found</p>
                                        <a href="admin-user-add.php" class="btn-add-primary" style="display:inline-flex; margin-top:8px;" data-en="Add New Record" data-hi="नया रिकॉर्ड जोड़ें">Add New Record</a>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
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

        function confirmDeleteStudent() {
            const lang = localStorage.getItem('scait_lang_v2') || 'en';
            const msg = lang === 'hi'
                ? 'क्या आप वाकई इस छात्र का रिकॉर्ड डिलीट करना चाहते हैं?'
                : 'Are you sure you want to delete this student record?';
            return confirm(msg);
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
            const searchInp = document.getElementById('recordSearch');
            if (searchInp) {
                searchInp.placeholder = searchInp.getAttribute('data-ph-' + lang) || 'Search by name or roll...';
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            setAdminLang(localStorage.getItem('scait_lang_v2') || 'en');
        });

        function filterTable() {
            const query = document.getElementById('recordSearch').value.toLowerCase();
            const rows = document.querySelectorAll('#studentsTable tbody tr');
            rows.forEach(r => {
                const nameEl = r.querySelector('.st-name');
                const rollEl = r.querySelector('.st-roll');
                if (!nameEl || !rollEl) return;
                const nameText = nameEl.textContent.toLowerCase();
                const rollText = rollEl.textContent.toLowerCase();
                if (nameText.includes(query) || rollText.includes(query)) {
                    r.style.display = '';
                } else {
                    r.style.display = 'none';
                }
            });
        }
    </script>
</body>
</html>
