<?php
$error = isset($_GET['error']) ? htmlspecialchars($_GET['error']) : 'Something went wrong or the requested record was not found.';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notice | Student Computer Academy of IT</title>
    <link rel="shortcut icon" href="images/fav.ico" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Outfit:wght@600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --navy: #002147;
            --orange: #e66030;
            --slate-50: #f8fafc;
            --slate-200: #e2e8f0;
            --slate-600: #475569;
            --slate-800: #1e293b;
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--slate-50);
            color: var(--slate-800);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
        }
        .notice-card {
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 15px 40px rgba(0, 33, 71, 0.08);
            border: 1px solid var(--slate-200);
            max-width: 480px;
            width: 100%;
            padding: 40px 32px;
            text-align: center;
        }
        .icon-box {
            width: 64px;
            height: 64px;
            border-radius: 50%;
            background: #fff2ed;
            color: var(--orange);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
        }
        h1 {
            font-family: 'Outfit', sans-serif;
            color: var(--navy);
            font-size: 24px;
            margin-bottom: 12px;
        }
        p {
            color: var(--slate-600);
            font-size: 15px;
            line-height: 1.6;
            margin-bottom: 28px;
        }
        .btn-home {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--navy);
            color: #ffffff;
            padding: 12px 28px;
            border-radius: 9999px;
            text-decoration: none;
            font-weight: 700;
            font-size: 14px;
            transition: all 0.2s;
        }
        .btn-home:hover {
            background: var(--orange);
            transform: translateY(-1px);
        }
    </style>
</head>
<body>
    <div class="notice-card">
        <div class="icon-box">
            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"></circle>
                <line x1="12" y1="8" x2="12" y2="12"></line>
                <line x1="12" y1="16" x2="12.01" y2="16"></line>
            </svg>
        </div>
        <h1>Notice</h1>
        <p><?php echo $error; ?></p>
        <a href="index.php" class="btn-home">
            &larr; Return to Home Page
        </a>
    </div>
</body>
</html>
