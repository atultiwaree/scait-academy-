<?php
error_reporting(E_ALL & ~E_DEPRECATED & ~E_NOTICE);

require_once __DIR__ . '/../connection.php';
require_once __DIR__ . '/../lib/phpqrcode/qrlib.php';

function getStudent($identifier) {
    global $con;
    $identifier = trim($identifier);
    $stmt = mysqli_prepare($con, "SELECT * FROM s_cer_det WHERE roll = ? OR enroll = ? LIMIT 1");
    mysqli_stmt_bind_param($stmt, "ss", $identifier, $identifier);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($res);
    mysqli_stmt_close($stmt);
    return $row;
}

function generateQrTemp($url) {
    $tmpDir = sys_get_temp_dir();
    $qrFile = $tmpDir . '/scait_qr_' . md5($url) . '.png';
    if (!file_exists($qrFile) || filesize($qrFile) < 50) {
        @QRcode::png($url, $qrFile, QR_ECLEVEL_M, 4, 1);
    }
    return $qrFile;
}

function loadAnyImage($path) {
    if (empty($path)) return null;
    
    // Resolve relative path against project root if needed
    if (!file_exists($path)) {
        $candidate = __DIR__ . '/../' . ltrim($path, '/');
        if (file_exists($candidate)) $path = $candidate;
    }
    if (!file_exists($path) || filesize($path) < 100) return null;

    $info = @getimagesize($path);
    if (!$info) return null;

    $mime = $info['mime'] ?? '';
    if ($mime === 'image/jpeg' || $mime === 'image/jpg') {
        return @imagecreatefromjpeg($path);
    } elseif ($mime === 'image/png') {
        return @imagecreatefrompng($path);
    } elseif ($mime === 'image/webp' && function_exists('imagecreatefromwebp')) {
        return @imagecreatefromwebp($path);
    }
    return @imagecreatefromstring(file_get_contents($path));
}

// -------------------------------------------------------------
// 1. GENERATE DIPLOMA CERTIFICATE (Landscape 1125 x 750)
// -------------------------------------------------------------
function renderDiplomaImage($student) {
    $template = __DIR__ . '/template_diploma.jpg';
    if (!file_exists($template)) {
        die("Diploma template not found at $template");
    }
    $raw = imagecreatefromjpeg($template);
    $rawW = imagesx($raw);
    $rawH = imagesy($raw);

    // Target Canvas: 1125 x 750 (matches Node canvas 1:1)
    $img = imagecreatetruecolor(1125, 750);
    imagecopyresampled($img, $raw, 0, 0, 0, 0, 1125, 750, $rawW, $rawH);

    $fontBold = __DIR__ . '/Helvetica-Bold.ttf';
    $fontReg = __DIR__ . '/Helvetica.ttf';

    // Blue text matching Node backend ctx.fillStyle = "blue"
    $blue = imagecolorallocate($img, 10, 40, 140);
    $fontSize = 13.5; // ~18px

    // Student Data
    $name = strtoupper($student['name'] ?? '');
    $fname = strtoupper($student['fname'] ?? '');
    $dob = $student['dob'] ?? '';
    $course = strtoupper($student['course'] ?? '');
    $duration = $student['duration'] ?? '1 Year';
    $enroll = $student['enroll'] ?? '';
    $roll = $student['roll'] ?? '';
    $issue_date = $student['issue_date'] ?? date('d-m-Y');
    $grade = $student['grade'] ?? 'A';

    imagettftext($img, $fontSize, 0, 300, 280, $blue, $fontBold, $name);
    imagettftext($img, $fontSize, 0, 300, 320, $blue, $fontBold, $fname);
    imagettftext($img, $fontSize, 0, 900, 320, $blue, $fontBold, $dob);
    imagettftext($img, $fontSize, 0, 400, 360, $blue, $fontBold, $course);
    imagettftext($img, $fontSize, 0, 200, 401, $blue, $fontBold, "Student Computer Academy");
    imagettftext($img, $fontSize, 0, 200, 440, $blue, $fontBold, $duration);
    imagettftext($img, $fontSize, 0, 200, 488, $blue, $fontBold, $enroll);
    imagettftext($img, $fontSize, 0, 200, 528, $blue, $fontBold, $issue_date);
    imagettftext($img, $fontSize, 0, 900, 441, $blue, $fontBold, $grade);

    // QR Code (100, 110, 125 x 125)
    $qrUrl = "https://scait.in/veriy/" . $roll;
    $qrFile = generateQrTemp($qrUrl);
    if (file_exists($qrFile)) {
        $qrImg = @imagecreatefrompng($qrFile);
        if ($qrImg) {
            imagecopyresampled($img, $qrImg, 100, 110, 0, 0, 125, 125, imagesx($qrImg), imagesy($qrImg));
        }
    }

    // Student Photo (900, 110, 100 x 120)
    $photoPath = $student['photo'] ?? '';
    $photoImg = loadAnyImage($photoPath);
    if ($photoImg) {
        imagecopyresampled($img, $photoImg, 900, 110, 0, 0, 100, 120, imagesx($photoImg), imagesy($photoImg));
    }

    return $img;
}

// -------------------------------------------------------------
// 2. GENERATE MARKSHEET / RESULT CERTIFICATE (Portrait 883 x 1280)
// -------------------------------------------------------------
function renderMarksheetImage($student) {
    $template = __DIR__ . '/template_marksheet.jpg';
    if (!file_exists($template)) {
        die("Marksheet template not found at $template");
    }
    $raw = imagecreatefromjpeg($template);
    $rawW = imagesx($raw);
    $rawH = imagesy($raw);

    // Target Canvas: 883 x 1280 (matches Node canvas 1:1)
    $img = imagecreatetruecolor(883, 1280);
    imagecopyresampled($img, $raw, 0, 0, 0, 0, 883, 1280, $rawW, $rawH);

    $fontBold = __DIR__ . '/Helvetica-Bold.ttf';
    $fontReg = __DIR__ . '/Helvetica.ttf';

    $black = imagecolorallocate($img, 0, 0, 0);
    $blue = imagecolorallocate($img, 0, 33, 71);
    $fontSize = 13.5; // ~18px

    // Student Photo (700, 335, 120 x 150)
    $photoPath = $student['photo'] ?? '';
    $photoImg = loadAnyImage($photoPath);
    if ($photoImg) {
        imagecopyresampled($img, $photoImg, 700, 335, 0, 0, 120, 150, imagesx($photoImg), imagesy($photoImg));
    }

    // Top Student Details (Left Column)
    $labelX = 50;
    $valueX = 250;
    $y = 350;
    $lineSpacing = 35;

    $fields = [
        "Enrollment No.:" => $student['enroll'] ?? '',
        "Student Name:"   => strtoupper($student['name'] ?? ''),
        "Father's Name:"  => strtoupper($student['fname'] ?? ''),
        "Mother's Name:"  => strtoupper($student['mname'] ?? ''),
        "Date of Birth:"  => $student['dob'] ?? '',
        "Course Name:"    => strtoupper($student['course'] ?? '')
    ];

    foreach ($fields as $label => $val) {
        imagettftext($img, $fontSize, 0, $labelX, $y, $black, $fontBold, $label);
        imagettftext($img, $fontSize, 0, $valueX, $y, $black, $fontReg, $val);
        $y += $lineSpacing;
    }

    // Right Column Info (Roll, Duration, Session beside/above table)
    imagettftext($img, $fontSize, 0, 520, 350, $black, $fontBold, "Roll No.:");
    imagettftext($img, $fontSize, 0, 610, 350, $blue, $fontBold, $student['roll'] ?? '');

    imagettftext($img, $fontSize, 0, 520, 385, $black, $fontBold, "Duration:");
    imagettftext($img, $fontSize, 0, 610, 385, $black, $fontReg, $student['duration'] ?? '1 Year');

    imagettftext($img, $fontSize, 0, 520, 420, $black, $fontBold, "Session:");
    imagettftext($img, $fontSize, 0, 610, 420, $black, $fontReg, $student['session'] ?? '2023-24');

    // Subjects Table Header
    $tableY = $y + 50;
    imagettftext($img, $fontSize, 0, 50, $tableY, $black, $fontBold, "S.N.");
    imagettftext($img, $fontSize, 0, 100, $tableY, $black, $fontBold, "Subject");
    imagettftext($img, $fontSize, 0, 350, $tableY, $black, $fontBold, "Max Marks");
    imagettftext($img, $fontSize, 0, 480, $tableY, $black, $fontBold, "Theory");
    imagettftext($img, $fontSize, 0, 600, $tableY, $black, $fontBold, "Practical");
    imagettftext($img, $fontSize, 0, 720, $tableY, $black, $fontBold, "Total");
    imagettftext($img, $fontSize, 0, 800, $tableY, $black, $fontBold, "Grade");

    $subjects = !empty($student['subjects_json']) ? json_decode($student['subjects_json'], true) : [];
    $tableY += 30;

    if (is_array($subjects) && count($subjects) > 0) {
        $idx = 1;
        foreach ($subjects as $sub) {
            $th = intval($sub['theoryMarks'] ?? 0);
            $pr = intval($sub['practicalMarks'] ?? 0);
            $tot = $th + $pr;
            $gr = $sub['grade'] ?? 'A';
            $sname = $sub['name'] ?? '';

            imagettftext($img, $fontSize, 0, 50, $tableY, $black, $fontReg, (string)$idx);
            imagettftext($img, $fontSize, 0, 100, $tableY, $black, $fontReg, $sname);
            imagettftext($img, $fontSize, 0, 350, $tableY, $black, $fontReg, "100");
            imagettftext($img, $fontSize, 0, 480, $tableY, $black, $fontReg, (string)$th);
            imagettftext($img, $fontSize, 0, 600, $tableY, $black, $fontReg, (string)$pr);
            imagettftext($img, $fontSize, 0, 720, $tableY, $black, $fontReg, (string)$tot);
            imagettftext($img, $fontSize, 0, 800, $tableY, $black, $fontReg, $gr);

            $tableY += 30;
            $idx++;
        }
    }

    $tableY += 30;
    // Total Percentage & Date of Issue
    imagettftext($img, $fontSize, 0, 50, $tableY, $black, $fontBold, "Total Percentage:");
    imagettftext($img, $fontSize, 0, 250, $tableY, $black, $fontBold, ($student['percentage'] ?? '0') . "%");
    $tableY += 35;

    imagettftext($img, $fontSize, 0, 50, $tableY, $black, $fontBold, "Date of Issue:");
    imagettftext($img, $fontSize, 0, 250, $tableY, $black, $fontReg, $student['issue_date'] ?? date('d-m-Y'));

    // QR Code (700, 930, 150 x 150)
    $roll = $student['roll'] ?? '';
    $qrUrl = "https://scait.in/veriy/" . $roll;
    $qrFile = generateQrTemp($qrUrl);
    if (file_exists($qrFile)) {
        $qrImg = @imagecreatefrompng($qrFile);
        if ($qrImg) {
            imagecopyresampled($img, $qrImg, 700, 930, 0, 0, 150, 150, imagesx($qrImg), imagesy($qrImg));
        }
    }

    return $img;
}
