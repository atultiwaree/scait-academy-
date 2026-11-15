<?php
// Prevent PHP warnings from corrupting output
error_reporting(E_ALL & ~E_DEPRECATED & ~E_NOTICE);

require_once __DIR__ . '/../connection.php';
require_once __DIR__ . '/generate_cert.php';

$of = isset($_GET['of']) ? trim($_GET['of']) : '';
$cor = isset($_GET['cor']) ? trim($_GET['cor']) : '';

if (empty($of)) {
    header('Location: ../index.php?error=' . urlencode('Please enter your Roll Number or Enrollment Number.') . '#verify');
    exit;
}

// Fetch student record
$student = getStudent($of);

if (!$student && !empty($cor)) {
    $stmt = mysqli_prepare($con, "SELECT * FROM s_cer_det WHERE (roll = ? OR enroll = ?) AND course = ? LIMIT 1");
    mysqli_stmt_bind_param($stmt, "sss", $of, $of, $cor);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    $student = mysqli_fetch_assoc($res);
    mysqli_stmt_close($stmt);
}

if (!$student) {
    header('Location: ../index.php?error=' . urlencode("No certificate found for '$of'. Please verify your Roll Number or contact SCAIT office.") . '#verify');
    exit;
}

$name = $student['name'] ?? '';
$fname = $student['fname'] ?? '';
$mname = $student['mname'] ?? '';
$enroll = $student['enroll'] ?? '';
$roll = $student['roll'] ?? '';
$dob = $student['dob'] ?? '';
$course_name = $student['course'] ?? '';
$duration = $student['duration'] ?? '1 Year';
$session = $student['session'] ?? '';
$grade = $student['grade'] ?? 'A';
$percentage = $student['percentage'] ?? '';
$issue_date = $student['issue_date'] ?? $dob;
$photo = $student['photo'] ?? '';
$hasSubjects = !empty($student['subjects_json']) && $student['subjects_json'] !== '[]';

// Ensure photo path works in browser
$displayPhoto = $photo;
if (!empty($displayPhoto) && !preg_match('~^https?://~i', $displayPhoto)) {
    $displayPhoto = '../' . ltrim($displayPhoto, '/');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <title>Official Certificate & Marksheet — <?php echo htmlspecialchars($name); ?> (Roll: <?php echo htmlspecialchars($roll); ?>) | SCAIT</title>
    <link rel="shortcut icon" href="../images/fav.ico" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Outfit:wght@600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --navy: #002147;
            --navy-dark: #061326;
            --navy-card: #0d1f3c;
            --orange: #e66030;
            --orange-hover: #cf4f20;
            --blue: #2563eb;
            --blue-hover: #1d4ed8;
            --emerald: #10b981;
            --slate-300: #cbd5e1;
            --slate-400: #94a3b8;
            --white: #ffffff;
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: radial-gradient(circle at 50% 0%, #102a52 0%, #061021 75%);
            color: var(--white);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            -webkit-font-smoothing: antialiased;
        }

        /* ── Top Navigation Bar ── */
        .viewer-nav {
            background: rgba(6, 16, 33, 0.88);
            backdrop-filter: blur(14px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            position: sticky;
            top: 0;
            z-index: 100;
            padding: 12px 24px;
        }
        .viewer-nav-inner {
            max-width: 960px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 14px;
        }
        .viewer-brand {
            display: flex;
            align-items: center;
            gap: 14px;
            color: var(--white);
            text-decoration: none;
        }
        .brand-divider {
            width: 1px;
            height: 24px;
            background: rgba(255, 255, 255, 0.16);
        }
        .portal-tag {
            font-size: 12px;
            font-weight: 600;
            color: var(--slate-300);
            letter-spacing: 0.3px;
        }
        .viewer-actions {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
        }
        .nav-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            padding: 8px 14px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.18s ease;
            border: 1px solid rgba(255, 255, 255, 0.12);
            background: rgba(255, 255, 255, 0.05);
            color: var(--slate-300);
        }
        .nav-btn:hover {
            background: rgba(255, 255, 255, 0.12);
            color: var(--white);
            border-color: rgba(255, 255, 255, 0.22);
        }
        .nav-btn-verify {
            background: rgba(16, 185, 129, 0.12);
            color: #34d399;
            border-color: rgba(16, 185, 129, 0.3);
        }
        .nav-btn-verify:hover {
            background: rgba(16, 185, 129, 0.22);
            color: #6ee7b7;
            border-color: rgba(16, 185, 129, 0.45);
        }

        /* ── Main Container ── */
        .cert-container {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 28px 16px 48px;
            max-width: 992px;
            margin: 0 auto;
            width: 100%;
        }

        /* ── Unified Control & Student Card ── */
        .unified-header-card {
            width: 100%;
            background: rgba(13, 31, 60, 0.78);
            border: 1px solid rgba(255, 255, 255, 0.12);
            border-radius: 14px;
            box-shadow: 0 16px 40px rgba(0, 0, 0, 0.35);
            margin-bottom: 22px;
            overflow: hidden;
        }
        .student-top-row {
            padding: 18px 22px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            flex-wrap: wrap;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        }
        .student-meta {
            display: flex;
            align-items: center;
            gap: 16px;
        }
        .student-avatar {
            width: 54px;
            height: 64px;
            border-radius: 8px;
            object-fit: cover;
            border: 1.5px solid rgba(255, 255, 255, 0.25);
            background: #1e293b;
            flex-shrink: 0;
        }
        .student-title-row {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
            margin-bottom: 6px;
        }
        .student-title-row h1 {
            font-size: 19px;
            font-weight: 800;
            color: var(--white);
            font-family: 'Outfit', sans-serif;
            letter-spacing: 0.2px;
        }
        .verified-pill {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 3px 10px;
            border-radius: 999px;
            font-size: 11.5px;
            font-weight: 700;
            background: rgba(16, 185, 129, 0.15);
            color: #34d399;
            border: 1px solid rgba(16, 185, 129, 0.3);
        }
        .meta-grid {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 8px 18px;
            font-size: 12.5px;
            color: var(--slate-300);
        }
        .meta-item {
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }
        .meta-item span {
            color: var(--slate-400);
        }
        .meta-item strong {
            color: var(--white);
            font-weight: 700;
        }
        .course-highlight {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 5px 12px;
            border-radius: 8px;
            background: rgba(230, 96, 48, 0.14);
            border: 1px solid rgba(230, 96, 48, 0.32);
            color: #ff9d79;
            font-size: 12.5px;
            font-weight: 700;
        }

        /* ── Bottom Control Bar (Tabs + Download Actions) ── */
        .control-bar-row {
            background: rgba(6, 16, 33, 0.55);
            padding: 12px 22px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 14px;
            flex-wrap: wrap;
        }
        .doc-tabs {
            display: inline-flex;
            gap: 6px;
            background: rgba(0, 0, 0, 0.35);
            padding: 4px;
            border-radius: 10px;
            border: 1px solid rgba(255, 255, 255, 0.08);
        }
        .doc-tab {
            padding: 8px 16px;
            border-radius: 7px;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
            border: none;
            background: transparent;
            color: var(--slate-400);
            transition: all 0.18s ease;
            display: inline-flex;
            align-items: center;
            gap: 7px;
            font-family: inherit;
        }
        .doc-tab.active {
            background: var(--navy);
            color: var(--white);
            border: 1px solid rgba(255, 255, 255, 0.16);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.25);
        }
        .doc-tab:hover:not(.active) {
            color: var(--white);
            background: rgba(255, 255, 255, 0.05);
        }

        .download-group {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }
        .btn-dl {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 9px 18px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.18s ease;
            border: none;
            cursor: pointer;
        }
        .btn-dl-diploma {
            background: var(--orange);
            color: var(--white);
            box-shadow: 0 4px 12px rgba(230, 96, 48, 0.35);
        }
        .btn-dl-diploma:hover {
            background: var(--orange-hover);
            transform: translateY(-1px);
        }
        .btn-dl-marksheet {
            background: var(--blue);
            color: var(--white);
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.35);
        }
        .btn-dl-marksheet:hover {
            background: var(--blue-hover);
            transform: translateY(-1px);
        }

        /* ── Certificate Preview Stage ── */
        .cert-card {
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 24px 60px rgba(0, 0, 0, 0.55);
            width: 100%;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.18);
        }
        .cert-card img {
            width: 100%;
            height: auto;
            display: block;
        }
        .doc-panel {
            display: none;
            width: 100%;
        }
        .doc-panel.active {
            display: block;
        }

        /* ── Language Switcher Pill ── */
        .lang-pill {
            display: inline-flex;
            align-items: center;
            background: rgba(255, 255, 255, 0.06);
            border: 1px solid rgba(255, 255, 255, 0.14);
            border-radius: 8px;
            padding: 2px;
        }
        .lang-opt {
            padding: 5px 10px;
            font-size: 12px;
            font-weight: 700;
            color: var(--slate-300);
            background: transparent;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.16s ease;
            font-family: inherit;
        }
        .lang-opt.active {
            background: var(--orange);
            color: var(--white);
        }

        /* ── Footer ── */
        .viewer-footer {
            text-align: center;
            padding: 20px 16px 28px;
            font-size: 12.5px;
            color: var(--slate-400);
            border-top: 1px solid rgba(255, 255, 255, 0.06);
        }

        @media (max-width: 640px) {
            .brand-divider, .portal-tag { display: none; }
            .control-bar-row { flex-direction: column; align-items: stretch; }
            .doc-tabs { width: 100%; justify-content: center; }
            .doc-tab { flex: 1; justify-content: center; }
            .download-group { width: 100%; }
            .btn-dl { flex: 1; }
        }

        @media print {
            .viewer-nav, .unified-header-card, .viewer-footer { display: none !important; }
            body { background: white !important; }
            .cert-container { padding: 0 !important; max-width: 100% !important; }
            .cert-card { box-shadow: none !important; border: none !important; border-radius: 0 !important; }
            .doc-panel { display: none !important; }
            .doc-panel.active { display: block !important; }
        }
    </style>
</head>
<body>
    <!-- Top Institutional Bar -->
    <header class="viewer-nav">
        <div class="viewer-nav-inner">
            <a href="../index.php" class="viewer-brand" aria-label="SCAIT Academy Home">
                <img src="../images/logo-light.svg" alt="SCAIT Academy" style="height:34px;width:auto;" onerror="this.src='../images/logo.png'">
                <span class="brand-divider"></span>
                <span class="portal-tag" data-en="Official Certificate &amp; Result Portal" data-hi="आधिकारिक प्रमाणपत्र एवं रिजल्ट पोर्टल">Official Certificate &amp; Result Portal</span>
            </a>
            <div class="viewer-actions">
                <div class="lang-pill" aria-label="Language Switcher">
                    <button type="button" class="lang-opt active" id="certLangEn" onclick="setCertLang('en')">English</button>
                    <button type="button" class="lang-opt" id="certLangHi" onclick="setCertLang('hi')">हिन्दी</button>
                </div>
                <a href="../index.php" class="nav-btn">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
                    <span data-en="Back to Home" data-hi="होम पेज">Back to Home</span>
                </a>
                <a href="../veriy/<?php echo urlencode($roll); ?>" target="_blank" class="nav-btn nav-btn-verify">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="m9 12 2 2 4-4"/></svg>
                    <span data-en="Verify Online" data-hi="ऑनलाइन सत्यापन">Verify Online</span>
                </a>
                <button type="button" onclick="window.print()" class="nav-btn">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 6 2 18 2 18 9"/><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/><rect x="6" y="14" width="12" height="8"/></svg>
                    <span data-en="Print" data-hi="प्रिंट करें">Print</span>
                </button>
            </div>
        </div>
    </header>

    <main class="cert-container">
        <!-- Unified Student & Action Toolbar -->
        <div class="unified-header-card">
            <div class="student-top-row">
                <div class="student-meta">
                    <?php if (!empty($displayPhoto)): ?>
                        <img src="<?php echo htmlspecialchars($displayPhoto); ?>" alt="<?php echo htmlspecialchars($name); ?>" class="student-avatar" onerror="this.style.display='none'">
                    <?php endif; ?>
                    <div>
                        <div class="student-title-row">
                            <h1><?php echo htmlspecialchars($name); ?></h1>
                            <span class="verified-pill">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                                <span data-en="Verified SCAIT Record" data-hi="सत्यापित SCAIT रिकॉर्ड">Verified SCAIT Record</span>
                            </span>
                        </div>
                        <div class="meta-grid">
                            <div class="meta-item">
                                <span data-en="Father's Name:" data-hi="पिता का नाम:">Father's Name:</span>
                                <strong><?php echo htmlspecialchars($fname); ?></strong>
                            </div>
                            <div class="meta-item">
                                <span data-en="Roll No:" data-hi="रोल नंबर:">Roll No:</span>
                                <strong><?php echo htmlspecialchars($roll); ?></strong>
                            </div>
                            <div class="meta-item">
                                <span data-en="Enrollment No:" data-hi="एनरोलमेंट नं:">Enrollment No:</span>
                                <strong><?php echo htmlspecialchars($enroll); ?></strong>
                            </div>
                            <?php if (!empty($percentage)): ?>
                            <div class="meta-item">
                                <span data-en="Score:" data-hi="प्राप्तांक:">Score:</span>
                                <strong><?php echo htmlspecialchars($percentage); ?>% (Grade <?php echo htmlspecialchars($grade); ?>)</strong>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="course-highlight">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>
                    <?php echo htmlspecialchars($course_name); ?> &bull; <?php echo htmlspecialchars($duration); ?>
                </div>
            </div>

            <div class="control-bar-row">
                <!-- Document Type Switcher -->
                <div class="doc-tabs" role="tablist">
                    <button type="button" class="doc-tab active" onclick="switchDoc('diploma', this)">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="6"/><path d="M15.477 12.89 17 22l-5-3-5 3 1.523-9.11"/></svg>
                        <span data-en="Diploma Certificate" data-hi="डिप्लोमा प्रमाणपत्र">Diploma Certificate</span>
                    </button>
                    <?php if ($hasSubjects || !empty($percentage)): ?>
                    <button type="button" class="doc-tab" onclick="switchDoc('marksheet', this)">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
                        <span data-en="Marksheet / Result" data-hi="अंकतालिका / रिजल्ट">Marksheet / Result</span>
                    </button>
                    <?php endif; ?>
                </div>

                <!-- Single Clean Pair of Download Buttons -->
                <div class="download-group">
                    <a href="download.php?id=<?php echo urlencode($roll); ?>&type=diploma" class="btn-dl btn-dl-diploma">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                        <span data-en="Download Diploma" data-hi="डिप्लोमा डाउनलोड">Download Diploma</span>
                    </a>
                    <?php if ($hasSubjects || !empty($percentage)): ?>
                    <a href="download.php?id=<?php echo urlencode($roll); ?>&type=marksheet" class="btn-dl btn-dl-marksheet">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                        <span data-en="Download Marksheet" data-hi="मार्कशीट डाउनलोड">Download Marksheet</span>
                    </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Panel 1: Diploma Preview -->
        <div id="panel-diploma" class="doc-panel active">
            <div class="cert-card">
                <img src="download.php?id=<?php echo urlencode($roll); ?>&type=diploma&action=view" alt="Diploma Certificate for <?php echo htmlspecialchars($name); ?>" loading="eager">
            </div>
        </div>

        <!-- Panel 2: Marksheet Preview -->
        <?php if ($hasSubjects || !empty($percentage)): ?>
        <div id="panel-marksheet" class="doc-panel">
            <div class="cert-card">
                <img src="download.php?id=<?php echo urlencode($roll); ?>&type=marksheet&action=view" alt="Marksheet for <?php echo htmlspecialchars($name); ?>" loading="lazy">
            </div>
        </div>
        <?php endif; ?>
    </main>

    <footer class="viewer-footer">
        &copy; <?php echo date('Y'); ?> Student Computer Academy of IT (SCAIT), Mahewa Road, Tewa, Kaushambi. All rights reserved.
    </footer>

    <script>
        function switchDoc(type, tabEl) {
            document.querySelectorAll('.doc-tab').forEach(t => t.classList.remove('active'));
            document.querySelectorAll('.doc-panel').forEach(p => p.classList.remove('active'));
            tabEl.classList.add('active');
            const panel = document.getElementById('panel-' + type);
            if (panel) panel.classList.add('active');
        }

        function setCertLang(lang) {
            if (lang !== 'en' && lang !== 'hi') lang = 'en';
            localStorage.setItem('scait_lang_v2', lang);
            document.documentElement.lang = lang;

            const btnEn = document.getElementById('certLangEn');
            const btnHi = document.getElementById('certLangHi');
            if (btnEn) btnEn.classList.toggle('active', lang === 'en');
            if (btnHi) btnHi.classList.toggle('active', lang === 'hi');

            document.querySelectorAll('[data-en][data-hi]').forEach(el => {
                const val = el.getAttribute('data-' + lang);
                if (val) el.innerHTML = val;
            });
        }

        // Default to English unless explicitly selected
        setCertLang(localStorage.getItem('scait_lang_v2') || 'en');
    </script>
</body>
</html>
