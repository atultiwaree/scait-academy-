<?php
$current_year = (int) date('Y');
$next_year_short = substr((string) ($current_year + 1), -2);
$current_session = $current_year . '-' . $next_year_short;
$years_of_excellence = $current_year - 2008;

$msg = "";
$msg_type = "info";
if (isset($_GET['error'])) {
    $msg = htmlspecialchars($_GET['error']);
    $msg_type = (stripos($msg, 'done') !== false || stripos($msg, 'registered') !== false || stripos($msg, 'success') !== false) ? "success" : "warning";
}
?>
<!DOCTYPE html>
<html lang="hi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <title>Student Computer Academy of IT (SCAIT) | Tewa, Kaushambi</title>
    <meta name="description"
        content="SCAIT Academy Tewa, Kaushambi. Government registered computer institute offering ADCA, CCC, Tally Prime, Hindi-English Typing with 100% practical lab practice and online certificate verification.">
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
            --navy-light: #0d284a;
            --navy-surface: #0a223e;
            --orange: #f97316;
            --orange-hover: #ea580c;
            --orange-light: #fff7ed;
            --orange-glow: rgba(249, 115, 22, 0.28);
            --gold: #f59e0b;
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
            --radius-sm: 8px;
            --radius-md: 12px;
            --radius-lg: 16px;
            --radius-xl: 20px;
            --radius-full: 9999px;
            --shadow-sm: 0 1px 2px rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 14px rgba(6, 24, 46, 0.07);
            --shadow-lg: 0 12px 28px rgba(6, 24, 46, 0.1);
            --shadow-xl: 0 20px 40px -10px rgba(4, 13, 26, 0.22);
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html {
            scroll-behavior: smooth;
            -webkit-tap-highlight-color: transparent;
        }

        body {
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, sans-serif;
            color: var(--slate-800);
            background-color: var(--slate-50);
            line-height: 1.6;
            overflow-x: hidden;
            padding-bottom: 74px;
        }

        @media (min-width: 992px) {
            body {
                padding-bottom: 0;
            }
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: 'Outfit', sans-serif;
            color: var(--navy);
            line-height: 1.25;
            letter-spacing: -0.02em;
        }

        a {
            color: inherit;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        img {
            max-width: 100%;
            height: auto;
            display: block;
        }

        .container {
            width: 100%;
            max-width: 1240px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            line-height: 1;
        }

        .icon svg {
            width: 100%;
            height: 100%;
        }

        /* ── Top Announcement Utility Bar ── */
        .top-bar {
            background: var(--navy-dark);
            color: rgba(255, 255, 255, 0.85);
            font-size: 12.5px;
            padding: 7px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            display: none;
        }

        @media (min-width: 992px) {
            .top-bar {
                display: block;
            }
        }

        .top-bar-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
        }

        .top-items {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .top-item {
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .top-badge {
            background: rgba(249, 115, 22, 0.2);
            color: #fdba74;
            padding: 2px 8px;
            border-radius: var(--radius-full);
            font-size: 11px;
            font-weight: 700;
            border: 1px solid rgba(249, 115, 22, 0.35);
        }

        .top-links {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .top-links a {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-size: 12px;
        }

        .top-links a:hover {
            color: var(--white);
        }

        .top-divider {
            color: rgba(255, 255, 255, 0.2);
        }

        /* ── Site Header & Apple-Style Glass Navbar ── */
        .site-header {
            background: rgba(255, 255, 255, 0.65);
            backdrop-filter: blur(32px) saturate(200%);
            -webkit-backdrop-filter: blur(32px) saturate(200%);
            position: sticky;
            top: 0;
            z-index: 1000;
            border-bottom: 1px solid rgba(255, 255, 255, 0.6);
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.8), 0 4px 20px rgba(6, 24, 46, 0.04);
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .header-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 66px;
            gap: 16px;
        }

        @media (max-width: 991px) {
            .header-inner {
                height: 58px;
            }
        }

        .brand {
            display: flex;
            align-items: center;
            text-decoration: none;
            flex-shrink: 0;
            transition: opacity 0.2s ease;
        }

        .brand:hover {
            opacity: 0.9;
        }

        .brand-logo-img {
            height: 42px;
            width: auto;
            object-fit: contain;
            display: block;
        }

        @media (max-width: 768px) {
            .brand-logo-img {
                height: 35px;
            }
        }

        .nav-menu {
            display: none;
            align-items: center;
            gap: 4px;
            list-style: none;
        }

        @media (min-width: 992px) {
            .nav-menu {
                display: flex;
            }
        }

        .nav-item {
            font-size: 13.5px;
            font-weight: 600;
            color: rgba(6, 24, 46, 0.8);
            padding: 7px 12px;
            border-radius: var(--radius-full);
            white-space: nowrap;
            transition: all 0.2s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .nav-item:hover {
            color: var(--navy);
            background: rgba(6, 24, 46, 0.06);
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-shrink: 0;
        }

        .header-desktop-btn {
            display: none !important;
        }

        @media (min-width: 992px) {

            .header-desktop-btn {
                display: inline-flex !important;
            }
        }

        /* ── Apple-Style Language Switcher (Desktop Header & Drawer) ── */
        .site-header .lang-switcher {
            display: none !important;
        }

        @media (min-width: 992px) {
            .site-header .lang-switcher {
                display: inline-flex !important;
            }
        }

        .lang-switcher {
            align-items: center;
            background: rgba(6, 24, 46, 0.06);
            border: 1px solid rgba(6, 24, 46, 0.12);
            border-radius: var(--radius-full);
            padding: 2px;
            gap: 2px;
            user-select: none;
        }

        .lang-btn {
            padding: 4px 9px;
            border-radius: var(--radius-full);
            color: var(--slate-600);
            transition: all 0.2s cubic-bezier(0.16, 1, 0.3, 1);
            background: transparent;
            border: none;
            font-family: inherit;
            font-size: 11.5px;
            font-weight: 700;
            cursor: pointer;
            line-height: 1;
        }

        .lang-btn.active {
            background: var(--navy);
            color: var(--white);
            box-shadow: 0 1px 4px rgba(6, 24, 46, 0.15);
        }


        .btn-glass {
            background: rgba(6, 24, 46, 0.04);
            color: var(--navy);
            border: 1px solid rgba(6, 24, 46, 0.12);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            font-size: 13px;
            font-weight: 700;
            padding: 8px 16px;
            border-radius: var(--radius-full);
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.7);
            transition: all 0.2s ease;
        }

        .btn-glass:hover {
            background: rgba(6, 24, 46, 0.08);
            border-color: rgba(6, 24, 46, 0.2);
            transform: translateY(-1px);
        }

        .btn-apple-primary {
            background: linear-gradient(180deg, #fb923c 0%, #ea580c 100%);
            color: var(--white);
            font-size: 13px;
            font-weight: 700;
            padding: 8px 18px;
            border-radius: var(--radius-full);
            border: 1px solid rgba(255, 255, 255, 0.25);
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.35), 0 3px 12px rgba(234, 88, 12, 0.35);
            transition: all 0.2s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .btn-apple-primary:hover {
            background: linear-gradient(180deg, #f97316 0%, #c2410c 100%);
            transform: translateY(-1px);
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.4), 0 5px 16px rgba(234, 88, 12, 0.45);
        }

        .header-mobile-whatsapp {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 38px;
            height: 38px;
            border-radius: var(--radius-full);
            background: rgba(37, 211, 102, 0.15);
            color: #25d366;
            border: 1px solid rgba(37, 211, 102, 0.35);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            transition: all 0.2s ease;
        }

        .header-mobile-whatsapp:hover {
            background: #25d366;
            color: #ffffff;
            transform: translateY(-1px);
        }

        @media (min-width: 992px) {
            .header-mobile-whatsapp {
                display: none;
            }
        }

        .mobile-menu-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 38px;
            height: 38px;
            border-radius: var(--radius-full);
            border: 1px solid rgba(0, 0, 0, 0.08);
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            color: var(--navy);
            cursor: pointer;
            transition: all 0.2s ease;
        }

        @media (min-width: 992px) {
            .mobile-menu-btn {
                display: none;
            }
        }

        /* ── Standard Buttons ── */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 9px 18px;
            border-radius: var(--radius-full);
            font-size: 13.5px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.2s cubic-bezier(0.16, 1, 0.3, 1);
            border: none;
            outline: none;
            white-space: nowrap;
            text-decoration: none;
        }

        .btn-primary {
            background: var(--orange);
            color: var(--white);
            box-shadow: 0 4px 14px var(--orange-glow);
        }

        .btn-primary:hover {
            background: var(--orange-hover);
            transform: translateY(-1px);
        }

        .btn-navy {
            background: var(--navy);
            color: var(--white);
        }

        .btn-navy:hover {
            background: var(--navy-light);
            transform: translateY(-1px);
        }

        .btn-outline {
            background: transparent;
            border: 1.5px solid var(--slate-300);
            color: var(--slate-700);
        }

        .btn-outline:hover {
            border-color: var(--navy);
            color: var(--navy);
            background: var(--slate-50);
        }

        .btn-outline-white {
            background: transparent;
            border: 1.5px solid rgba(255, 255, 255, 0.35);
            color: var(--white);
        }

        .btn-outline-white:hover {
            background: var(--white);
            color: var(--navy);
            border-color: var(--white);
        }

        .btn-whatsapp {
            background: #25D366;
            color: var(--white);
            box-shadow: 0 4px 14px rgba(37, 211, 102, 0.3);
        }

        .btn-whatsapp:hover {
            background: #20bd5a;
            transform: translateY(-1px);
        }

        .btn-sm {
            padding: 7px 14px;
            font-size: 12.5px;
        }

        .btn-lg {
            padding: 12px 24px;
            font-size: 14.5px;
        }

        /* ── Humanized Warm Hero Section ── */
        .hero {
            position: relative;
            background: linear-gradient(135deg, #040d1a 0%, #06182e 55%, #0d284a 100%);
            color: var(--white);
            padding: 38px 0 54px;
            overflow: hidden;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        }

        @media (min-width: 992px) {
            .hero {
                padding: 54px 0 68px;
            }
        }

        .hero-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 32px;
            align-items: center;
            position: relative;
            z-index: 1;
        }

        @media (min-width: 992px) {
            .hero-grid {
                grid-template-columns: 1.15fr 0.85fr;
                gap: 48px;
            }
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 5px 12px;
            background: rgba(249, 115, 22, 0.16);
            border: 1px solid rgba(249, 115, 22, 0.35);
            border-radius: var(--radius-full);
            color: #fdba74;
            font-size: 12.5px;
            font-weight: 700;
            margin-bottom: 16px;
        }

        .hero-title {
            font-size: 28px;
            font-weight: 800;
            color: var(--white);
            margin-bottom: 14px;
            letter-spacing: -0.02em;
            line-height: 1.25;
        }

        @media (min-width: 768px) {
            .hero-title {
                font-size: 40px;
            }
        }

        .hero-title span {
            background: linear-gradient(135deg, #fb923c 0%, #f97316 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .hero-desc {
            font-size: 15px;
            color: rgba(255, 255, 255, 0.85);
            margin-bottom: 22px;
            max-width: 530px;
            line-height: 1.7;
        }

        .hero-actions {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
            margin-bottom: 28px;
        }

        .hero-stats {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 10px;
            padding-top: 18px;
            border-top: 1px solid rgba(255, 255, 255, 0.12);
        }

        @media (max-width: 600px) {
            .hero-stats {
                grid-template-columns: repeat(2, 1fr);
                gap: 14px;
            }
        }

        .stat-item strong {
            display: block;
            font-size: 20px;
            font-family: 'Outfit', sans-serif;
            font-weight: 800;
            color: #fdba74;
            line-height: 1;
        }

        .stat-item span {
            display: block;
            font-size: 11.5px;
            color: rgba(255, 255, 255, 0.7);
            margin-top: 4px;
        }

        /* ── Student Desk Card in Hero ── */
        .terminal-card {
            background: var(--white);
            border-radius: var(--radius-xl);
            padding: 24px 20px;
            color: var(--slate-900);
            box-shadow: var(--shadow-xl);
            border: 1px solid rgba(255, 255, 255, 0.3);
            position: relative;
        }

        @media (min-width: 768px) {
            .terminal-card {
                padding: 28px 24px;
            }
        }

        .terminal-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 14px;
            padding-bottom: 12px;
            border-bottom: 1px solid var(--slate-100);
        }

        .terminal-header-title {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .terminal-header-icon {
            width: 36px;
            height: 36px;
            border-radius: var(--radius-md);
            background: var(--orange-light);
            color: var(--orange);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .terminal-header-title h3 {
            font-size: 16px;
            font-weight: 800;
            color: var(--navy);
            line-height: 1.2;
        }

        .terminal-header-title p {
            font-size: 11.5px;
            color: var(--slate-500);
        }

        .terminal-live-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 11px;
            font-weight: 700;
            color: var(--green);
            background: var(--green-light);
            padding: 3px 9px;
            border-radius: var(--radius-full);
        }

        .terminal-tabs {
            display: grid;
            grid-template-columns: 1fr 1fr;
            background: var(--slate-100);
            padding: 4px;
            border-radius: var(--radius-md);
            margin-bottom: 18px;
            gap: 4px;
        }

        .terminal-tab {
            padding: 8px 6px;
            font-size: 12.5px;
            font-weight: 700;
            color: var(--slate-600);
            background: transparent;
            border: none;
            border-radius: var(--radius-sm);
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            white-space: nowrap;
        }

        .terminal-tab.active {
            background: var(--navy);
            color: var(--white);
            box-shadow: 0 2px 8px rgba(6, 24, 46, 0.2);
        }

        .terminal-panel {
            display: none;
        }

        .terminal-panel.active {
            display: block;
            animation: fadeIn 0.25s ease;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-label {
            display: block;
            font-size: 12px;
            font-weight: 700;
            color: var(--slate-700);
            margin-bottom: 5px;
        }

        .input-wrap {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-icon-left {
            position: absolute;
            left: 14px;
            color: var(--slate-400);
            pointer-events: none;
        }

        .form-control {
            width: 100%;
            height: 46px;
            padding: 0 16px 0 42px;
            border-radius: var(--radius-md);
            border: 1.5px solid var(--slate-200);
            background: var(--slate-50);
            font-family: inherit;
            font-size: 14px;
            color: var(--slate-900);
            transition: all 0.2s;
            outline: none;
        }

        .form-control.no-icon {
            padding: 0 14px;
        }

        .form-control:focus {
            background: var(--white);
            border-color: var(--orange);
            box-shadow: 0 0 0 3px rgba(249, 115, 22, 0.15);
        }

        .form-helper {
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 11px;
            color: var(--slate-500);
            margin-top: 4px;
        }

        /* ── Courses Section ── */
        .courses-section {
            padding: 56px 0 70px;
            background: var(--slate-50);
        }

        .section-header {
            text-align: center;
            max-width: 680px;
            margin: 0 auto 38px;
        }

        .section-pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 11.5px;
            font-weight: 800;
            color: var(--orange);
            background: var(--orange-light);
            padding: 4px 12px;
            border-radius: var(--radius-full);
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .section-title {
            font-size: 26px;
            font-weight: 800;
            color: var(--navy);
            margin-bottom: 10px;
            letter-spacing: -0.02em;
        }

        @media (min-width: 768px) {
            .section-title {
                font-size: 34px;
            }
        }

        .section-desc {
            font-size: 14.5px;
            color: var(--slate-600);
            line-height: 1.65;
        }

        .courses-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 22px;
        }

        .course-card {
            background: var(--white);
            border-radius: var(--radius-lg);
            border: 1.5px solid var(--slate-200);
            padding: 24px;
            transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
            display: flex;
            flex-direction: column;
            position: relative;
        }

        .course-card:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-lg);
            border-color: rgba(249, 115, 22, 0.35);
        }

        .course-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .course-code {
            font-size: 20px;
            font-weight: 800;
            color: var(--navy);
            letter-spacing: -0.5px;
        }

        .course-badge {
            font-size: 11px;
            font-weight: 700;
            color: var(--navy);
            background: var(--slate-100);
            padding: 3px 9px;
            border-radius: var(--radius-full);
        }

        .course-badge.highlight {
            background: var(--orange-light);
            color: var(--orange);
        }

        .course-name {
            font-size: 16px;
            font-weight: 700;
            color: var(--slate-800);
            margin-bottom: 8px;
            line-height: 1.35;
        }

        .course-desc {
            font-size: 13px;
            color: var(--slate-600);
            margin-bottom: 16px;
            flex-grow: 1;
            line-height: 1.6;
        }

        .course-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 5px;
            gap: 6px;
            margin-bottom: 16px;
        }

        .course-tag {
            font-size: 11px;
            background: var(--slate-100);
            color: var(--slate-700);
            padding: 3px 8px;
            border-radius: 6px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 11.5px;
            background: #f8fafc;
            border: 1px solid var(--slate-200);
            color: var(--slate-800);
            padding: 4px 10px 4px 7px;
            border-radius: 7px;
            font-weight: 600;
            line-height: 1;
            height: 27px;
            transition: all 0.2s ease;
        }

        .course-card:hover .course-tag {
            border-color: var(--slate-300);
            background: var(--white);
        }

        .course-tag .sw-icon {
            width: 16px;
            height: 16px;
            min-width: 16px;
            min-height: 16px;
            flex-shrink: 0;
            display: block;
        }

        .course-meta {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 8px;
            padding: 10px 12px;
            background: var(--slate-50);
            border-radius: var(--radius-md);
            margin-bottom: 16px;
            font-size: 11.5px;
        }

        .course-meta-item strong {
            display: block;
            color: var(--navy);
            font-size: 12.5px;
        }

        .course-meta-item span {
            color: var(--slate-500);
        }

        .course-btn {
            width: 100%;
        }

        /* ── Human Notice Banner Under Courses ── */
        .human-notice-box {
            margin-top: 36px;
            background: linear-gradient(135deg, #fff7ed 0%, #ffedd5 100%);
            border: 1px solid #fed7aa;
            border-radius: var(--radius-lg);
            padding: 20px 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 16px;
        }

        .human-notice-text strong {
            display: block;
            font-size: 15px;
            color: #9a3412;
            margin-bottom: 2px;
        }

        .human-notice-text p {
            font-size: 13px;
            color: #7c2d12;
        }

        /* ── Dedicated Certificate Hub Section ── */
        .cert-hub-section {
            padding: 64px 0;
            background: var(--white);
            border-top: 1px solid var(--slate-200);
        }

        .cert-hub-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 36px;
            align-items: center;
        }

        @media (min-width: 992px) {
            .cert-hub-grid {
                grid-template-columns: 1fr 1fr;
                gap: 48px;
            }
        }

        .cert-steps-list {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 14px;
            margin: 20px 0;
        }

        .cert-step-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
        }

        .cert-step-num {
            width: 26px;
            height: 26px;
            border-radius: 50%;
            background: var(--orange-light);
            color: var(--orange);
            font-size: 12.5px;
            font-weight: 800;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            margin-top: 2px;
        }

        .cert-step-text strong {
            display: block;
            font-size: 14px;
            color: var(--navy);
        }

        .cert-step-text p {
            font-size: 12.5px;
            color: var(--slate-600);
            margin-top: 2px;
        }

        .cert-showcase-card {
            background: linear-gradient(135deg, #040d1a 0%, #06182e 100%);
            border-radius: var(--radius-xl);
            padding: 28px 24px;
            color: var(--white);
            box-shadow: var(--shadow-xl);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .cert-showcase-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            padding: 4px 12px;
            border-radius: var(--radius-full);
            font-size: 11.5px;
            font-weight: 700;
            color: #fdba74;
            margin-bottom: 18px;
        }

        .cert-showcase-preview {
            background: var(--white);
            border-radius: var(--radius-md);
            padding: 18px;
            color: var(--slate-800);
            margin-bottom: 20px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.25);
        }

        .cert-preview-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1.5px solid var(--slate-100);
            padding-bottom: 10px;
            margin-bottom: 10px;
        }

        .cert-preview-logo strong {
            font-family: 'Outfit', sans-serif;
            color: var(--navy);
            font-size: 14px;
            display: block;
        }

        .cert-preview-logo span {
            font-size: 10.5px;
            color: var(--slate-500);
        }

        .cert-preview-seal {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: var(--orange-light);
            color: var(--orange);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .cert-preview-meta {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 8px;
            font-size: 11px;
            color: var(--slate-600);
        }

        .cert-preview-meta strong {
            color: var(--navy);
            font-size: 12px;
        }

        /* ── Founder's Desk & Facilities ── */
        .features-section {
            padding: 64px 0;
            background: var(--slate-50);
            border-top: 1px solid var(--slate-200);
        }

        .founder-quote-card {
            background: var(--white);
            border-radius: var(--radius-xl);
            padding: 30px;
            border-left: 4px solid var(--orange);
            box-shadow: var(--shadow-sm);
            margin-bottom: 36px;
            border-top: 1px solid var(--slate-200);
            border-right: 1px solid var(--slate-200);
            border-bottom: 1px solid var(--slate-200);
        }

        .founder-quote-text {
            font-size: 16px;
            font-style: italic;
            color: var(--slate-700);
            line-height: 1.7;
            margin-bottom: 16px;
        }

        .founder-author {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .founder-avatar {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background: var(--navy);
            color: var(--white);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 16px;
            flex-shrink: 0;
        }

        .founder-author strong {
            display: block;
            font-size: 14.5px;
            color: var(--navy);
        }

        .founder-author span {
            font-size: 12px;
            color: var(--slate-500);
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .feature-card {
            background: var(--white);
            padding: 24px 20px;
            border-radius: var(--radius-lg);
            border: 1px solid var(--slate-200);
            transition: all 0.25s ease;
        }

        .feature-card:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
            border-color: rgba(6, 24, 46, 0.15);
        }

        .feature-icon-box {
            width: 42px;
            height: 42px;
            border-radius: var(--radius-md);
            background: var(--orange-light);
            color: var(--orange);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 14px;
        }

        .feature-title {
            font-size: 16px;
            font-weight: 700;
            color: var(--navy);
            margin-bottom: 6px;
        }

        .feature-desc {
            font-size: 13px;
            color: var(--slate-600);
            line-height: 1.6;
        }

        /* ── Classroom Gallery ── */
        .gallery-section {
            padding: 64px 0;
            background: var(--white);
            border-top: 1px solid var(--slate-200);
        }

        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
        }

        @media (min-width: 768px) {
            .gallery-grid {
                grid-template-columns: repeat(3, 1fr);
                gap: 16px;
            }
        }

        .gallery-item {
            border-radius: var(--radius-md);
            overflow: hidden;
            aspect-ratio: 4 / 3;
            background: var(--slate-200);
            position: relative;
        }

        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.35s ease;
        }

        .gallery-item:hover img {
            transform: scale(1.04);
        }

        /* ── Location & Contact ── */
        .contact-section {
            padding: 64px 0;
            background: var(--slate-50);
            border-top: 1px solid var(--slate-200);
        }

        .contact-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 30px;
        }

        @media (min-width: 992px) {
            .contact-grid {
                grid-template-columns: 1fr 1fr;
                gap: 38px;
            }
        }

        .contact-card {
            background: var(--white);
            border-radius: var(--radius-xl);
            padding: 28px 22px;
            border: 1px solid var(--slate-200);
            box-shadow: var(--shadow-sm);
        }

        @media (min-width: 768px) {
            .contact-card {
                padding: 32px 28px;
            }
        }

        .contact-info-list {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 16px;
            margin-top: 18px;
        }

        .contact-info-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
        }

        .contact-icon-frame {
            width: 38px;
            height: 38px;
            border-radius: var(--radius-md);
            background: var(--slate-100);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .contact-info-text strong {
            display: block;
            font-size: 14px;
            color: var(--navy);
        }

        .contact-info-text p,
        .contact-info-text a {
            font-size: 13px;
            color: var(--slate-600);
            margin-top: 2px;
        }

        .map-wrap {
            border-radius: var(--radius-xl);
            overflow: hidden;
            box-shadow: var(--shadow-md);
            border: 1px solid var(--slate-200);
            min-height: 320px;
        }

        .map-wrap iframe {
            width: 100%;
            height: 100%;
            min-height: 320px;
            border: none;
        }

        /* ── Site Footer ── */
        .site-footer {
            background: var(--navy-dark);
            color: rgba(255, 255, 255, 0.75);
            padding: 56px 0 28px;
            border-top: 1px solid rgba(255, 255, 255, 0.08);
            font-size: 13px;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 32px;
            margin-bottom: 36px;
        }

        @media (min-width: 768px) {
            .footer-grid {
                grid-template-columns: 1.5fr 1fr 1fr 1.2fr;
                gap: 26px;
            }
        }

        .footer-col h4 {
            color: var(--white);
            font-size: 15px;
            margin-bottom: 14px;
            font-weight: 700;
        }

        .footer-links {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 9px;
        }

        .footer-links a:hover {
            color: var(--white);
            padding-left: 3px;
        }

        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding-top: 22px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
            font-size: 12px;
        }

        /* ── Mobile Floating Action Bar ── */
        .mobile-bar {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(255, 255, 255, 0.96);
            backdrop-filter: blur(16px);
            border-top: 1px solid var(--slate-200);
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            padding: 6px 2px calc(6px + env(safe-area-inset-bottom, 0px));
            z-index: 999;
            box-shadow: 0 -4px 16px rgba(0, 0, 0, 0.06);
        }

        @media (min-width: 992px) {
            .mobile-bar {
                display: none;
            }
        }

        .mobile-bar-btn {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 3px;
            color: var(--slate-600);
            font-size: 10px;
            font-weight: 700;
            text-decoration: none;
            padding: 4px 1px;
            background: none;
            border: none;
            cursor: pointer;
            line-height: 1.15;
        }

        .mobile-bar-btn .icon {
            width: 19px;
            height: 19px;
        }

        .mobile-bar-btn.active {
            color: var(--orange);
        }

        /* ── Toast Notification Banner ── */
        .notification-banner {
            padding: 12px 18px;
            border-radius: var(--radius-md);
            margin: 16px 0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 14px;
            font-size: 13.5px;
        }

        .notification-banner.warning {
            background: #fffbeb;
            color: #b45309;
            border: 1px solid #fde68a;
        }

        .notification-banner.success {
            background: #ecfdf5;
            color: #065f46;
            border: 1px solid #a7f3d0;
        }

        /* ── Modals ── */
        .modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(4, 13, 26, 0.72);
            backdrop-filter: blur(8px);
            z-index: 3000;
            display: none;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .modal-overlay.active {
            display: flex;
            animation: fadeIn 0.2s ease;
        }

        .modal-box {
            background: var(--white);
            border-radius: var(--radius-xl);
            width: 100%;
            max-width: 480px;
            padding: 28px 24px;
            position: relative;
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.35);
            max-height: 90vh;
            overflow-y: auto;
        }

        @media (min-width: 768px) {
            .modal-box {
                padding: 32px 28px;
            }
        }

        .modal-close {
            position: absolute;
            top: 18px;
            right: 18px;
            background: var(--slate-100);
            border: none;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: var(--slate-600);
            font-size: 14px;
            transition: all 0.2s;
        }

        .modal-close:hover {
            background: var(--slate-200);
            color: var(--slate-900);
        }

        .modal-title {
            font-size: 20px;
            font-weight: 800;
            color: var(--navy);
            margin-bottom: 6px;
        }

        .modal-sub {
            font-size: 13px;
            color: var(--slate-600);
            margin-bottom: 18px;
        }

        /* Mobile Drawer Menu */
        .mobile-drawer {
            position: fixed;
            top: 0;
            right: -300px;
            width: 280px;
            height: 100vh;
            background: var(--white);
            z-index: 2001;
            box-shadow: -10px 0 30px rgba(0, 0, 0, 0.15);
            padding: 24px 20px;
            transition: right 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .mobile-drawer.open {
            right: 0;
        }

        .drawer-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 2000;
            display: none;
        }

        .drawer-overlay.open {
            display: block;
        }

        .drawer-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-bottom: 14px;
            border-bottom: 1px solid var(--slate-200);
        }

        .drawer-links {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .drawer-link {
            font-size: 14.5px;
            font-weight: 700;
            color: var(--slate-800);
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 4px 0;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(6px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>

    <!-- ── Top Announcement Utility Bar ── -->
    <div class="top-bar">
        <div class="container top-bar-inner">
            <div class="top-items">
                <span class="top-item">
                    <span class="icon" style="width:14px;height:14px;">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" />
                            <circle cx="12" cy="10" r="3" />
                        </svg>
                    </span>
                    <span data-hi="महेवा रोड, तेवां, कौशाम्बी (उ.प्र.)"
                        data-en="Mahewa Road, Tewa, Kaushambi (U.P.)">महेवा रोड, तेवां, कौशाम्बी (उ.प्र.)</span>
                </span>
                <span class="top-item">
                    <span class="icon" style="width:14px;height:14px;">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path
                                d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z" />
                        </svg>
                    </span>
                    <a href="tel:8736002004">+91 8736002004</a>
                </span>
                <span class="top-badge" data-hi="सत्र <?= $current_session ?> प्रवेश प्रारंभ • 2 दिन फ्री डेमो क्लास"
                    data-en="Admission Open <?= $current_session ?> • 2 Days Free Demo">सत्र <?= $current_session ?>
                    प्रवेश प्रारंभ • 2 दिन फ्री डेमो
                    क्लास</span>
            </div>

            <div class="top-links">
                <a href="https://api.whatsapp.com/send?phone=+918736002004" target="_blank">
                    <span class="icon" style="width:14px;height:14px;color:#25D366;">
                        <svg viewBox="0 0 24 24" fill="currentColor">
                            <path
                                d="M12.04 2c-5.46 0-9.91 4.45-9.91 9.91 0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21 5.46 0 9.91-4.45 9.91-9.91 0-2.65-1.03-5.14-2.9-7.01A9.82 9.82 0 0 0 12.04 2m.01 1.67c2.2 0 4.26.86 5.82 2.42a8.23 8.23 0 0 1 2.41 5.83c0 4.54-3.7 8.24-8.24 8.24-1.48 0-2.93-.39-4.19-1.15l-.3-.18-3.12.82.83-3.04-.2-.31a8.2 8.2 0 0 1-1.26-4.38c0-4.54 3.7-8.24 8.24-8.24m4.52 11.64c-.25-.12-1.47-.72-1.7-.81-.23-.08-.4-.12-.56.12-.17.25-.65.81-.8 1-.15.19-.3.21-.55.08-.25-.12-1.05-.39-2-1.23-.74-.66-1.24-1.47-1.39-1.72-.15-.25-.02-.38.11-.5.11-.11.25-.29.37-.43.12-.15.17-.25.25-.41.08-.17.04-.31-.02-.43s-.56-1.36-.77-1.86c-.2-.49-.41-.42-.56-.43h-.48c-.16 0-.43.06-.66.31-.23.25-.87.85-.87 2.07s.89 2.4 1.01 2.57c.12.17 1.75 2.67 4.24 3.74.59.26 1.05.41 1.41.53.6.19 1.14.16 1.57.1.48-.07 1.47-.6 1.68-1.18.21-.58.21-1.07.15-1.18-.06-.12-.23-.19-.48-.31z" />
                        </svg>
                    </span>
                    <span data-hi="WhatsApp हेल्पडेस्क" data-en="WhatsApp Helpdesk">WhatsApp हेल्पडेस्क</span>
                </a>
                <span class="top-divider">|</span>
                <a href="javascript:void(0)" onclick="openModal('modal-login')">
                    <span class="icon" style="width:14px;height:14px;">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4" />
                            <polyline points="10 17 15 12 10 7" />
                            <line x1="15" y1="12" x2="3" y2="12" />
                        </svg>
                    </span>
                    <span data-hi="Admin लॉगिन" data-en="Admin Portal">Admin लॉगिन</span>
                </a>
            </div>
        </div>
    </div>

    <!-- ── Main Site Header & Apple-Style Frosted Glass Navbar ── -->
    <header class="site-header">
        <div class="container header-inner">
            <a href="index.php" class="brand" aria-label="SCAIT Academy Home">
                <img src="images/logo.svg" alt="SCAIT Academy" class="brand-logo-img"
                    onerror="this.src='images/logo.png'">
            </a>

            <!-- Desktop Nav Menu -->
            <nav>
                <ul class="nav-menu">
                    <li><a href="#" class="nav-item" data-hi="होम (Home)" data-en="Home">होम (Home)</a></li>
                    <li><a href="#courses" class="nav-item" data-hi="कोर्स व फीस" data-en="Courses & Fees">कोर्स व
                            फीस</a></li>
                    <li><a href="#verify" class="nav-item" data-hi="सर्टिफिकेट Hub" data-en="Certificate Hub">सर्टिफिकेट
                            Hub</a></li>
                    <li><a href="#about" class="nav-item" data-hi="संस्थान परिचय" data-en="About Academy">संस्थान
                            परिचय</a></li>
                    <li><a href="#gallery" class="nav-item" data-hi="कम्प्यूटर लैब" data-en="Campus Lab">कम्प्यूटर
                            लैब</a></li>
                    <li><a href="#contact" class="nav-item" data-hi="संपर्क" data-en="Contact">संपर्क</a></li>
                </ul>
            </nav>

            <!-- Actions: Desktop Buttons & Clean Mobile Controls -->
            <div class="header-actions">
                <!-- Apple-style Language Switcher (Desktop Only) -->
                <div class="lang-switcher header-desktop-btn" aria-label="Language Switcher">
                    <button class="lang-btn active" id="langBtnEn" onclick="setLanguage('en')">English</button>
                    <button class="lang-btn" id="langBtnHi" onclick="setLanguage('hi')">हिन्दी</button>
                </div>

                <button class="btn-glass header-desktop-btn" onclick="scrollToCertWidget()">
                    <span class="icon" style="width:15px;height:15px;">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M22 10v6M2 10l10-5 10 5-10 5z" />
                            <path d="M6 12v5c3 3 9 3 12 0v-5" />
                        </svg>
                    </span>
                    <span data-hi="सर्टिफिकेट चेक करें" data-en="Verify Certificate">सर्टिफिकेट चेक करें</span>
                </button>
                <button class="btn-apple-primary header-desktop-btn" onclick="openModal('modal-inquiry')">
                    <span data-hi="नया प्रवेश <?= $current_session ?>" data-en="Admission <?= $current_session ?>">नया
                        प्रवेश <?= $current_session ?></span>
                </button>

                <!-- WhatsApp Button (Mobile Top Header - Restored) -->
                <a href="https://api.whatsapp.com/send?phone=+918736002004&text=नमस्ते%20SCAIT,%20मुझे%20कोर्स%20की%20जानकारी%20चाहिए।"
                    target="_blank" class="header-mobile-whatsapp" aria-label="WhatsApp SCAIT">
                    <span class="icon" style="width:20px;height:20px;">
                        <svg viewBox="0 0 24 24" fill="currentColor">
                            <path
                                d="M12.04 2c-5.46 0-9.91 4.45-9.91 9.91 0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21 5.46 0 9.91-4.45 9.91-9.91 0-2.65-1.03-5.14-2.9-7.01A9.82 9.82 0 0 0 12.04 2m.01 1.67c2.2 0 4.26.86 5.82 2.42a8.23 8.23 0 0 1 2.41 5.83c0 4.54-3.7 8.24-8.24 8.24-1.48 0-2.93-.39-4.19-1.15l-.3-.18-3.12.82.83-3.04-.2-.31a8.2 8.2 0 0 1-1.26-4.38c0-4.54 3.7-8.24 8.24-8.24m4.52 11.64c-.25-.12-1.47-.72-1.7-.81-.23-.08-.4-.12-.56.12-.17.25-.65.81-.8 1-.15.19-.3.21-.55.08-.25-.12-1.05-.39-2-1.23-.74-.66-1.24-1.47-1.39-1.72-.15-.25-.02-.38.11-.5.11-.11.25-.29.37-.43.12-.15.17-.25.25-.41.08-.17.04-.31-.02-.43s-.56-1.36-.77-1.86c-.2-.49-.41-.42-.56-.43h-.48c-.16 0-.43.06-.66.31-.23.25-.87.85-.87 2.07s.89 2.4 1.01 2.57c.12.17 1.75 2.67 4.24 3.74.59.26 1.05.41 1.41.53.6.19 1.14.16 1.57.1.48-.07 1.47-.6 1.68-1.18.21-.58.21-1.07.15-1.18-.06-.12-.23-.19-.48-.31z" />
                        </svg>
                    </span>
                </a>

                <!-- Mobile Hamburger Menu Button -->
                <button class="mobile-menu-btn" onclick="toggleMobileMenu()" aria-label="Open Menu">
                    <span class="icon" style="width:20px;height:20px;">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <line x1="3" y1="12" x2="21" y2="12" />
                            <line x1="3" y1="6" x2="21" y2="6" />
                            <line x1="3" y1="18" x2="21" y2="18" />
                        </svg>
                    </span>
                </button>
            </div>
        </div>
    </header>

    <!-- Mobile Drawer -->
    <div class="drawer-overlay" id="drawerOverlay" onclick="toggleMobileMenu()"></div>
    <div class="mobile-drawer" id="mobileDrawer">
        <div class="drawer-header">
            <img src="images/logo.svg" alt="SCAIT Academy" style="height:32px;width:auto;"
                onerror="this.src='images/logo.png'">
            <button onclick="toggleMobileMenu()" aria-label="Close Menu"
                style="background:none;border:none;cursor:pointer;color:var(--slate-600);display:inline-flex;align-items:center;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"
                    stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18" />
                    <line x1="6" y1="6" x2="18" y2="18" />
                </svg>
            </button>
        </div>

        <!-- Drawer Language Switcher Row -->
        <div
            style="display:flex; align-items:center; justify-content:space-between; padding: 10px 0; border-bottom: 1px solid var(--slate-100); margin-bottom: 6px;">
            <span style="font-size:12.5px; font-weight:700; color:var(--slate-600);" data-hi="भाषा चुनें:"
                data-en="Language:">Language:</span>
            <div class="lang-switcher">
                <button class="lang-btn active" id="drawerLangBtnEn" onclick="setLanguage('en')">English</button>
                <button class="lang-btn" id="drawerLangBtnHi" onclick="setLanguage('hi')">हिन्दी</button>
            </div>
        </div>

        <ul class="drawer-links">
            <li><a href="#" class="drawer-link" onclick="toggleMobileMenu()" data-hi="होम (Home)" data-en="Home">होम
                    (Home)</a></li>
            <li><a href="#courses" class="drawer-link" onclick="toggleMobileMenu()" data-hi="कोर्स व सिलेबस"
                    data-en="Courses & Syllabus">कोर्स व सिलेबस</a></li>
            <li><a href="#verify" class="drawer-link" onclick="toggleMobileMenu()" data-hi="सर्टिफिकेट सत्यापन"
                    data-en="Certificate Verification">सर्टिफिकेट सत्यापन</a></li>
            <li><a href="#about" class="drawer-link" onclick="toggleMobileMenu()" data-hi="संस्थान परिचय"
                    data-en="About SCAIT">संस्थान परिचय</a></li>
            <li><a href="#gallery" class="drawer-link" onclick="toggleMobileMenu()" data-hi="कम्प्यूटर लैब व कक्षाएं"
                    data-en="Campus & Computer Lab">कम्प्यूटर लैब व कक्षाएं</a></li>
            <li><a href="#contact" class="drawer-link" onclick="toggleMobileMenu()" data-hi="संपर्क व लोकेशन"
                    data-en="Contact & Location">संपर्क व लोकेशन</a></li>
            <li><a href="javascript:void(0)" class="drawer-link" onclick="toggleMobileMenu(); openModal('modal-login')"
                    data-hi="Admin पोर्टल लॉगिन" data-en="Admin Portal Login">Admin पोर्टल लॉगिन</a></li>
        </ul>
        <div style="margin-top:auto; display:flex; flex-direction:column; gap:10px;">
            <button class="btn btn-primary" onclick="toggleMobileMenu(); openModal('modal-inquiry')"
                data-hi="नए प्रवेश हेतु आवेदन" data-en="Apply for Admission">नए प्रवेश हेतु आवेदन</button>
            <button class="btn btn-navy" onclick="toggleMobileMenu(); scrollToCertWidget()"
                data-hi="सर्टिफिकेट चेक करें" data-en="Verify Certificate">सर्टिफिकेट चेक करें</button>
        </div>
    </div>

    <!-- ── Toast Notification Bar ── -->
    <?php if (!empty($msg)): ?>
        <div class="container">
            <div class="notification-banner <?= $msg_type ?>">
                <div><strong>सूचना:</strong> <?= $msg ?></div>
                <button onclick="this.parentElement.style.display='none'" aria-label="Dismiss"
                    style="background:none;border:none;cursor:pointer;display:inline-flex;align-items:center;">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="6" x2="6" y2="18" />
                        <line x1="6" y1="6" x2="18" y2="18" />
                    </svg>
                </button>
            </div>
        </div>
    <?php endif; ?>

    <!-- ── Humanized Warm Hero Section ── -->
    <section class="hero">
        <div class="container hero-grid">

            <!-- Left: Hero Intro -->
            <div class="hero-content">
                <div class="hero-badge">
                    <span class="icon" style="width:14px;height:14px;">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                            stroke-linecap="round" stroke-linejoin="round">
                            <polygon
                                points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" />
                        </svg>
                    </span>
                    <span data-hi="<?= $years_of_excellence ?> वर्षों से कौशाम्बी का भरोसेमंद संस्थान • Estd. 2008"
                        data-en="Trusted IT Institute in Kaushambi • Estd. 2008"><?= $years_of_excellence ?> वर्षों से
                        कौशाम्बी का भरोसेमंद
                        संस्थान • Estd. 2008</span>
                </div>
                <h1 class="hero-title"
                    data-hi="सरकारी व प्राइवेट जॉब्स के लिए सीखें <span>व्यावहारिक कम्प्यूटर स्किल्स</span>"
                    data-en="Build Practical Computer Skills For <span>Govt & Private Careers</span>">
                    सरकारी व प्राइवेट जॉब्स के लिए सीखें <span>व्यावहारिक कम्प्यूटर स्किल्स</span>
                </h1>
                <p class="hero-desc"
                    data-hi="तेवां (कौशाम्बी) में 2008 से संचालित अग्रणी कम्प्यूटर प्रशिक्षण संस्थान। ADCA, CCC, Tally Prime और हिन्दी-इंग्लिश टाइपिंग में हर छात्र को खुद का अलग कंप्यूटर और 100% इन्वर्टर/सोलर बैकअप।"
                    data-en="Kaushambi's premier computer training institute in Tewa. ADCA, CCC, Tally Prime, and Hindi-English Typing with 1:1 dedicated PC practice and 100% solar/inverter power backup.">
                    तेवां (कौशाम्बी) में 2008 से संचालित अग्रणी कम्प्यूटर प्रशिक्षण संस्थान। ADCA, CCC, Tally Prime और
                    हिन्दी-इंग्लिश टाइपिंग में हर छात्र को खुद का अलग कंप्यूटर और 100% इन्वर्टर/सोलर बैकअप।
                </p>

                <div class="hero-actions">
                    <a href="#courses" class="btn btn-primary btn-lg" data-hi="कोर्स व फीस देखें"
                        data-en="Explore Courses & Fees">
                        कोर्स व फीस देखें
                    </a>
                    <a href="https://api.whatsapp.com/send?phone=+918736002004&text=नमस्ते%20SCAIT,%20मुझे%20नए%20एडमिशन%20और%20कोर्स%20की%20जानकारी%20चाहिए।"
                        target="_blank" class="btn btn-whatsapp btn-lg">
                        <span class="icon" style="width:18px;height:18px;">
                            <svg viewBox="0 0 24 24" fill="currentColor">
                                <path
                                    d="M12.04 2c-5.46 0-9.91 4.45-9.91 9.91 0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21 5.46 0 9.91-4.45 9.91-9.91 0-2.65-1.03-5.14-2.9-7.01A9.82 9.82 0 0 0 12.04 2m.01 1.67c2.2 0 4.26.86 5.82 2.42a8.23 8.23 0 0 1 2.41 5.83c0 4.54-3.7 8.24-8.24 8.24-1.48 0-2.93-.39-4.19-1.15l-.3-.18-3.12.82.83-3.04-.2-.31a8.2 8.2 0 0 1-1.26-4.38c0-4.54 3.7-8.24 8.24-8.24m4.52 11.64c-.25-.12-1.47-.72-1.7-.81-.23-.08-.4-.12-.56.12-.17.25-.65.81-.8 1-.15.19-.3.21-.55.08-.25-.12-1.05-.39-2-1.23-.74-.66-1.24-1.47-1.39-1.72-.15-.25-.02-.38.11-.5.11-.11.25-.29.37-.43.12-.15.17-.25.25-.41.08-.17.04-.31-.02-.43s-.56-1.36-.77-1.86c-.2-.49-.41-.42-.56-.43h-.48c-.16 0-.43.06-.66.31-.23.25-.87.85-.87 2.07s.89 2.4 1.01 2.57c.12.17 1.75 2.67 4.24 3.74.59.26 1.05.41 1.41.53.6.19 1.14.16 1.57.1.48-.07 1.47-.6 1.68-1.18.21-.58.21-1.07.15-1.18-.06-.12-.23-.19-.48-.31z" />
                            </svg>
                        </span>
                        <span data-hi="डायरेक्टर से WhatsApp पर बात करें"
                            data-en="Chat with Director on WhatsApp">डायरेक्टर से WhatsApp पर बात करें</span>
                    </a>
                </div>

                <div class="hero-stats">
                    <div class="stat-item">
                        <strong data-hi="<?= $years_of_excellence ?>+ वर्ष"
                            data-en="<?= $years_of_excellence ?>+ Years"><?= $years_of_excellence ?>+ वर्ष</strong>
                        <span data-hi="2008 से सेवा में" data-en="Since 2008">2008 से सेवा में</span>
                    </div>
                    <div class="stat-item">
                        <strong data-hi="2,500+" data-en="2,500+">2,500+</strong>
                        <span data-hi="छात्र-छात्राएं सफल" data-en="Certified Students">छात्र-छात्राएं सफल</span>
                    </div>
                    <div class="stat-item">
                        <strong data-hi="1:1 PC" data-en="1:1 PC">1:1 PC</strong>
                        <span data-hi="1 छात्र = 1 अलग PC" data-en="1 Student = 1 PC">1 छात्र = 1 अलग PC</span>
                    </div>
                    <div class="stat-item">
                        <strong data-hi="100%" data-en="100%">100%</strong>
                        <span data-hi="इन्वर्टर/सोलर बैकअप" data-en="Power Backup">इन्वर्टर/सोलर बैकअप</span>
                    </div>
                </div>
            </div>

            <!-- Right: Student Desk Card -->
            <div class="terminal-card" id="studentPortalWidget">
                <div class="terminal-header">
                    <div class="terminal-header-title">
                        <div class="terminal-header-icon">
                            <span class="icon" style="width:20px;height:20px;">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M22 10v6M2 10l10-5 10 5-10 5z" />
                                    <path d="M6 12v5c3 3 9 3 12 0v-5" />
                                </svg>
                            </span>
                        </div>
                        <div>
                            <h3 data-hi="छात्र सेवा केंद्र (Student Desk)" data-en="Student Service Desk">छात्र सेवा
                                केंद्र (Student Desk)</h3>
                            <p data-hi="सर्टिफिकेट डाउनलोड व प्रवेश पूछताछ" data-en="Certificate Download & Admissions">
                                सर्टिफिकेट डाउनलोड व प्रवेश पूछताछ</p>
                        </div>
                    </div>
                    <span class="terminal-live-badge" data-hi="ऑनलाइन सुविधा" data-en="Live Desk">
                        ऑनलाइन सुविधा
                    </span>
                </div>

                <div class="terminal-tabs">
                    <button class="terminal-tab active" onclick="switchTerminalTab('tab-terminal-cert', this)">
                        <span class="icon" style="width:14px;height:14px;">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="11" cy="11" r="8" />
                                <line x1="21" y1="21" x2="16.65" y2="16.65" />
                            </svg>
                        </span>
                        <span data-hi="सर्टिफिकेट डाउनलोड" data-en="Download Certificate">सर्टिफिकेट डाउनलोड</span>
                    </button>
                    <button class="terminal-tab" onclick="switchTerminalTab('tab-terminal-adm', this)">
                        <span class="icon" style="width:14px;height:14px;">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                                <circle cx="8.5" cy="7.5" r="4" />
                                <line x1="20" y1="8" x2="20" y2="14" />
                                <line x1="23" y1="11" x2="17" y2="11" />
                            </svg>
                        </span>
                        <span data-hi="नया प्रवेश / पूछताछ" data-en="Admission Inquiry">नया प्रवेश / पूछताछ</span>
                    </button>
                </div>

                <!-- Tab 1: Certificate Download -->
                <div id="tab-terminal-cert" class="terminal-panel active">
                    <form method="POST" action="s_chk_res.php">
                        <div class="form-group">
                            <label class="form-label" data-hi="कोर्स चुनें (Select Course)"
                                data-en="Select Course">कोर्स चुनें (Select Course)</label>
                            <div class="input-wrap">
                                <span class="input-icon-left icon" style="width:18px;height:18px;">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20" />
                                        <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z" />
                                    </svg>
                                </span>
                                <select name="cour" id="heroCourseSelect" class="form-control" required>
                                    <option value="" data-hi="अपना कोर्स चुनें..." data-en="Select your course...">अपना
                                        कोर्स चुनें...</option>
                                    <option value="ADCA">ADCA (Advance Diploma - 1 Year)</option>
                                    <option value="CCC">CCC (Course on Computer Concepts - 3 Months)</option>
                                    <option value="TALLY">TALLY PRIME & GST (Accounting)</option>
                                    <option value="TYPING">TYPING (Hindi & English Typing)</option>
                                    <option value="DCA">DCA (Diploma in Computer - 6 Months)</option>
                                    <option value="DTP">DTP (Desktop Publishing & Printing)</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" data-hi="छात्र रोल नंबर (Student Roll No.)"
                                data-en="Student Roll Number">छात्र रोल नंबर (Student Roll No.)</label>
                            <div class="input-wrap">
                                <span class="input-icon-left icon" style="width:18px;height:18px;">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <rect x="3" y="4" width="18" height="16" rx="2" />
                                        <line x1="7" y1="8" x2="17" y2="8" />
                                        <line x1="7" y1="12" x2="17" y2="12" />
                                        <line x1="7" y1="16" x2="12" y2="16" />
                                    </svg>
                                </span>
                                <input type="text" name="r_n" id="heroRollInput" class="form-control"
                                    placeholder="उदा. 1001215" data-placeholder-hi="उदा. 1001215"
                                    data-placeholder-en="e.g. 1001215" required autocomplete="off"
                                    style="font-size:15px; font-weight:700;">
                            </div>
                            <span class="form-helper" data-hi="आपके आई-कार्ड या प्रवेश रसीद पर लिखा 7-अंकों का रोल नंबर"
                                data-en="7-digit roll number printed on your ID card or admission receipt">
                                <span class="icon" style="width:13px;height:13px;color:var(--slate-400);">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="10" />
                                        <line x1="12" y1="16" x2="12" y2="12" />
                                        <line x1="12" y1="8" x2="12.01" y2="8" />
                                    </svg>
                                </span>
                                आपके आई-कार्ड या प्रवेश रसीद पर लिखा 7-अंकों का रोल नंबर
                            </span>
                        </div>

                        <button type="submit" name="chsubmit" class="btn btn-primary"
                            style="width: 100%; height:46px; margin-top: 6px;">
                            <span class="icon" style="width:18px;height:18px;">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                                    <polyline points="7 10 12 15 17 10" />
                                    <line x1="12" y1="15" x2="12" y2="3" />
                                </svg>
                            </span>
                            <span data-hi="सर्टिफिकेट देखें व डाउनलोड करें"
                                data-en="Download Official Certificate">सर्टिफिकेट देखें व डाउनलोड करें</span>
                        </button>
                    </form>

                    <div
                        style="margin-top: 14px; padding-top: 12px; border-top: 1px solid var(--slate-100); text-align: center; font-size: 12px; color: var(--slate-600);">
                        <span data-hi="रोल नंबर याद नहीं?" data-en="Forgot Roll Number?">रोल नंबर याद नहीं?</span> <a
                            href="https://api.whatsapp.com/send?phone=+918736002004&text=नमस्ते%20SCAIT,%20मेरा%20रोल%20नंबर%20खो%20गया%20है,%20कृपया%20मदद%20करें।"
                            target="_blank" style="color: var(--orange); font-weight: 700;"
                            data-hi="व्हाट्सएप हेल्पडेस्क से पूछें &rarr;"
                            data-en="Ask on WhatsApp Support &rarr;">व्हाट्सएप हेल्पडेस्क से पूछें &rarr;</a>
                    </div>
                </div>

                <!-- Tab 2: Fast Admission -->
                <div id="tab-terminal-adm" class="terminal-panel">
                    <form method="POST" action="s_adm.php">
                        <div class="form-group">
                            <label class="form-label" data-hi="विद्यार्थी का नाम" data-en="Student Name">विद्यार्थी का
                                नाम</label>
                            <input type="text" name="aname" class="form-control no-icon" placeholder="पूरा नाम लिखें"
                                data-placeholder-hi="पूरा नाम लिखें" data-placeholder-en="Full Name" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label" data-hi="मोबाइल नंबर (10 अंक)"
                                data-en="Mobile Number (10 digits)">मोबाइल नंबर (10 अंक)</label>
                            <input type="tel" name="aphone" class="form-control no-icon"
                                placeholder="कॉल या व्हाट्सएप नंबर" data-placeholder-hi="कॉल या व्हाट्सएप नंबर"
                                data-placeholder-en="10-digit mobile number" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label" data-hi="गाँव / कस्बा का पता"
                                data-en="Village / Town Address">गाँव / कस्बा का पता</label>
                            <input type="text" name="address" class="form-control no-icon"
                                placeholder="उदा. तेवां, भरवारी, मंझनपुर"
                                data-placeholder-hi="उदा. तेवां, भरवारी, मंझनपुर"
                                data-placeholder-en="e.g. Tewa, Manjhanpur" required>
                        </div>
                        <button type="submit" name="asubmit" class="btn btn-primary" style="width: 100%; height:46px;">
                            <span data-hi="पूछताछ भेजें (हम 24 घंटे में संपर्क करेंगे)"
                                data-en="Submit Inquiry (We will call in 24 hrs)">पूछताछ भेजें (हम 24 घंटे में संपर्क
                                करेंगे)</span>
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </section>

    <!-- ── Popular Courses Section ── -->
    <section id="courses" class="courses-section">
        <div class="container">
            <div class="section-header">
                <span class="section-pill" data-hi="प्रमाणित कम्प्यूटर कोर्स" data-en="Certified Programs">प्रमाणित
                    कम्प्यूटर कोर्स</span>
                <h2 class="section-title" data-hi="आपके भविष्य और रोजगार के लिए उपयोगी कोर्स"
                    data-en="Job-Ready Certified Computer Courses">आपके भविष्य और रोजगार के लिए उपयोगी कोर्स</h2>
                <p class="section-desc"
                    data-hi="कौशाम्बी के छात्र-छात्राओं की जरूरतों को ध्यान में रखकर तैयार किया गया 100% प्रैक्टिकल सिलेबस — आसान मासिक किस्तों में फीस की सुविधा के साथ।"
                    data-en="Practical curriculum tailored for Kaushambi youth with 1-on-1 computer lab practice and flexible monthly installment options.">
                    कौशाम्बी के छात्र-छात्राओं की जरूरतों को ध्यान में रखकर तैयार किया गया 100% प्रैक्टिकल सिलेबस — आसान
                    मासिक किस्तों में फीस की सुविधा के साथ।</p>
            </div>

            <div class="courses-grid">
                <!-- Course 1: ADCA -->
                <div class="course-card">
                    <div class="course-top">
                        <span class="course-code">ADCA</span>
                        <span class="course-badge highlight" data-hi="10वीं/12वीं बाद सर्वश्रेष्ठ"
                            data-en="Most Popular (10th/12th)">10वीं/12वीं बाद सर्वश्रेष्ठ</span>
                    </div>
                    <h3 class="course-name">Advance Diploma in Computer Application</h3>
                    <p class="course-desc"
                        data-hi="1 वर्ष का संपूर्ण मास्टर डिप्लोमा। कम्प्यूटर बेसिक से लेकर ऑफिस वर्क, अकाउंटिंग, ग्राफिक डिजाइनिंग और टाइपिंग में पूरी तरह दक्ष बनें।"
                        data-en="Comprehensive 1-year master diploma covering office productivity, graphic design, accounting, programming, and typing.">
                        1 वर्ष का संपूर्ण मास्टर डिप्लोमा। कम्प्यूटर बेसिक से लेकर ऑफिस वर्क, अकाउंटिंग, ग्राफिक
                        डिजाइनिंग और टाइपिंग में पूरी तरह दक्ष बनें।</p>
                    <div class="course-tags">
                        <span class="course-tag">MS Word & Excel</span>
                        <span class="course-tag">Photoshop</span>
                        <span class="course-tag">Tally Prime</span>
                        <span class="course-tag">C Language</span>
                        <span class="course-tag">HTML</span>
                        <span class="course-tag">Typing</span>
                        <span class="course-tag">
                            <svg class="sw-icon" viewBox="0 0 24 24">
                                <rect x="1" y="1" width="22" height="22" rx="5" fill="#185ABD" />
                                <path d="M5.5 7.5L8 16.5L10.5 9.5L13 16.5L15.5 7.5" stroke="#fff" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" fill="none" />
                                <line x1="17.5" y1="8.5" x2="19.5" y2="8.5" stroke="#93C5FD" stroke-width="1.8"
                                    stroke-linecap="round" />
                                <line x1="17.5" y1="12" x2="19.5" y2="12" stroke="#93C5FD" stroke-width="1.8"
                                    stroke-linecap="round" />
                                <line x1="17.5" y1="15.5" x2="19.5" y2="15.5" stroke="#93C5FD" stroke-width="1.8"
                                    stroke-linecap="round" />
                            </svg>
                            MS Word
                        </span>
                        <span class="course-tag">
                            <svg class="sw-icon" viewBox="0 0 24 24">
                                <rect x="1" y="1" width="22" height="22" rx="5" fill="#107C41" />
                                <path d="M6.5 8L12.5 16M12.5 8L6.5 16" stroke="#fff" stroke-width="2.2"
                                    stroke-linecap="round" />
                                <rect x="15" y="7.5" width="4" height="2.2" rx="0.5" fill="#86EFAC" />
                                <rect x="15" y="10.9" width="4" height="2.2" rx="0.5" fill="#86EFAC" />
                                <rect x="15" y="14.3" width="4" height="2.2" rx="0.5" fill="#86EFAC" />
                            </svg>
                            MS Excel
                        </span>
                        <span class="course-tag">
                            <svg class="sw-icon" viewBox="0 0 24 24">
                                <rect x="1" y="1" width="22" height="22" rx="5" fill="#001E36" stroke="#31A8FF"
                                    stroke-width="1.5" /><text x="12" y="15.5" text-anchor="middle" fill="#31A8FF"
                                    font-family="sans-serif" font-weight="800" font-size="10.5">Ps</text>
                            </svg>
                            Photoshop
                        </span>
                        <span class="course-tag">
                            <svg class="sw-icon" viewBox="0 0 24 24">
                                <rect x="1" y="1" width="22" height="22" rx="5" fill="#0284C7" />
                                <path d="M6 8.5H18M12 8.5V17" stroke="#FDE047" stroke-width="2.4"
                                    stroke-linecap="round" />
                                <circle cx="17" cy="15.5" r="2" fill="#FDE047" />
                            </svg>
                            Tally Prime
                        </span>
                        <span class="course-tag">
                            <svg class="sw-icon" viewBox="0 0 24 24">
                                <rect x="1" y="1" width="22" height="22" rx="5" fill="#283593" />
                                <path d="M15.5 9.2A4.5 4.5 0 1 0 15.5 14.8" stroke="#fff" stroke-width="2.4"
                                    stroke-linecap="round" fill="none" />
                            </svg>
                            C Language
                        </span>
                        <span class="course-tag">
                            <svg class="sw-icon" viewBox="0 0 24 24">
                                <rect x="1" y="1" width="22" height="22" rx="5" fill="#E34F26" />
                                <path d="M9.5 9L6.5 12L9.5 15M14.5 9L17.5 12L14.5 15" stroke="#fff" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" fill="none" />
                            </svg>
                            HTML
                        </span>
                        <span class="course-tag">
                            <svg class="sw-icon" viewBox="0 0 24 24">
                                <rect x="1" y="1" width="22" height="22" rx="5" fill="#4F46E5" />
                                <rect x="4.5" y="7" width="15" height="10" rx="2" stroke="#fff" stroke-width="1.6"
                                    fill="none" />
                                <circle cx="8" cy="10" r="0.9" fill="#fff" />
                                <circle cx="12" cy="10" r="0.9" fill="#fff" />
                                <circle cx="16" cy="10" r="0.9" fill="#fff" />
                                <line x1="8" y1="14" x2="16" y2="14" stroke="#A5B4FC" stroke-width="1.8"
                                    stroke-linecap="round" />
                            </svg>
                            Typing
                        </span>
                    </div>
                    <div class="course-meta">
                        <div class="course-meta-item">
                            <span data-hi="अवधि (Duration)" data-en="Duration">अवधि (Duration)</span>
                            <strong data-hi="1 वर्ष (12 महीने)" data-en="1 Year (12 Months)">1 वर्ष (12 महीने)</strong>
                        </div>
                        <div class="course-meta-item">
                            <span data-hi="प्रैक्टिकल सुविधा" data-en="Lab Practice">प्रैक्टिकल सुविधा</span>
                            <strong data-hi="दैनिक 2 घंटे लैब + नोट्स" data-en="Daily 2 Hrs Lab + Notes">दैनिक 2 घंटे
                                लैब + नोट्स</strong>
                        </div>
                    </div>
                    <button class="btn btn-navy course-btn" onclick="openCourseInquiry('ADCA')">
                        <span data-hi="ADCA में प्रवेश लें" data-en="Enroll for ADCA">ADCA में प्रवेश लें</span>
                    </button>
                </div>

                <!-- Course 2: CCC -->
                <div class="course-card">
                    <div class="course-top">
                        <span class="course-code">CCC</span>
                        <span class="course-badge" data-hi="सरकारी नौकरी हेतु अनिवार्य"
                            data-en="Govt Job Mandatory">सरकारी नौकरी हेतु अनिवार्य</span>
                    </div>
                    <h3 class="course-name">Course on Computer Concepts</h3>
                    <p class="course-desc"
                        data-hi="UPSSSC, लेखपाल, VDO, पुलिस भर्ती एवं सभी सरकारी पदों के लिए अनिवार्य राष्ट्रीय प्रमाण पत्र। शत-प्रतिशत पास कराने की तैयारी।"
                        data-en="National certification mandatory for UP government jobs, Lekhpal, VDO, police, and clerical exams with 100% exam preparation.">
                        UPSSSC, लेखपाल, VDO, पुलिस भर्ती एवं सभी सरकारी पदों के लिए अनिवार्य राष्ट्रीय प्रमाण पत्र।
                        शत-प्रतिशत पास कराने की तैयारी।</p>
                    <div class="course-tags">
                        <span class="course-tag">LibreOffice Writer</span>
                        <span class="course-tag">Calc & Impress</span>
                        <span class="course-tag">Cyber Safety</span>
                        <span class="course-tag">Online Test Prep</span>
                        <span class="course-tag">
                            <svg class="sw-icon" viewBox="0 0 24 24">
                                <rect x="1" y="1" width="22" height="22" rx="5" fill="#0369A1" />
                                <line x1="6.5" y1="8.5" x2="17.5" y2="8.5" stroke="#fff" stroke-width="2"
                                    stroke-linecap="round" />
                                <line x1="6.5" y1="12" x2="17.5" y2="12" stroke="#fff" stroke-width="2"
                                    stroke-linecap="round" />
                                <line x1="6.5" y1="15.5" x2="13" y2="15.5" stroke="#7DD3FC" stroke-width="2"
                                    stroke-linecap="round" />
                            </svg>
                            LibreOffice Writer
                        </span>
                        <span class="course-tag">
                            <svg class="sw-icon" viewBox="0 0 24 24">
                                <rect x="1" y="1" width="22" height="22" rx="5" fill="#15803D" />
                                <rect x="6" y="12" width="3" height="6" rx="0.8" fill="#86EFAC" />
                                <rect x="10.5" y="9" width="3" height="9" rx="0.8" fill="#fff" />
                                <rect x="15" y="6.5" width="3" height="11.5" rx="0.8" fill="#FDE047" />
                            </svg>
                            Calc & Impress
                        </span>
                        <span class="course-tag">
                            <svg class="sw-icon" viewBox="0 0 24 24">
                                <rect x="1" y="1" width="22" height="22" rx="5" fill="#0D9488" />
                                <path
                                    d="M12 5.5L17.5 8V12.5C17.5 15.8 15.1 18.4 12 19.2C8.9 18.4 6.5 15.8 6.5 12.5V8L12 5.5Z"
                                    stroke="#fff" stroke-width="1.7" fill="none" />
                                <path d="M9.8 12.3L11.3 13.8L14.5 10.6" stroke="#99F6E4" stroke-width="1.8"
                                    stroke-linecap="round" stroke-linejoin="round" fill="none" />
                            </svg>
                            Cyber Safety
                        </span>
                        <span class="course-tag">
                            <svg class="sw-icon" viewBox="0 0 24 24">
                                <rect x="1" y="1" width="22" height="22" rx="5" fill="#7C3AED" />
                                <circle cx="12" cy="12" r="5.5" stroke="#fff" stroke-width="1.8" fill="none" />
                                <path d="M12 9.2V12.2L14 13.5" stroke="#DDD6FE" stroke-width="1.8"
                                    stroke-linecap="round" fill="none" />
                            </svg>
                            Online Test Prep
                        </span>
                    </div>
                    <div class="course-meta">
                        <div class="course-meta-item">
                            <span data-hi="अवधि (Duration)" data-en="Duration">अवधि (Duration)</span>
                            <strong data-hi="3 माह (Fast Track)" data-en="3 Months">3 माह (Fast Track)</strong>
                        </div>
                        <div class="course-meta-item">
                            <span data-hi="टेस्ट सीरीज" data-en="Mock Tests">टेस्ट सीरीज</span>
                            <strong data-hi="50+ ऑनलाइन टेस्ट" data-en="50+ Online Mock Tests">50+ ऑनलाइन टेस्ट</strong>
                        </div>
                    </div>
                    <button class="btn btn-navy course-btn" onclick="openCourseInquiry('CCC')">
                        <span data-hi="CCC में प्रवेश लें" data-en="Enroll for CCC">CCC में प्रवेश लें</span>
                    </button>
                </div>

                <!-- Course 3: TALLY -->
                <div class="course-card">
                    <div class="course-top">
                        <span class="course-code">TALLY PRIME</span>
                        <span class="course-badge" data-hi="अकाउंटेंट जॉब रेडी" data-en="Accounting Job Ready">अकाउंटेंट
                            जॉब रेडी</span>
                    </div>
                    <h3 class="course-name">Tally Prime with GST & e-Way Bill</h3>
                    <p class="course-desc"
                        data-hi="दुकानों, कंपनियों और पेट्रोल पंपों में अकाउंटेंट की नौकरी के लिए। प्रैक्टिकल वाउचर एंट्री, जीएसटी बिलिंग, इन्वेंटरी और बैलेंस शीट।"
                        data-en="Practical computerized accounting, GST billing, voucher entry, inventory, and balance sheets for businesses and firms.">
                        दुकानों, कंपनियों और पेट्रोल पंपों में अकाउंटेंट की नौकरी के लिए। प्रैक्टिकल वाउचर एंट्री,
                        जीएसटी बिलिंग, इन्वेंटरी और बैलेंस शीट।</p>
                    <div class="course-tags">
                        <span class="course-tag">Tally Prime</span>
                        <span class="course-tag">GST Invoicing</span>
                        <span class="course-tag">Payroll</span>
                        <span class="course-tag">Balance Sheet</span>
                        <span class="course-tag">
                            <svg class="sw-icon" viewBox="0 0 24 24">
                                <rect x="1" y="1" width="22" height="22" rx="5" fill="#0284C7" />
                                <path d="M6 8.5H18M12 8.5V17" stroke="#FDE047" stroke-width="2.4"
                                    stroke-linecap="round" />
                                <circle cx="17" cy="15.5" r="2" fill="#FDE047" />
                            </svg>
                            Tally Prime
                        </span>
                        <span class="course-tag">
                            <svg class="sw-icon" viewBox="0 0 24 24">
                                <rect x="1" y="1" width="22" height="22" rx="5" fill="#D97706" /><text x="12" y="15"
                                    text-anchor="middle" fill="#fff" font-family="sans-serif" font-weight="800"
                                    font-size="8.5">GST</text>
                            </svg>
                            GST Invoicing
                        </span>
                        <span class="course-tag">
                            <svg class="sw-icon" viewBox="0 0 24 24">
                                <rect x="1" y="1" width="22" height="22" rx="5" fill="#059669" />
                                <path d="M8 8H16M8 11.5H15M8 8C11.5 8 13 9.5 13 11.5C13 13.5 11.5 15 8 15L14.5 18"
                                    stroke="#fff" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round"
                                    fill="none" />
                            </svg>
                            Payroll
                        </span>
                        <span class="course-tag">
                            <svg class="sw-icon" viewBox="0 0 24 24">
                                <rect x="1" y="1" width="22" height="22" rx="5" fill="#2563EB" />
                                <path d="M6.5 15.5L10 11.5L13.5 14L17.5 8.5" stroke="#fff" stroke-width="2.2"
                                    stroke-linecap="round" stroke-linejoin="round" fill="none" />
                                <circle cx="17.5" cy="8.5" r="1.8" fill="#93C5FD" />
                            </svg>
                            Balance Sheet
                        </span>
                    </div>
                    <div class="course-meta">
                        <div class="course-meta-item">
                            <span data-hi="अवधि (Duration)" data-en="Duration">अवधि (Duration)</span>
                            <strong data-hi="3 से 6 महीने" data-en="3 to 6 Months">3 से 6 महीने</strong>
                        </div>
                        <div class="course-meta-item">
                            <span data-hi="ट्रेनिंग मोड" data-en="Training Mode">ट्रेनिंग मोड</span>
                            <strong data-hi="दुकान के असली डेटा पर" data-en="Real Business Data">दुकान के असली डेटा
                                पर</strong>
                        </div>
                    </div>
                    <button class="btn btn-navy course-btn" onclick="openCourseInquiry('TALLY')">
                        <span data-hi="Tally में प्रवेश लें" data-en="Enroll for Tally">Tally में प्रवेश लें</span>
                    </button>
                </div>

                <!-- Course 4: TYPING -->
                <div class="course-card">
                    <div class="course-top">
                        <span class="course-code">TYPING MASTER</span>
                        <span class="course-badge" data-hi="हाईकोर्ट व SSC क्लर्क"
                            data-en="High Court & SSC Typing">हाईकोर्ट व SSC क्लर्क</span>
                    </div>
                    <h3 class="course-name">हिन्दी (कृतिदेव/मंगल) एवं इंग्लिश टाइपिंग</h3>
                    <h3 class="course-name" data-hi="हिन्दी (कृतिदेव/मंगल) एवं इंग्लिश टाइपिंग"
                        data-en="Hindi (KrutiDev/Mangal) & English Typing">Hindi (KrutiDev/Mangal) & English Typing</h3>
                    <p class="course-desc"
                        data-hi="इलाहाबाद हाईकोर्ट, SSC, कनिष्ठ सहायक और सचिवालय भर्ती परीक्षाओं के लिए विशेष स्पीड और एक्यूरेसी (35 से 45+ शब्द/मिनट) की तैयारी।"
                        data-en="Specialized speed training in Hindi (KrutiDev 010 & Mangal) and English for High Court, SSC, and state clerical exams.">
                        इलाहाबाद हाईकोर्ट, SSC, कनिष्ठ सहायक और सचिवालय भर्ती परीक्षाओं के लिए विशेष स्पीड और एक्यूरेसी
                        (35 से 45+ शब्द/मिनट) की तैयारी।</p>
                    <div class="course-tags">
                        <span class="course-tag">KrutiDev 010</span>
                        <span class="course-tag">Mangal Font</span>
                        <span class="course-tag">English 35+ WPM</span>
                        <span class="course-tag">Live Tests</span>
                        <span class="course-tag">
                            <svg class="sw-icon" viewBox="0 0 24 24">
                                <rect x="1" y="1" width="22" height="22" rx="5" fill="#EA580C" /><text x="12" y="16"
                                    text-anchor="middle" fill="#fff" font-family="sans-serif" font-weight="800"
                                    font-size="11.5">क</text>
                            </svg>
                            KrutiDev 010
                        </span>
                        <span class="course-tag">
                            <svg class="sw-icon" viewBox="0 0 24 24">
                                <rect x="1" y="1" width="22" height="22" rx="5" fill="#DC2626" /><text x="12" y="16"
                                    text-anchor="middle" fill="#fff" font-family="sans-serif" font-weight="800"
                                    font-size="11.5">अ</text>
                            </svg>
                            Mangal Font
                        </span>
                        <span class="course-tag">
                            <svg class="sw-icon" viewBox="0 0 24 24">
                                <rect x="1" y="1" width="22" height="22" rx="5" fill="#2563EB" /><text x="12" y="15.5"
                                    text-anchor="middle" fill="#fff" font-family="sans-serif" font-weight="800"
                                    font-size="9.5">A-Z</text>
                            </svg>
                            English 35+ WPM
                        </span>
                        <span class="course-tag">
                            <svg class="sw-icon" viewBox="0 0 24 24">
                                <rect x="1" y="1" width="22" height="22" rx="5" fill="#7C3AED" />
                                <path d="M13 6L7.5 13H12L11 18L16.5 11H12L13 6Z" fill="#FDE047" />
                            </svg>
                            Live Tests
                        </span>
                    </div>
                    <div class="course-meta">
                        <div class="course-meta-item">
                            <span data-hi="अवधि (Duration)" data-en="Duration">अवधि (Duration)</span>
                            <strong data-hi="3 माह / फ्लेक्सिबल" data-en="3 Months / Flexible">3 माह /
                                फ्लेक्सिबल</strong>
                        </div>
                        <div class="course-meta-item">
                            <span data-hi="टारगेट स्पीड" data-en="Target Speed">टारगेट स्पीड</span>
                            <strong data-hi="30 - 45+ शब्द/मिनट" data-en="30 - 45+ WPM">30 - 45+ शब्द/मिनट</strong>
                        </div>
                    </div>
                    <button class="btn btn-navy course-btn" onclick="openCourseInquiry('TYPING')">
                        <span data-hi="टाइपिंग बैच जॉइन करें" data-en="Join Typing Batch">टाइपिंग बैच जॉइन करें</span>
                    </button>
                </div>

                <!-- Course 5: DCA -->
                <div class="course-card">
                    <div class="course-top">
                        <span class="course-code">DCA</span>
                        <span class="course-badge" data-hi="बेसिक फाउंडेशन" data-en="Foundation Diploma">बेसिक
                            फाउंडेशन</span>
                    </div>
                    <h3 class="course-name">Diploma in Computer Applications</h3>
                    <p class="course-desc"
                        data-hi="6 महीने का बुनियादी डिप्लोमा। कम्प्यूटर को शुरुआत से चलाना, ऑफिस वर्क, इंटरनेट फॉर्म भरना और डॉक्यूमेंट प्रिंट करना सीखें।"
                        data-en="6-month fundamental diploma covering basic computer operations, MS Office suite, internet browsing, and official work.">
                        6 महीने का बुनियादी डिप्लोमा। कम्प्यूटर को शुरुआत से चलाना, ऑफिस वर्क, इंटरनेट फॉर्म भरना और
                        डॉक्यूमेंट प्रिंट करना सीखें।</p>
                    <div class="course-tags">
                        <span class="course-tag">Windows OS</span>
                        <span class="course-tag">MS Word</span>
                        <span class="course-tag">MS Excel</span>
                        <span class="course-tag">PowerPoint</span>
                        <span class="course-tag">
                            <svg class="sw-icon" viewBox="0 0 24 24">
                                <rect x="1" y="1" width="22" height="22" rx="5" fill="#0078D4" />
                                <rect x="5.5" y="5.5" width="5.5" height="5.5" fill="#fff" />
                                <rect x="13" y="5.5" width="5.5" height="5.5" fill="#fff" />
                                <rect x="5.5" y="13" width="5.5" height="5.5" fill="#fff" />
                                <rect x="13" y="13" width="5.5" height="5.5" fill="#fff" />
                            </svg>
                            Windows OS
                        </span>
                        <span class="course-tag">
                            <svg class="sw-icon" viewBox="0 0 24 24">
                                <rect x="1" y="1" width="22" height="22" rx="5" fill="#185ABD" />
                                <path d="M5.5 7.5L8 16.5L10.5 9.5L13 16.5L15.5 7.5" stroke="#fff" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" fill="none" />
                                <line x1="17.5" y1="8.5" x2="19.5" y2="8.5" stroke="#93C5FD" stroke-width="1.8"
                                    stroke-linecap="round" />
                                <line x1="17.5" y1="12" x2="19.5" y2="12" stroke="#93C5FD" stroke-width="1.8"
                                    stroke-linecap="round" />
                                <line x1="17.5" y1="15.5" x2="19.5" y2="15.5" stroke="#93C5FD" stroke-width="1.8"
                                    stroke-linecap="round" />
                            </svg>
                            MS Word
                        </span>
                        <span class="course-tag">
                            <svg class="sw-icon" viewBox="0 0 24 24">
                                <rect x="1" y="1" width="22" height="22" rx="5" fill="#107C41" />
                                <path d="M6.5 8L12.5 16M12.5 8L6.5 16" stroke="#fff" stroke-width="2.2"
                                    stroke-linecap="round" />
                                <rect x="15" y="7.5" width="4" height="2.2" rx="0.5" fill="#86EFAC" />
                                <rect x="15" y="10.9" width="4" height="2.2" rx="0.5" fill="#86EFAC" />
                                <rect x="15" y="14.3" width="4" height="2.2" rx="0.5" fill="#86EFAC" />
                            </svg>
                            MS Excel
                        </span>
                        <span class="course-tag">
                            <svg class="sw-icon" viewBox="0 0 24 24">
                                <rect x="1" y="1" width="22" height="22" rx="5" fill="#D24726" /><text x="9" y="16"
                                    text-anchor="middle" fill="#fff" font-family="sans-serif" font-weight="800"
                                    font-size="11">P</text>
                                <circle cx="16.5" cy="12" r="3" fill="#FDBA74" />
                            </svg>
                            PowerPoint
                        </span>
                    </div>
                    <div class="course-meta">
                        <div class="course-meta-item">
                            <span data-hi="अवधि (Duration)" data-en="Duration">अवधि (Duration)</span>
                            <strong data-hi="6 महीने" data-en="6 Months">6 महीने</strong>
                        </div>
                        <div class="course-meta-item">
                            <span data-hi="प्रैक्टिकल अनुपात" data-en="Lab Ratio">प्रैक्टिकल अनुपात</span>
                            <strong data-hi="80% लैब समय" data-en="80% Hands-on Practice">80% लैब समय</strong>
                        </div>
                    </div>
                    <button class="btn btn-navy course-btn" onclick="openCourseInquiry('DCA')">
                        <span data-hi="DCA में प्रवेश लें" data-en="Enroll for DCA">DCA में प्रवेश लें</span>
                    </button>
                </div>

                <!-- Course 6: DTP -->
                <div class="course-card">
                    <div class="course-top">
                        <span class="course-code">DTP</span>
                        <span class="course-badge" data-hi="प्रिंटिंग व डिजाइनिंग"
                            data-en="Graphic Design & Print">प्रिंटिंग व डिजाइनिंग</span>
                    </div>
                    <h3 class="course-name">Desktop Publishing & Flex Design</h3>
                    <p class="course-desc"
                        data-hi="शादी कार्ड, फ्लेक्स बैनर, बुकलेट, पोस्टर और विज्ञापन डिजाइन करना सीखें। प्रिंटिंग प्रेस या खुद की दुकान खोलने के लिए उपयोगी।"
                        data-en="Master wedding card designing, flex banners, brochures, and digital printing press software with hands-on projects.">
                        शादी कार्ड, फ्लेक्स बैनर, बुकलेट, पोस्टर और विज्ञापन डिजाइन करना सीखें। प्रिंटिंग प्रेस या खुद
                        की दुकान खोलने के लिए उपयोगी।</p>
                    <div class="course-tags">
                        <span class="course-tag">Photoshop</span>
                        <span class="course-tag">CorelDraw</span>
                        <span class="course-tag">PageMaker</span>
                        <span class="course-tag">
                            <svg class="sw-icon" viewBox="0 0 24 24">
                                <rect x="1" y="1" width="22" height="22" rx="5" fill="#001E36" stroke="#31A8FF"
                                    stroke-width="1.5" /><text x="12" y="15.5" text-anchor="middle" fill="#31A8FF"
                                    font-family="sans-serif" font-weight="800" font-size="10.5">Ps</text>
                            </svg>
                            Photoshop
                        </span>
                        <span class="course-tag">
                            <svg class="sw-icon" viewBox="0 0 24 24">
                                <rect x="1" y="1" width="22" height="22" rx="5" fill="#4D9E14" />
                                <path
                                    d="M12 5C9 5 7.5 7.5 7.5 10.5C7.5 13.5 10.2 16 12 17.5C13.8 16 16.5 13.5 16.5 10.5C16.5 7.5 15 5 12 5Z"
                                    fill="#fff" />
                                <path d="M10.5 19H13.5" stroke="#BEF264" stroke-width="2" stroke-linecap="round" />
                            </svg>
                            CorelDraw
                        </span>
                        <span class="course-tag">
                            <svg class="sw-icon" viewBox="0 0 24 24">
                                <rect x="1" y="1" width="22" height="22" rx="5" fill="#7E22CE" /><text x="12" y="15.5"
                                    text-anchor="middle" fill="#F3E8FF" font-family="sans-serif" font-weight="800"
                                    font-size="9.5">Pm</text>
                            </svg>
                            PageMaker
                        </span>
                    </div>
                    <div class="course-meta">
                        <div class="course-meta-item">
                            <span data-hi="अवधि (Duration)" data-en="Duration">अवधि (Duration)</span>
                            <strong data-hi="3 महीने" data-en="3 Months">3 महीने</strong>
                        </div>
                        <div class="course-meta-item">
                            <span data-hi="फोकस" data-en="Core Focus">फोकस</span>
                            <strong data-hi="कमर्शियल प्रिंटिंग वर्क" data-en="Commercial Printing">कमर्शियल प्रिंटिंग
                                वर्क</strong>
                        </div>
                    </div>
                    <button class="btn btn-navy course-btn" onclick="openCourseInquiry('DTP')">
                        <span data-hi="DTP में प्रवेश लें" data-en="Enroll for DTP">DTP में प्रवेश लें</span>
                    </button>
                </div>
            </div>

            <!-- Human Reassuring Notice Box -->
            <div class="human-notice-box">
                <div class="human-notice-text">
                    <strong data-hi="फीस में छूट एवं आसान मासिक किस्तों की सुविधा (Monthly Installments):"
                        data-en="Fee Concessions & Monthly Installment Options (EMI):">फीस में छूट एवं आसान मासिक
                        किस्तों की सुविधा (Monthly Installments):</strong>
                    <p data-hi="गाँव के गरीब एवं होनहार छात्र-छात्राओं के लिए फीस में विशेष छूट एवं मासिक किस्तों की सुविधा उपलब्ध है। आर्थिक तंगी से किसी की पढ़ाई नहीं रुकेगी।"
                        data-en="Special fee discounts and flexible monthly installment plans are available for underprivileged and meritorious students.">
                        गाँव के गरीब एवं होनहार छात्र-छात्राओं के लिए फीस में विशेष छूट एवं मासिक किस्तों की सुविधा
                        उपलब्ध है। आर्थिक तंगी से किसी की पढ़ाई नहीं रुकेगी।</p>
                </div>
                <a href="https://api.whatsapp.com/send?phone=+918736002004&text=नमस्ते%20SCAIT,%20मुझे%20कोर्स%20की%20फीस%20और%20किस्तों%20के%20बारे%20में%20जानना%20है।"
                    target="_blank" class="btn btn-navy">
                    <span data-hi="फीस की जानकारी लें" data-en="Inquire About Fees">फीस की जानकारी लें</span>
                </a>
            </div>
        </div>
    </section>

    <!-- ── Dedicated Certificate Hub Section ── -->
    <section id="verify" class="cert-hub-section">
        <div class="container">
            <div class="cert-hub-grid">

                <!-- Left: Certificate Features Info -->
                <div>
                    <span class="section-pill" data-hi="सर्टिफिकेट सत्यापन" data-en="Certificate Hub">
                        सर्टिफिकेट सत्यापन
                    </span>
                    <h2 class="section-title" data-hi="डिजिटल सर्टिफिकेट व रिजल्ट वेरिफिकेशन"
                        data-en="Instant Digital Certificate & Result Verification">डिजिटल सर्टिफिकेट व रिजल्ट
                        वेरिफिकेशन</h2>
                    <p class="section-desc"
                        data-hi="SCAIT अकेडमी द्वारा जारी सभी डिप्लोमा और प्रमाण पत्र सरकारी एवं निजी नौकरियों में सत्यापन के लिए पूरी तरह मान्य हैं। प्रत्येक सर्टिफिकेट पर छात्र का यूनिक रोल नंबर और ऑनलाइन क्यूआर कोड अंकित रहता है।"
                        data-en="Every diploma and certificate issued by SCAIT Academy is fully recognized for government and private employment verification, featuring a secure roll number and encrypted QR verification code.">
                        SCAIT अकेडमी द्वारा जारी सभी डिप्लोमा और प्रमाण पत्र सरकारी एवं निजी नौकरियों में सत्यापन के लिए
                        पूरी तरह मान्य हैं। प्रत्येक सर्टिफिकेट पर छात्र का यूनिक रोल नंबर और ऑनलाइन क्यूआर कोड अंकित
                        रहता है।
                    </p>

                    <ul class="cert-steps-list">
                        <li class="cert-step-item">
                            <span class="cert-step-num">1</span>
                            <div class="cert-step-text">
                                <strong data-hi="कोर्स व रोल नंबर दर्ज करें"
                                    data-en="1. Select Course & Enter Roll No.">कोर्स व रोल नंबर दर्ज करें</strong>
                                <p data-hi="अपने प्रवेश पत्र (Admit Card) या आई-कार्ड पर लिखा रोल नंबर दर्ज करें।"
                                    data-en="Provide the official roll number printed on your institute ID card or exam hall ticket.">
                                    अपने प्रवेश पत्र (Admit Card) या आई-कार्ड पर लिखा रोल नंबर दर्ज करें।</p>
                            </div>
                        </li>
                        <li class="cert-step-item">
                            <span class="cert-step-num">2</span>
                            <div class="cert-step-text">
                                <strong data-hi="ऑनलाइन डेटाबेस से तत्काल मिलान"
                                    data-en="2. Live Database Record Match">ऑनलाइन डेटाबेस से तत्काल मिलान</strong>
                                <p data-hi="संस्थान का सिस्टम छात्र का नाम, प्राप्तांक और पासपोर्ट फोटो सत्यापित करता है।"
                                    data-en="The academy database validates your grades, scores, enrollment number, and student photograph.">
                                    संस्थान का सिस्टम छात्र का नाम, प्राप्तांक और पासपोर्ट फोटो सत्यापित करता है।</p>
                            </div>
                        </li>
                        <li class="cert-step-item">
                            <span class="cert-step-num">3</span>
                            <div class="cert-step-text">
                                <strong data-hi="1-क्लिक में ओरिजिनल सर्टिफिकेट डाउनलोड"
                                    data-en="3. 1-Click High-Resolution Download">1-क्लिक में ओरिजिनल सर्टिफिकेट
                                    डाउनलोड</strong>
                                <p data-hi="आधिकारिक डिजिटल मुहर के साथ उच्च-गुणवत्ता प्रिंटेबल सर्टिफिकेट प्राप्त करें।"
                                    data-en="Download print-ready official certificate with the SCAIT digital seal and authentication.">
                                    आधिकारिक डिजिटल मुहर के साथ उच्च-गुणवत्ता प्रिंटेबल सर्टिफिकेट प्राप्त करें।</p>
                            </div>
                        </li>
                    </ul>

                    <div style="margin-top: 24px; display:flex; gap:12px; flex-wrap:wrap;">
                        <button onclick="scrollToCertWidget()" class="btn btn-primary">
                            <span class="icon" style="width:15px;height:15px;">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="11" cy="11" r="8" />
                                    <line x1="21" y1="21" x2="16.65" y2="16.65" />
                                </svg>
                            </span>
                            <span data-hi="अपना सर्टिफिकेट चेक करें" data-en="Check Your Certificate">अपना सर्टिफिकेट
                                चेक करें</span>
                        </button>
                        <a href="/veriy/" class="btn btn-navy">
                            <span class="icon" style="width:15px;height:15px;">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="3" y="3" width="7" height="7" />
                                    <rect x="14" y="3" width="7" height="7" />
                                    <rect x="14" y="14" width="7" height="7" />
                                    <rect x="3" y="14" width="7" height="7" />
                                </svg>
                            </span>
                            <span data-hi="QR कोड स्कैनर पोर्टल" data-en="Scan QR Verification">QR कोड स्कैनर
                                पोर्टल</span>
                        </a>
                    </div>
                </div>

                <!-- Right: Visual Trust Showcase Card -->
                <div>
                    <div class="cert-showcase-card">
                        <span class="cert-showcase-badge" data-hi="ऑनलाइन सत्यापित प्रमाण पत्र"
                            data-en="Official Digital Record">
                            ऑनलाइन सत्यापित प्रमाण पत्र
                        </span>

                        <div class="cert-showcase-preview">
                            <div class="cert-preview-header">
                                <div class="cert-preview-logo">
                                    <strong>SCAIT ACADEMY</strong>
                                    <span>तेवां, कौशाम्बी (उ.प्र.)</span>
                                </div>
                                <div class="cert-preview-seal">
                                    <span class="icon" style="width:18px;height:18px;">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <circle cx="12" cy="8" r="7" />
                                            <polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88" />
                                        </svg>
                                    </span>
                                </div>
                            </div>
                            <div class="cert-preview-meta">
                                <div><span data-hi="कोर्स:" data-en="Course:">कोर्स:</span> <strong>Advance Diploma
                                        (ADCA)</strong></div>
                                <div><span data-hi="प्राप्त ग्रेड:" data-en="Grade:">प्राप्त ग्रेड:</span> <strong
                                        style="color:var(--orange);">Grade "A"</strong></div>
                                <div><span data-hi="सत्यापन:" data-en="Status:">सत्यापन:</span> <strong
                                        style="color:var(--green);" data-hi="मान्य व वेरिफाइड"
                                        data-en="Active & Verified">मान्य व वेरिफाइड</strong></div>
                                <div><span data-hi="प्रमाणीकरण:" data-en="Auth:">प्रमाणीकरण:</span> <strong
                                        data-hi="डिजिटल सील व QR" data-en="Seal & QR Code">डिजिटल सील व QR</strong>
                                </div>
                            </div>
                        </div>

                        <h3 style="font-size: 18px; color: var(--white); margin-bottom: 8px;"
                            data-hi="2008 से सभी सत्रों का रिकॉर्ड उपलब्ध"
                            data-en="Records Cataloged Since Session 2008">2008 से सभी सत्रों का रिकॉर्ड उपलब्ध</h3>
                        <p style="font-size: 13px; color: rgba(255,255,255,0.8); margin-bottom: 18px;"
                            data-hi="यदि आपको अपना पुराना रोल नंबर याद नहीं है, तो हमारे कार्यालय से संपर्क करके अपना रोल नंबर व सर्टिफिकेट दोबारा प्राप्त कर सकते हैं।"
                            data-en="If you have misplaced your historical roll number, our institute support desk is ready to help you recover your record.">
                            यदि आपको अपना पुराना रोल नंबर याद नहीं है, तो हमारे कार्यालय से संपर्क करके अपना रोल नंबर व
                            सर्टिफिकेट दोबारा प्राप्त कर सकते हैं।
                        </p>

                        <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                            <button onclick="scrollToCertWidget()" class="btn btn-outline-white" style="flex:1;">
                                <span data-hi="रोल नंबर दर्ज करें &rarr;" data-en="Enter Roll Number &rarr;">रोल नंबर
                                    दर्ज करें &rarr;</span>
                            </button>
                            <a href="https://api.whatsapp.com/send?phone=+918736002004&text=नमस्ते%20SCAIT,%20मेरा%20पुराना%20रोल%20नंबर%20चेक%20करना%20है।"
                                target="_blank" class="btn btn-whatsapp">
                                <span data-hi="व्हाट्सएप सहायता" data-en="WhatsApp Helpdesk">व्हाट्सएप सहायता</span>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ── Why Choose SCAIT / Director's Desk ── -->
    <section id="about" class="features-section">
        <div class="container">
            <div class="section-header">
                <span class="section-pill" data-hi="संस्थान परिचय व विशेषताएं" data-en="Why Choose SCAIT">संस्थान परिचय
                    व विशेषताएं</span>
                <h2 class="section-title" data-hi="कौशाम्बी का पसंदीदा कम्प्यूटर प्रशिक्षण केंद्र"
                    data-en="Kaushambi's Trusted Computer Institute">कौशाम्बी का पसंदीदा कम्प्यूटर प्रशिक्षण केंद्र</h2>
                <p class="section-desc"
                    data-hi="16 वर्षों से लगातार ग्रामीण व कस्बाई छात्र-छात्राओं को आत्मनिर्भर और कुशल बनाने के लिए समर्पित शिक्षण संस्थान।"
                    data-en="Over 16 years of dedicated service empowering town and rural students with career-ready computer education.">
                    16 वर्षों से लगातार ग्रामीण व कस्बाई छात्र-छात्राओं को आत्मनिर्भर और कुशल बनाने के लिए समर्पित
                    शिक्षण संस्थान।</p>
            </div>

            <!-- Founder Quote Card -->
            <div class="founder-quote-card">
                <p class="founder-quote-text"
                    data-hi='"ग्रामीण और कस्बाई अंचल के छात्र-छात्राओं में प्रतिभा की कोई कमी नहीं है, बस उन्हें सही मार्गदर्शन और हाथ से कंप्यूटर चलाने का पूरा समय मिलना चाहिए। SCAIT में हमारा प्रयास है कि हर एक विद्यार्थी कंप्यूटर में पूरी तरह निपुण बनकर अपने पैरों पर खड़ा हो सके और सरकारी व प्राइवेट नौकरियों में पूरे आत्मविश्वास से आगे बढ़ सके।"'
                    data-en='"Our mission is to provide rural and town youth with genuine, hands-on computer competence so they can confidently succeed in government examinations and private careers."'>
                    "ग्रामीण और कस्बाई अंचल के छात्र-छात्राओं में प्रतिभा की कोई कमी नहीं है, बस उन्हें सही मार्गदर्शन
                    और हाथ से कंप्यूटर चलाने का पूरा समय मिलना चाहिए। SCAIT में हमारा प्रयास है कि हर एक विद्यार्थी
                    कंप्यूटर में पूरी तरह निपुण बनकर अपने पैरों पर खड़ा हो सके और सरकारी व प्राइवेट नौकरियों में पूरे
                    आत्मविश्वास से आगे बढ़ सके।"
                </p>
                <div class="founder-author">
                    <div class="founder-avatar">अ</div>
                    <div>
                        <strong data-hi="अतुल तिवारी (निदेशक)" data-en="Atul Tiwari (Director)">अतुल तिवारी
                            (निदेशक)</strong>
                        <span data-hi="स्टूडेंट कंप्यूटर अकेडमी ऑफ आईटी (SCAIT), तेवां कौशाम्बी"
                            data-en="Student Computer Academy of IT (SCAIT), Tewa Kaushambi">स्टूडेंट कंप्यूटर अकेडमी ऑफ
                            आईटी (SCAIT), तेवां कौशाम्बी</span>
                    </div>
                </div>
            </div>

            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon-box">
                        <span class="icon" style="width:22px;height:22px;">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <rect x="2" y="3" width="20" height="14" rx="2" ry="2" />
                                <line x1="8" y1="21" x2="16" y2="21" />
                                <line x1="12" y1="17" x2="12" y2="21" />
                            </svg>
                        </span>
                    </div>
                    <h3 class="feature-title" data-hi="1 छात्र = 1 अलग कंप्यूटर" data-en="1:1 Dedicated Computer">1
                        छात्र = 1 अलग कंप्यूटर</h3>
                    <p class="feature-desc"
                        data-hi="स्क्रीन शेयरिंग नहीं! हर विद्यार्थी को क्लास के दौरान अलग कंप्यूटर मिलता है ताकि पूरा समय खुद हाथ से प्रैक्टिकल कर सकें।"
                        data-en="Zero screen sharing! Every student receives their own dedicated PC to practice hands-on for the full session.">
                        स्क्रीन शेयरिंग नहीं! हर विद्यार्थी को क्लास के दौरान अलग कंप्यूटर मिलता है ताकि पूरा समय खुद
                        हाथ से प्रैक्टिकल कर सकें।</p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon-box">
                        <span class="icon" style="width:22px;height:22px;">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2" />
                            </svg>
                        </span>
                    </div>
                    <h3 class="feature-title" data-hi="100% इन्वर्टर व सोलर बैकअप" data-en="100% Power Backup">100%
                        इन्वर्टर व सोलर बैकअप</h3>
                    <p class="feature-desc"
                        data-hi="गाँव या कस्बे में बिजली कटने पर भी आपकी टाइपिंग या लैब क्लास कभी बाधित नहीं होती। हर समय कंप्यूटर चालू रहते हैं।"
                        data-en="Inverter and solar power systems ensure uninterrupted typing and lab sessions even during local power cuts.">
                        गाँव या कस्बे में बिजली कटने पर भी आपकी टाइपिंग या लैब क्लास कभी बाधित नहीं होती। हर समय
                        कंप्यूटर चालू रहते हैं।</p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon-box">
                        <span class="icon" style="width:22px;height:22px;">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                                <circle cx="9" cy="7" r="4" />
                                <path d="M23 21v-2a4 4 0 0 0-3-3.87" />
                                <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                            </svg>
                        </span>
                    </div>
                    <h3 class="feature-title" data-hi="सरल हिन्दी में प्रैक्टिकल क्लास"
                        data-en="Easy Bilingual Teaching">सरल हिन्दी में प्रैक्टिकल क्लास</h3>
                    <p class="feature-desc"
                        data-hi="अंग्रेजी से डरने की जरूरत नहीं! हमारे शिक्षक हर टॉपिक को आसान हिन्दी और देहाती भाषा में एक-एक स्टेप करके समझाते हैं।"
                        data-en="No need to fear complex English! Our faculty explains every concept in clear Hindi and local dialect step-by-step.">
                        अंग्रेजी से डरने की जरूरत नहीं! हमारे शिक्षक हर टॉपिक को आसान हिन्दी और देहाती भाषा में एक-एक
                        स्टेप करके समझाते हैं।</p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon-box">
                        <span class="icon" style="width:22px;height:22px;">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
                                <path d="m9 12 2 2 4-4" />
                            </svg>
                        </span>
                    </div>
                    <h3 class="feature-title" data-hi="छात्राओं हेतु सुरक्षित समय" data-en="Safe Batches for Girls">
                        छात्राओं हेतु सुरक्षित समय</h3>
                    <p class="feature-desc"
                        data-hi="बालिकाओं और कामकाजी विद्यार्थियों के लिए विशेष सुबह और दोपहर के सुरक्षित बैच और अनुकूल वातावरण उपलब्ध है।"
                        data-en="Safe and convenient morning and afternoon batch timings in a secure, supportive educational environment.">
                        बालिकाओं और कामकाजी विद्यार्थियों के लिए विशेष सुबह और दोपहर के सुरक्षित बैच और अनुकूल वातावरण
                        उपलब्ध है।</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ── Classroom Gallery ── -->
    <section id="gallery" class="gallery-section">
        <div class="container">
            <div class="section-header">
                <span class="section-pill" data-hi="संस्थान की झलकियां" data-en="Campus Life">संस्थान की झलकियां</span>
                <h2 class="section-title" data-hi="कंप्यूटर लैब व प्रैक्टिकल कक्षाएं"
                    data-en="Computer Lab & Practical Sessions">कंप्यूटर लैब व प्रैक्टिकल कक्षाएं</h2>
                <p class="section-desc"
                    data-hi="तेवां (कौशाम्बी) स्थित हमारे सेंटर में छात्र-छात्राओं के टाइपिंग और कंप्यूटर अभ्यास की वास्तविक तस्वीरें।"
                    data-en="Authentic photographs of students practicing in our computer labs and typing hall in Tewa, Kaushambi.">
                    तेवां (कौशाम्बी) स्थित हमारे सेंटर में छात्र-छात्राओं के टाइपिंग और कंप्यूटर अभ्यास की वास्तविक
                    तस्वीरें।</p>
            </div>

            <div class="gallery-grid">
                <div class="gallery-item"><img src="images/ami/1.jpg" alt="SCAIT Classroom" loading="lazy"></div>
                <div class="gallery-item"><img src="images/ami/2.jpg" alt="Computer Lab" loading="lazy"></div>
                <div class="gallery-item"><img src="images/ami/3.jpg" alt="Student Practice" loading="lazy"></div>
                <div class="gallery-item"><img src="images/ami/4.jpg" alt="Practical Class" loading="lazy"></div>
                <div class="gallery-item"><img src="images/ami/5.jpg" alt="Typing Batch" loading="lazy"></div>
                <div class="gallery-item"><img src="images/ami/6.jpg" alt="SCAIT Students" loading="lazy"></div>
            </div>
        </div>
    </section>

    <!-- ── Location & Contact ── -->
    <section id="contact" class="contact-section">
        <div class="container">
            <div class="section-header">
                <span class="section-pill" data-hi="संपर्क व पता" data-en="Get in Touch">संपर्क व पता</span>
                <h2 class="section-title" data-hi="सेंटर पर आएं या सीधे फोन करें" data-en="Visit Our Institute in Tewa">
                    सेंटर पर आएं या सीधे फोन करें</h2>
                <p class="section-desc"
                    data-hi="महेवा रोड (तेवां), कौशाम्बी में मुख्य बस स्टैंड व बाजार के पास स्थित। आसपास के सभी गाँवों से सीधा व सुगम रास्ता।"
                    data-en="Conveniently situated on Mahewa Road, Tewa, Kaushambi, easily accessible from all neighboring villages and towns.">
                    महेवा रोड (तेवां), कौशाम्बी में मुख्य बस स्टैंड व बाजार के पास स्थित। आसपास के सभी गाँवों से सीधा व
                    सुगम रास्ता।</p>
            </div>

            <div class="contact-grid">
                <div class="contact-card">
                    <h3 style="font-size: 19px; margin-bottom: 8px;" data-hi="संस्थान का पता व संपर्क सूत्र"
                        data-en="Institute Contact Information">संस्थान का पता व संपर्क सूत्र</h3>
                    <p style="color: var(--slate-600); font-size: 13.5px; margin-bottom: 16px;"
                        data-hi="प्रवेश, परीक्षा एवं छात्र सहायता हेतु प्रतिदिन सुबह 8:00 AM से शाम 6:00 PM तक खुला रहता है।"
                        data-en="Open daily from 8:00 AM to 6:00 PM for admissions, certifications, and student inquiries.">
                        प्रवेश, परीक्षा एवं छात्र सहायता हेतु प्रतिदिन सुबह 8:00 AM से शाम 6:00 PM तक खुला रहता है।</p>

                    <ul class="contact-info-list">
                        <li class="contact-info-item">
                            <div class="contact-icon-frame">
                                <span class="icon" style="width:18px;height:18px;color:var(--orange);">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" />
                                        <circle cx="12" cy="10" r="3" />
                                    </svg>
                                </span>
                            </div>
                            <div class="contact-info-text">
                                <strong data-hi="संस्थान का पता" data-en="Campus Address">संस्थान का पता</strong>
                                <p data-hi="स्टूडेंट कंप्यूटर अकेडमी ऑफ आईटी (SCAIT)<br>महेवा रोड, तेवां, जनपद कौशाम्बी, उत्तर प्रदेश &ndash; 212214"
                                    data-en="Student Computer Academy of IT (SCAIT)<br>Mahewa Road, Tewa, Kaushambi, Uttar Pradesh &ndash; 212214">
                                    स्टूडेंट कंप्यूटर अकेडमी ऑफ आईटी (SCAIT)<br>महेवा रोड, तेवां, जनपद कौशाम्बी, उत्तर
                                    प्रदेश &ndash; 212214</p>
                            </div>
                        </li>
                        <li class="contact-info-item">
                            <div class="contact-icon-frame">
                                <span class="icon" style="width:18px;height:18px;color:var(--orange);">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path
                                            d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z" />
                                    </svg>
                                </span>
                            </div>
                            <div class="contact-info-text">
                                <strong data-hi="हेल्पलाइन व कॉल नंबर" data-en="Helpline & Phone">हेल्पलाइन व कॉल
                                    नंबर</strong>
                                <p><a href="tel:8736002004">+91 8736002004</a></p>
                            </div>
                        </li>
                        <li class="contact-info-item">
                            <div class="contact-icon-frame">
                                <span class="icon" style="width:18px;height:18px;color:var(--orange);">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path
                                            d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
                                        <polyline points="22,6 12,13 2,6" />
                                    </svg>
                                </span>
                            </div>
                            <div class="contact-info-text">
                                <strong data-hi="ईमेल पता" data-en="Email Address">ईमेल पता</strong>
                                <p><a href="mailto:scaitin@scait.in">scaitin@scait.in</a></p>
                            </div>
                        </li>
                    </ul>

                    <div style="margin-top: 22px; display: flex; gap: 10px; flex-wrap:wrap;">
                        <a href="https://api.whatsapp.com/send?phone=+918736002004" target="_blank"
                            class="btn btn-whatsapp" style="flex:1;">
                            <span class="icon" style="width:18px;height:18px;">
                                <svg viewBox="0 0 24 24" fill="currentColor">
                                    <path
                                        d="M12.04 2c-5.46 0-9.91 4.45-9.91 9.91 0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21 5.46 0 9.91-4.45 9.91-9.91 0-2.65-1.03-5.14-2.9-7.01A9.82 9.82 0 0 0 12.04 2m.01 1.67c2.2 0 4.26.86 5.82 2.42a8.23 8.23 0 0 1 2.41 5.83c0 4.54-3.7 8.24-8.24 8.24-1.48 0-2.93-.39-4.19-1.15l-.3-.18-3.12.82.83-3.04-.2-.31a8.2 8.2 0 0 1-1.26-4.38c0-4.54 3.7-8.24 8.24-8.24m4.52 11.64c-.25-.12-1.47-.72-1.7-.81-.23-.08-.4-.12-.56.12-.17.25-.65.81-.8 1-.15.19-.3.21-.55.08-.25-.12-1.05-.39-2-1.23-.74-.66-1.24-1.47-1.39-1.72-.15-.25-.02-.38.11-.5.11-.11.25-.29.37-.43.12-.15.17-.25.25-.41.08-.17.04-.31-.02-.43s-.56-1.36-.77-1.86c-.2-.49-.41-.42-.56-.43h-.48c-.16 0-.43.06-.66.31-.23.25-.87.85-.87 2.07s.89 2.4 1.01 2.57c.12.17 1.75 2.67 4.24 3.74.59.26 1.05.41 1.41.53.6.19 1.14.16 1.57.1.48-.07 1.47-.6 1.68-1.18.21-.58.21-1.07.15-1.18-.06-.12-.23-.19-.48-.31z" />
                                </svg>
                            </span>
                            <span data-hi="व्हाट्सएप पर चैट करें" data-en="Chat on WhatsApp">व्हाट्सएप पर चैट
                                करें</span>
                        </a>
                        <a href="tel:8736002004" class="btn btn-navy" style="flex:1;">
                            <span class="icon" style="width:16px;height:16px;">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path
                                        d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z" />
                                </svg>
                            </span>
                            <span data-hi="कॉल करें" data-en="Call Helpline">कॉल करें</span>
                        </a>
                    </div>
                </div>

                <div class="map-wrap">
                    <iframe
                        src="https://maps.google.com/maps?q=Tewa,%20Kaushambi,%20Uttar%20Pradesh&t=&z=13&ie=UTF8&iwloc=&output=embed"
                        loading="lazy" allowfullscreen title="SCAIT Location Map"></iframe>
                </div>
            </div>
        </div>
    </section>

    <!-- ── Site Footer ── -->
    <footer class="site-footer">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-col">
                    <img src="images/logo-light.svg" alt="SCAIT Academy"
                        style="height:36px;width:auto;margin-bottom:14px;" onerror="this.src='images/logo.png'">
                    <p style="margin-bottom:12px; line-height:1.7;"
                        data-hi="2008 से जनपद कौशाम्बी में छात्र-छात्राओं को रोजगारपरक कम्प्यूटर व टाइपिंग शिक्षा प्रदान करने में समर्पित अग्रणी संस्थान।"
                        data-en="Dedicated to empowering students across Kaushambi district with job-ready IT, accounting, and typing education since 2008.">
                        2008 से जनपद कौशाम्बी में छात्र-छात्राओं को रोजगारपरक कम्प्यूटर व टाइपिंग शिक्षा प्रदान करने में
                        समर्पित अग्रणी संस्थान।</p>
                    <p style="color:#fdba74; font-weight:700;" data-hi="पंजीकरण संख्या: SCAIT/IT/2008"
                        data-en="Registration No: SCAIT/IT/2008">पंजीकरण संख्या: SCAIT/IT/2008</p>
                </div>
                <div class="footer-col">
                    <h4 data-hi="प्रमुख कोर्स (Top Courses)" data-en="Popular Courses">प्रमुख कोर्स (Top Courses)</h4>
                    <ul class="footer-links">
                        <li><a href="#courses">ADCA (1 Year Master Diploma)</a></li>
                        <li><a href="#courses">CCC (Govt Job Certification)</a></li>
                        <li><a href="#courses">Tally Prime & GST Billing</a></li>
                        <li><a href="#courses">DCA (6 Months Diploma)</a></li>
                        <li><a href="#courses">DTP (Desktop Publishing)</a></li>
                        <li><a href="#courses">Hindi & English Typing</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4 data-hi="त्वरित लिंक (Quick Links)" data-en="Quick Links">त्वरित लिंक (Quick Links)</h4>
                    <ul class="footer-links">
                        <li><a href="javascript:void(0)" onclick="scrollToCertWidget()"
                                data-hi="सर्टिफिकेट डाउनलोड करें" data-en="Download Certificate">सर्टिफिकेट डाउनलोड
                                करें</a></li>
                        <li><a href="/veriy/" data-hi="ऑनलाइन QR वेरिफिकेशन" data-en="Online QR Verification">ऑनलाइन QR
                                वेरिफिकेशन</a></li>
                        <li><a href="javascript:void(0)" onclick="openModal('modal-inquiry')"
                                data-hi="नए प्रवेश हेतु पूछताछ" data-en="New Admission Inquiry">नए प्रवेश हेतु
                                पूछताछ</a></li>
                        <li><a href="javascript:void(0)" onclick="openModal('modal-register')"
                                data-hi="छात्र रजिस्ट्रेशन" data-en="Student Registration">छात्र रजिस्ट्रेशन</a></li>
                        <li><a href="javascript:void(0)" onclick="openModal('modal-login')" data-hi="Admin पोर्टल लॉगिन"
                                data-en="Admin Portal Login">Admin पोर्टल लॉगिन</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4 data-hi="संस्थान कार्यालय" data-en="Institute Campus">संस्थान कार्यालय</h4>
                    <p data-hi="महेवा रोड, तेवां, जनपद कौशाम्बी (उ.प्र.)" data-en="Mahewa Road, Tewa, Kaushambi (U.P.)">
                        महेवा रोड, तेवां, जनपद कौशाम्बी (उ.प्र.)</p>
                    <p style="margin-top: 8px;"><strong>हेल्पलाइन:</strong> +91 8736002004</p>
                    <p style="margin-top: 8px;"><strong>ईमेल:</strong> scaitin@scait.in</p>
                </div>
            </div>

            <div class="footer-bottom">
                <p>&copy; <?= date('Y') ?> Student Computer Academy of IT (SCAIT). All rights reserved.</p>
                <p><a href="javascript:void(0)" onclick="openModal('modal-login')" style="opacity:0.6;">Admin Login</a>
                </p>
            </div>
        </div>
    </footer>

    <!-- ── Mobile Floating Action Bar ── -->
    <div class="mobile-bar">
        <a href="tel:8736002004" class="mobile-bar-btn">
            <span class="icon" style="width:20px;height:20px;">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round">
                    <path
                        d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z" />
                </svg>
            </span>
            <span data-hi="कॉल करें" data-en="Call">कॉल करें</span>
        </a>
        <a href="https://api.whatsapp.com/send?phone=+918736002004&text=नमस्ते%20SCAIT,%20मुझे%20कोर्स%20की%20जानकारी%20चाहिए।"
            target="_blank" class="mobile-bar-btn" style="color:#25D366;">
            <span class="icon" style="width:20px;height:20px;">
                <svg viewBox="0 0 24 24" fill="currentColor">
                    <path
                        d="M12.04 2c-5.46 0-9.91 4.45-9.91 9.91 0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21 5.46 0 9.91-4.45 9.91-9.91 0-2.65-1.03-5.14-2.9-7.01A9.82 9.82 0 0 0 12.04 2m.01 1.67c2.2 0 4.26.86 5.82 2.42a8.23 8.23 0 0 1 2.41 5.83c0 4.54-3.7 8.24-8.24 8.24-1.48 0-2.93-.39-4.19-1.15l-.3-.18-3.12.82.83-3.04-.2-.31a8.2 8.2 0 0 1-1.26-4.38c0-4.54 3.7-8.24 8.24-8.24m4.52 11.64c-.25-.12-1.47-.72-1.7-.81-.23-.08-.4-.12-.56.12-.17.25-.65.81-.8 1-.15.19-.3.21-.55.08-.25-.12-1.05-.39-2-1.23-.74-.66-1.24-1.47-1.39-1.72-.15-.25-.02-.38.11-.5.11-.11.25-.29.37-.43.12-.15.17-.25.25-.41.08-.17.04-.31-.02-.43s-.56-1.36-.77-1.86c-.2-.49-.41-.42-.56-.43h-.48c-.16 0-.43.06-.66.31-.23.25-.87.85-.87 2.07s.89 2.4 1.01 2.57c.12.17 1.75 2.67 4.24 3.74.59.26 1.05.41 1.41.53.6.19 1.14.16 1.57.1.48-.07 1.47-.6 1.68-1.18.21-.58.21-1.07.15-1.18-.06-.12-.23-.19-.48-.31z" />
                </svg>
            </span>
            <span data-hi="व्हाट्सएप" data-en="WhatsApp">व्हाट्सएप</span>
        </a>
        <button class="mobile-bar-btn active" onclick="scrollToCertWidget()">
            <span class="icon" style="width:20px;height:20px;">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round">
                    <path d="M22 10v6M2 10l10-5 10 5-10 5z" />
                    <path d="M6 12v5c3 3 9 3 12 0v-5" />
                </svg>
            </span>
            <span data-hi="सर्टिफिकेट" data-en="Certificate">सर्टिफिकेट</span>
        </button>
        <button class="mobile-bar-btn" onclick="openModal('modal-inquiry')">
            <span class="icon" style="width:20px;height:20px;">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round">
                    <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                    <circle cx="8.5" cy="7.5" r="4" />
                    <line x1="20" y1="8" x2="20" y2="14" />
                    <line x1="23" y1="11" x2="17" y2="11" />
                </svg>
            </span>
            <span data-hi="नया प्रवेश" data-en="Admission">नया प्रवेश</span>
        </button>
        <!-- Mobile Bottom Language Switcher Tab -->
        <button class="mobile-bar-btn" onclick="toggleLanguage()" id="mobileBarLangBtn" aria-label="Language Toggle">
            <span class="icon" style="width:20px;height:20px; color:var(--orange);">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10" />
                    <line x1="2" y1="12" x2="22" y2="12" />
                    <path
                        d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z" />
                </svg>
            </span>
            <span id="mobileBarLangLabel" style="font-weight:800; color:var(--orange);">English</span>
        </button>
    </div>

    <!-- ── MODAL 1: Check Certificate ── -->
    <div id="modal-cert" class="modal-overlay" onclick="closeModalOnBackdrop(event, this)">
        <div class="modal-box">
            <button class="modal-close" onclick="closeModal('modal-cert')" aria-label="Close"><svg width="16"
                    height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"
                    stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18" />
                    <line x1="6" y1="6" x2="18" y2="18" />
                </svg></button>
            <h3 class="modal-title" data-hi="सर्टिफिकेट चेक व डाउनलोड" data-en="Verify & Download Certificate">
                सर्टिफिकेट चेक व डाउनलोड</h3>
            <p class="modal-sub" data-hi="अपना कोर्स चुनें और 7-अंकों का रोल नंबर दर्ज करके ओरिजिनल सर्टिफिकेट देखें।"
                data-en="Select your course and enter your 7-digit roll number to download official certificate.">अपना
                कोर्स चुनें और 7-अंकों का रोल नंबर दर्ज करके ओरिजिनल सर्टिफिकेट देखें।</p>

            <form method="POST" action="s_chk_res.php">
                <div class="form-group">
                    <label class="form-label" data-hi="कोर्स चुनें (Select Course)" data-en="Select Course">कोर्स चुनें
                        (Select Course)</label>
                    <select name="cour" class="form-control no-icon" required>
                        <option value="">कोर्स चुनें...</option>
                        <option value="ADCA">ADCA (Advance Diploma)</option>
                        <option value="CCC">CCC (Computer Concepts)</option>
                        <option value="TALLY">TALLY Prime / ERP 9</option>
                        <option value="TYPING">TYPING (Hindi/English)</option>
                        <option value="DCA">DCA</option>
                        <option value="DTP">DTP</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label" data-hi="छात्र रोल नंबर" data-en="Student Roll Number">छात्र रोल
                        नंबर</label>
                    <input type="text" name="r_n" class="form-control no-icon" placeholder="उदा. 1001215"
                        data-placeholder-hi="उदा. 1001215" data-placeholder-en="e.g. 1001215" required
                        autocomplete="off" style="font-size:15px; font-weight:700;">
                </div>
                <button type="submit" name="chsubmit" class="btn btn-primary"
                    style="width:100%; height:46px; margin-top:8px;">
                    <span class="icon" style="width:18px;height:18px;">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="11" cy="11" r="8" />
                            <line x1="21" y1="21" x2="16.65" y2="16.65" />
                        </svg>
                    </span>
                    <span data-hi="सर्टिफिकेट डाउनलोड करें" data-en="Download Certificate">सर्टिफिकेट डाउनलोड
                        करें</span>
                </button>
            </form>
            <div style="margin-top: 16px; text-align: center; font-size: 12.5px;">
                <a href="/veriy/" style="color:var(--orange); font-weight:700;"
                    data-hi="ऑनलाइन QR कोड सत्यापन पोर्टल खोलें &rarr;"
                    data-en="Open Online QR Code Verification Portal &rarr;">ऑनलाइन QR कोड सत्यापन पोर्टल खोलें
                    &rarr;</a>
            </div>
        </div>
    </div>

    <!-- ── MODAL 2: Admission Inquiry ── -->
    <div id="modal-inquiry" class="modal-overlay" onclick="closeModalOnBackdrop(event, this)">
        <div class="modal-box">
            <button class="modal-close" onclick="closeModal('modal-inquiry')" aria-label="Close"><svg width="16"
                    height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"
                    stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18" />
                    <line x1="6" y1="6" x2="18" y2="18" />
                </svg></button>
            <h3 class="modal-title" data-hi="नए प्रवेश हेतु आवेदन" data-en="Apply for Admission">नए प्रवेश हेतु आवेदन
            </h3>
            <p class="modal-sub"
                data-hi="अपनी जानकारी दर्ज करें। हमारे काउंसलर 24 घंटे के भीतर आपसे फोन पर संपर्क करेंगे।"
                data-en="Submit your inquiry. Our institute counselor will contact you within 24 hours.">अपनी जानकारी
                दर्ज करें। हमारे काउंसलर 24 घंटे के भीतर आपसे फोन पर संपर्क करेंगे।</p>

            <form method="POST" action="s_adm.php">
                <div class="form-group">
                    <label class="form-label" data-hi="विद्यार्थी का नाम" data-en="Full Name">विद्यार्थी का नाम</label>
                    <input type="text" name="aname" class="form-control no-icon" placeholder="पूरा नाम लिखें"
                        data-placeholder-hi="पूरा नाम लिखें" data-placeholder-en="Full name" required>
                </div>
                <div class="form-group">
                    <label class="form-label" data-hi="मोबाइल नंबर (10 अंक)" data-en="Phone Number (10 digits)">मोबाइल
                        नंबर (10 अंक)</label>
                    <input type="tel" name="aphone" class="form-control no-icon" placeholder="कॉल या व्हाट्सएप नंबर"
                        data-placeholder-hi="कॉल या व्हाट्सएप नंबर" data-placeholder-en="10-digit mobile number"
                        required>
                </div>
                <div class="form-group">
                    <label class="form-label" data-hi="रुचि का कोर्स" data-en="Interested Course">रुचि का कोर्स</label>
                    <select name="course_interest" id="inquiryCourseSelect" class="form-control no-icon">
                        <option value="ADCA">ADCA (1 Year Master Diploma)</option>
                        <option value="CCC">CCC (Govt Job Certification)</option>
                        <option value="TALLY">Tally Prime & GST</option>
                        <option value="TYPING">Hindi & English Typing</option>
                        <option value="DCA">DCA (6 Months)</option>
                        <option value="DTP">DTP (Desktop Publishing)</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label" data-hi="गाँव / कस्बा" data-en="Village / Town">गाँव / कस्बा</label>
                    <input type="text" name="address" class="form-control no-icon" placeholder="उदा. तेवां, मंझनपुर"
                        data-placeholder-hi="उदा. तेवां, मंझनपुर" data-placeholder-en="e.g. Tewa, Manjhanpur" required>
                </div>
                <button type="submit" name="asubmit" class="btn btn-primary"
                    style="width:100%; height:46px; margin-top:8px;">
                    <span data-hi="पूछताछ सबमिट करें" data-en="Submit Admission Inquiry">पूछताछ सबमिट करें</span>
                </button>
            </form>
        </div>
    </div>

    <!-- ── MODAL 3: Admin Login ── -->
    <div id="modal-login" class="modal-overlay" onclick="closeModalOnBackdrop(event, this)">
        <div class="modal-box">
            <button class="modal-close" onclick="closeModal('modal-login')" aria-label="Close"><svg width="16"
                    height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"
                    stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18" />
                    <line x1="6" y1="6" x2="18" y2="18" />
                </svg></button>
            <h3 class="modal-title" data-hi="संस्थान Admin पोर्टल" data-en="Institute Admin Portal">संस्थान Admin पोर्टल
            </h3>
            <p class="modal-sub" data-hi="सर्टिफिकेट अपलोड एवं छात्र रिकॉर्ड प्रबंधन हेतु केवल अधिकृत लॉगिन।"
                data-en="Authorized staff login for student certificate uploads and records management.">सर्टिफिकेट
                अपलोड एवं छात्र रिकॉर्ड प्रबंधन हेतु केवल अधिकृत लॉगिन।</p>

            <form method="POST" action="admin_log.php">
                <div class="form-group">
                    <label class="form-label" data-hi="Admin यूजरनेम" data-en="Admin Username">Admin यूजरनेम</label>
                    <input type="text" name="admin" class="form-control no-icon" placeholder="यूजरनेम दर्ज करें"
                        data-placeholder-hi="यूजरनेम दर्ज करें" data-placeholder-en="Enter username" required>
                </div>
                <div class="form-group">
                    <label class="form-label" data-hi="पासवर्ड" data-en="Password">पासवर्ड</label>
                    <input type="password" name="adpass" class="form-control no-icon" placeholder="पासवर्ड दर्ज करें"
                        data-placeholder-hi="पासवर्ड दर्ज करें" data-placeholder-en="Enter password" required>
                </div>
                <button type="submit" name="adsubmit" class="btn btn-navy"
                    style="width:100%; height:46px; margin-top:8px;">
                    <span data-hi="डैशबोर्ड में लॉगिन करें" data-en="Login to Dashboard">डैशबोर्ड में लॉगिन करें</span>
                </button>
            </form>
        </div>
    </div>

    <!-- ── MODAL 4: Student Registration ── -->
    <div id="modal-register" class="modal-overlay" onclick="closeModalOnBackdrop(event, this)">
        <div class="modal-box">
            <button class="modal-close" onclick="closeModal('modal-register')" aria-label="Close"><svg width="16"
                    height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"
                    stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18" />
                    <line x1="6" y1="6" x2="18" y2="18" />
                </svg></button>
            <h3 class="modal-title" data-hi="छात्र रजिस्ट्रेशन" data-en="Student Registration">छात्र रजिस्ट्रेशन</h3>
            <p class="modal-sub" data-hi="संस्थान रिकॉर्ड हेतु अपनी प्रोफाइल बनाएं और पासपोर्ट फोटो अपलोड करें।"
                data-en="Create your academy profile and upload your passport photo for institute records.">संस्थान
                रिकॉर्ड हेतु अपनी प्रोफाइल बनाएं और पासपोर्ट फोटो अपलोड करें।</p>

            <form method="POST" action="s_det.php" enctype="multipart/form-data">
                <div class="form-group">
                    <label class="form-label" data-hi="विद्यार्थी का नाम" data-en="Full Name">विद्यार्थी का नाम</label>
                    <input type="text" name="name" class="form-control no-icon" placeholder="पूरा नाम लिखें"
                        data-placeholder-hi="पूरा नाम लिखें" data-placeholder-en="Enter full name" required>
                </div>
                <div class="form-group">
                    <label class="form-label" data-hi="मोबाइल नंबर" data-en="Phone Number">मोबाइल नंबर</label>
                    <input type="tel" name="phon" class="form-control no-icon" placeholder="मोबाइल नंबर दर्ज करें"
                        data-placeholder-hi="मोबाइल नंबर दर्ज करें" data-placeholder-en="10-digit mobile number"
                        required>
                </div>
                <div class="form-group">
                    <label class="form-label" data-hi="कोर्स चुनें" data-en="Select Course">कोर्स चुनें</label>
                    <select name="course" class="form-control no-icon" required>
                        <option value="" data-hi="कोर्स चुनें..." data-en="Select Course...">कोर्स चुनें...</option>
                        <option value="ADCA">ADCA</option>
                        <option value="DCA">DCA</option>
                        <option value="CCC">CCC</option>
                        <option value="DTP">DTP</option>
                        <option value="OTHER">OTHER</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label" data-hi="पासवर्ड बनाएं" data-en="Create Password">पासवर्ड बनाएं</label>
                    <input type="password" name="pass" class="form-control no-icon" required>
                </div>
                <div class="form-group">
                    <label class="form-label" data-hi="पासवर्ड दोबारा लिखें" data-en="Confirm Password">पासवर्ड दोबारा
                        लिखें</label>
                    <input type="password" name="pasc" class="form-control no-icon" required>
                </div>
                <div class="form-group">
                    <label class="form-label" data-hi="पासपोर्ट साइज फोटो" data-en="Passport Size Photo">पासपोर्ट साइज
                        फोटो</label>
                    <input type="file" name="file" class="form-control no-icon" accept="image/*" required
                        style="padding-top:10px;">
                </div>
                <button type="submit" name="submit" class="btn btn-primary"
                    style="width:100%; height:46px; margin-top:8px;">
                    <span data-hi="रजिस्ट्रेशन पूरा करें" data-en="Complete Registration">रजिस्ट्रेशन पूरा करें</span>
                </button>
            </form>
        </div>
    </div>

    <script>
        // ── Real-time Instant Language Switcher (Default: English) ──
        function setLanguage(lang) {
            if (lang !== 'hi' && lang !== 'en') lang = 'en';
            localStorage.setItem('scait_lang_v2', lang);
            document.documentElement.lang = lang;

            // Toggle active classes on switcher buttons
            document.querySelectorAll('#langBtnHi, #drawerLangBtnHi').forEach(b => {
                if (b) b.classList.toggle('active', lang === 'hi');
            });
            document.querySelectorAll('#langBtnEn, #drawerLangBtnEn').forEach(b => {
                if (b) b.classList.toggle('active', lang === 'en');
            });
            const mobBarLabel = document.getElementById('mobileBarLangLabel');
            if (mobBarLabel) {
                mobBarLabel.textContent = (lang === 'hi') ? 'English' : 'हिन्दी';
            }

            // Update all elements with data-hi and data-en
            document.querySelectorAll('[data-hi][data-en]').forEach(el => {
                const val = el.getAttribute('data-' + lang);
                if (val) el.innerHTML = val;
            });

            // Update input placeholders
            document.querySelectorAll('[data-placeholder-hi][data-placeholder-en]').forEach(el => {
                const ph = el.getAttribute('data-placeholder-' + lang);
                if (ph) el.placeholder = ph;
            });
        }

        function toggleLanguage() {
            const current = localStorage.getItem('scait_lang_v2') || 'en';
            setLanguage(current === 'hi' ? 'en' : 'hi');
        }

        // Initialize saved language or default to English
        const initialLang = localStorage.getItem('scait_lang_v2') || 'en';
        setLanguage(initialLang);
        document.addEventListener('DOMContentLoaded', () => {
            setLanguage(localStorage.getItem('scait_lang_v2') || 'en');
        });

        function toggleLanguage() {
            const current = localStorage.getItem('scait_lang') || 'hi';
            setLanguage(current === 'hi' ? 'en' : 'hi');
        }

        // Initialize saved language or default to Hindi
        document.addEventListener('DOMContentLoaded', () => {
            const saved = localStorage.getItem('scait_lang') || 'hi';
            setLanguage(saved);
        });

        // ── Modal Helpers ──
        function openModal(id) {
            const el = document.getElementById(id);
            if (el) el.classList.add('active');
            document.body.style.overflow = 'hidden';
        }
        function closeModal(id) {
            const el = document.getElementById(id);
            if (el) el.classList.remove('active');
            document.body.style.overflow = '';
        }
        function closeModalOnBackdrop(e, overlay) {
            if (e.target === overlay) {
                overlay.classList.remove('active');
                document.body.style.overflow = '';
            }
        }

        function switchTerminalTab(panelId, btn) {
            document.querySelectorAll('.terminal-tab').forEach(b => b.classList.remove('active'));
            document.querySelectorAll('.terminal-panel').forEach(p => p.classList.remove('active'));
            btn.classList.add('active');
            const panel = document.getElementById(panelId);
            if (panel) panel.classList.add('active');
        }

        function scrollToCertWidget() {
            const widget = document.getElementById('studentPortalWidget');
            if (widget) {
                widget.scrollIntoView({ behavior: 'smooth', block: 'center' });
                const certTabBtn = document.querySelector('.terminal-tab:first-child');
                if (certTabBtn) switchTerminalTab('tab-terminal-cert', certTabBtn);
                setTimeout(() => {
                    const rollInput = document.getElementById('heroRollInput');
                    if (rollInput) {
                        rollInput.focus();
                        rollInput.style.borderColor = 'var(--orange)';
                    }
                }, 400);
            } else {
                openModal('modal-cert');
            }
        }

        function openCourseInquiry(courseCode) {
            openModal('modal-inquiry');
            const sel = document.getElementById('inquiryCourseSelect');
            if (sel) {
                for (let i = 0; i < sel.options.length; i++) {
                    if (sel.options[i].value === courseCode) {
                        sel.selectedIndex = i;
                        break;
                    }
                }
            }
        }

        function toggleMobileMenu() {
            const drawer = document.getElementById('mobileDrawer');
            const overlay = document.getElementById('drawerOverlay');
            if (drawer && overlay) {
                drawer.classList.toggle('open');
                overlay.classList.toggle('open');
            }
        }

        document.addEventListener('keydown', e => {
            if (e.key === 'Escape') {
                document.querySelectorAll('.modal-overlay').forEach(m => m.classList.remove('active'));
                const drawer = document.getElementById('mobileDrawer');
                const overlay = document.getElementById('drawerOverlay');
                if (drawer) drawer.classList.remove('open');
                if (overlay) overlay.classList.remove('open');
                document.body.style.overflow = '';
            }
        });
    </script>
</body>

</html>