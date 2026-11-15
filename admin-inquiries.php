<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: index.php?error=" . urlencode("Please login as Admin first"));
    exit();
}

require_once('connection.php');

$logged_user = htmlspecialchars($_SESSION['user']);

// Delete lead if requested
if (isset($_GET['del'])) {
    $del_id = intval($_GET['del']);
    $del_stmt = mysqli_prepare($con, "DELETE FROM s_adm WHERE id = ?");
    if ($del_stmt) {
        mysqli_stmt_bind_param($del_stmt, "i", $del_id);
        mysqli_stmt_execute($del_stmt);
    }
    header("Location: admin-inquiries.php");
    exit();
}

$result = mysqli_query($con, "SELECT * FROM s_adm ORDER BY id DESC");
$total_inquiries = $result ? mysqli_num_rows($result) : 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <title>Admission Inquiries | SCAIT Admin Console</title>
    <link rel="shortcut icon" href="images/fav.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Outfit:wght@500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --navy: #06182e;
            --navy-dark: #040d1a;
            --orange: #f97316;
            --slate-100: #f1f5f9;
            --slate-200: #e2e8f0;
            --slate-500: #64748b;
            --slate-600: #475569;
            --slate-700: #334155;
            --slate-800: #1e293b;
            --white: #ffffff;
            --radius-md: 12px;
            --radius-lg: 16px;
            --radius-full: 9999px;
            --shadow-sm: 0 1px 3px rgba(6, 24, 46, 0.05);
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Plus Jakarta Sans', system-ui, sans-serif; background: #f1f5f9; color: var(--slate-800); min-height: 100vh; display: flex; }

        .admin-sidebar { width: 270px; background: linear-gradient(180deg, #040d1a 0%, #06182e 100%); color: var(--white); display: flex; flex-direction: column; position: fixed; top: 0; bottom: 0; left: 0; z-index: 1000; transition: transform 0.3s ease; border-right: 1px solid rgba(255, 255, 255, 0.08); }
        .sidebar-brand { padding: 24px 20px 20px; border-bottom: 1px solid rgba(255, 255, 255, 0.08); }
        .sidebar-brand img { height: 38px; }
        .sidebar-nav { padding: 20px 14px; flex: 1; overflow-y: auto; display: flex; flex-direction: column; gap: 6px; }
        .sidebar-heading { font-size: 10.5px; font-weight: 800; letter-spacing: 1.2px; text-transform: uppercase; color: rgba(255, 255, 255, 0.4); padding: 10px 12px 4px; }
        .sidebar-link { display: flex; align-items: center; gap: 12px; padding: 10px 14px; border-radius: var(--radius-md); color: rgba(255, 255, 255, 0.72); text-decoration: none; font-size: 13.5px; font-weight: 600; transition: all 0.2s ease; }
        .sidebar-link:hover { background: rgba(255, 255, 255, 0.07); color: var(--white); }
        .sidebar-link.active { background: linear-gradient(90deg, rgba(249, 115, 22, 0.22) 0%, rgba(249, 115, 22, 0.08) 100%); color: #fdba74; border-left: 3px solid var(--orange); font-weight: 700; }
        .sidebar-link .icon { width: 18px; height: 18px; flex-shrink: 0; }
        .sidebar-user { padding: 16px 18px; border-top: 1px solid rgba(255, 255, 255, 0.08); background: rgba(4, 13, 26, 0.4); display: flex; align-items: center; justify-content: space-between; }
        .user-avatar { width: 36px; height: 36px; border-radius: var(--radius-full); background: linear-gradient(135deg, var(--orange) 0%, #c2410c 100%); color: var(--white); display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 14px; }
        .user-name { font-size: 13px; font-weight: 700; color: var(--white); }
        .user-role { font-size: 11px; color: rgba(255, 255, 255, 0.5); }
        .btn-logout-icon { background: rgba(255, 255, 255, 0.06); border: 1px solid rgba(255, 255, 255, 0.1); color: #f87171; width: 32px; height: 32px; border-radius: var(--radius-md); display: inline-flex; align-items: center; justify-content: center; text-decoration: none; }

        .admin-main { margin-left: 270px; flex: 1; display: flex; flex-direction: column; min-width: 0; }
        .admin-topbar { height: 64px; background: var(--white); border-bottom: 1px solid var(--slate-200); display: flex; align-items: center; justify-content: space-between; padding: 0 28px; position: sticky; top: 0; z-index: 99; box-shadow: var(--shadow-sm); }
        .breadcrumb-text { font-size: 13.5px; color: var(--slate-500); display: flex; align-items: center; gap: 6px; }
        .breadcrumb-text strong { color: var(--navy); font-weight: 700; }
        .topbar-right { display: flex; align-items: center; gap: 12px; }
        .lang-pill { display: inline-flex; align-items: center; background: var(--slate-100); border: 1px solid var(--slate-200); border-radius: 999px; padding: 2px; }
        .lang-pill button { background: transparent; border: none; color: var(--slate-600); font-size: 11.5px; font-weight: 700; padding: 4px 10px; border-radius: 999px; cursor: pointer; font-family: inherit; transition: all 0.2s ease; }
        .lang-pill button.active { background: var(--navy); color: var(--white); }
        .admin-content { padding: 28px; max-width: 1400px; width: 100%; margin: 0 auto; }

        .table-card { background: var(--white); border-radius: var(--radius-lg); border: 1px solid var(--slate-200); box-shadow: var(--shadow-sm); overflow: hidden; }
        table.records-table { width: 100%; border-collapse: collapse; text-align: left; font-size: 13.5px; }
        table.records-table thead th { background: #fafaf9; color: var(--slate-600); font-weight: 800; font-size: 11.5px; letter-spacing: 0.5px; text-transform: uppercase; padding: 14px 18px; border-bottom: 1.5px solid var(--slate-200); }
        table.records-table tbody td { padding: 14px 18px; border-bottom: 1px solid var(--slate-100); vertical-align: middle; color: var(--slate-700); }
        table.records-table tbody tr:hover td { background: #fbfcfe; }

        .btn-call { display: inline-flex; align-items: center; gap: 6px; padding: 6px 12px; background: #ecfdf5; color: #059669; text-decoration: none; font-size: 12px; font-weight: 700; border-radius: var(--radius-md); border: 1px solid #a7f3d0; }
        .btn-wa { display: inline-flex; align-items: center; gap: 6px; padding: 6px 12px; background: #f0fdf4; color: #16a34a; text-decoration: none; font-size: 12px; font-weight: 700; border-radius: var(--radius-md); border: 1px solid #bbf7d0; margin-left: 6px; }
        .btn-del { width: 30px; height: 30px; border-radius: var(--radius-md); background: rgba(239, 68, 68, 0.08); color: #ef4444; display: inline-flex; align-items: center; justify-content: center; text-decoration: none; border: 1px solid rgba(239, 68, 68, 0.2); }

        .drawer-overlay { display: none; position: fixed; inset: 0; background: rgba(4, 13, 26, 0.6); z-index: 999; }
        @media (max-width: 992px) {
            .admin-sidebar { transform: translateX(-100%); }
            .admin-sidebar.open { transform: translateX(0); }
            .drawer-overlay.open { display: block; }
            .admin-main { margin-left: 0; }
        }
    </style>
</head>
<body>
    <div class="drawer-overlay" id="drawerOverlay" onclick="toggleSidebar()"></div>

    <aside class="admin-sidebar" id="adminSidebar">
        <div class="sidebar-brand">
            <a href="index.php"><img src="images/logo-light.svg" alt="SCAIT Academy" onerror="this.src='images/logo.png'"></a>
        </div>
        <nav class="sidebar-nav">
            <span class="sidebar-heading" data-en="Certificate Management" data-hi="सर्टिफिकेट प्रबंधन">Certificate Management</span>
            <a href="admin-user-add.php" class="sidebar-link">
                <span class="icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 5v14M5 12h14"/></svg></span>
                <span data-en="Add Student Certificate" data-hi="छात्र सर्टिफिकेट जोड़ें">Add Student Certificate</span>
            </a>
            <a href="admin-user-all.php" class="sidebar-link">
                <span class="icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg></span>
                <span data-en="All Student Records" data-hi="सभी छात्र रिकॉर्ड">All Student Records</span>
            </a>

            <span class="sidebar-heading" style="margin-top:14px;" data-en="Website & Inquiries" data-hi="वेबसाइट एवं पूछताछ">Website & Inquiries</span>
            <a href="admin-gallery.php" class="sidebar-link">
                <span class="icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg></span>
                <span data-en="Homepage Photos" data-hi="होमपेज फोटो">Homepage Photos</span>
            </a>
            <a href="admin-inquiries.php" class="sidebar-link active">
                <span class="icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg></span>
                <span data-en="Admission Inquiries" data-hi="प्रवेश पूछताछ">Admission Inquiries</span>
                <span style="margin-left:auto; background:rgba(249,115,22,0.25); color:#fdba74; font-size:11px; font-weight:800; padding:2px 7px; border-radius:999px;"><?= $total_inquiries ?></span>
            </a>

            <span class="sidebar-heading" style="margin-top:14px;" data-en="Exam Portal" data-hi="परीक्षा पोर्टल">Exam Portal</span>
            <a href="add_question.php" class="sidebar-link">
                <span class="icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg></span>
                <span data-en="Question Bank" data-hi="प्रश्न बैंक">Question Bank</span>
            </a>

            <span class="sidebar-heading" style="margin-top:14px;" data-en="Quick Actions" data-hi="त्वरित विकल्प">Quick Actions</span>
            <a href="index.php" target="_blank" class="sidebar-link">
                <span class="icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg></span>
                <span data-en="View Public Website" data-hi="मुख्य वेबसाइट देखें">View Public Website</span>
            </a>
        </nav>
        <div class="sidebar-user">
            <div style="display:flex; align-items:center; gap:10px;">
                <div class="user-avatar"><?= strtoupper(substr($logged_user, 0, 1)) ?></div>
                <div><div class="user-name"><?= $logged_user ?></div><div class="user-role" data-en="Super Admin" data-hi="सुपर एडमिन">Super Admin</div></div>
            </div>
            <a href="logout.php" class="btn-logout-icon" title="Logout"><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg></a>
        </div>
    </aside>

    <main class="admin-main">
        <header class="admin-topbar">
            <div class="breadcrumb-text"><span data-en="Admin Console" data-hi="एडमिन कंसोल">Admin Console</span><span>/</span><strong data-en="Admission Inquiries (<?= $total_inquiries ?>)" data-hi="प्रवेश पूछताछ (<?= $total_inquiries ?>)">Admission Inquiries (<?= $total_inquiries ?>)</strong></div>
            <div class="topbar-right">
                <div class="lang-pill" aria-label="Language Switcher">
                    <button type="button" id="admLangEn" class="active" onclick="setAdminLang('en')">English</button>
                    <button type="button" id="admLangHi" onclick="setAdminLang('hi')">हिन्दी</button>
                </div>
                <a href="admin-user-add.php" style="font-size:12.5px; font-weight:700; color:var(--orange); text-decoration:none;" data-en="+ Add Certificate" data-hi="+ सर्टिफिकेट जोड़ें">+ Add Certificate</a>
            </div>
        </header>

        <div class="admin-content">
            <div class="table-card">
                <table class="records-table">
                    <thead>
                        <tr>
                            <th data-en="Lead ID" data-hi="लीड आईडी">Lead ID</th>
                            <th data-en="Inquirer Name" data-hi="छात्र का नाम">Inquirer Name</th>
                            <th data-en="Phone Number" data-hi="मोबाइल नंबर">Phone Number</th>
                            <th data-en="Village / Town" data-hi="गाँव / पता">Village / Town</th>
                            <th style="text-align:right;" data-en="Actions" data-hi="कार्य">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($result && mysqli_num_rows($result) > 0): ?>
                            <?php while ($r = mysqli_fetch_assoc($result)): 
                                $clean_phone = preg_replace('/[^0-9]/', '', $r['Phone']);
                            ?>
                                <tr>
                                    <td><strong style="color:var(--navy);">#<?= $r['id'] ?></strong></td>
                                    <td><strong style="font-size:14px; color:var(--navy);"><?= htmlspecialchars($r['Name']) ?></strong></td>
                                    <td>
                                        <a href="tel:<?= htmlspecialchars($clean_phone) ?>" style="font-weight:700; color:var(--slate-800); text-decoration:none; font-family:monospace; font-size:13px;">
                                            <?= htmlspecialchars($r['Phone']) ?>
                                        </a>
                                    </td>
                                    <td><?= htmlspecialchars($r['Address']) ?></td>
                                    <td style="text-align:right;">
                                        <a href="tel:<?= htmlspecialchars($clean_phone) ?>" class="btn-call">
                                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                                            <span data-en="Call" data-hi="कॉल करें">Call</span>
                                        </a>
                                        <a href="https://api.whatsapp.com/send?phone=+91<?= htmlspecialchars($clean_phone) ?>&text=Hello%20<?= urlencode($r['Name']) ?>,%20regarding%20your%20admission%20inquiry%20at%20SCAIT%20Academy..." target="_blank" class="btn-wa">
                                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/></svg>
                                            WhatsApp
                                        </a>
                                        <a href="admin-inquiries.php?del=<?= $r['id'] ?>" class="btn-del" onclick="return confirm('Delete this inquiry?');" style="margin-left:8px;" title="Delete Inquiry">
                                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                                        </a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr><td colspan="5" style="text-align:center; padding:30px;" data-en="No admission inquiries yet." data-hi="अभी तक कोई प्रवेश पूछताछ नहीं है।">No admission inquiries yet.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <script>
        function toggleSidebar() {
            const sb = document.getElementById('adminSidebar');
            const ov = document.getElementById('drawerOverlay');
            if (sb && ov) { sb.classList.toggle('open'); ov.classList.toggle('open'); }
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

