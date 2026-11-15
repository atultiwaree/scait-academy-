<?php
error_reporting(E_ALL & ~E_DEPRECATED & ~E_NOTICE);

require_once __DIR__ . '/generate_cert.php';

$id = isset($_GET['id']) ? trim($_GET['id']) : (isset($_GET['roll']) ? trim($_GET['roll']) : (isset($_GET['enroll']) ? trim($_GET['enroll']) : ''));
$type = isset($_GET['type']) ? strtolower(trim($_GET['type'])) : 'diploma';
$action = isset($_GET['action']) ? strtolower(trim($_GET['action'])) : 'download';

if (empty($id)) {
    die("Error: Roll Number or Enrollment Number required.");
}

$student = getStudent($id);
if (!$student) {
    die("Error: Student record not found for " . htmlspecialchars($id));
}

// Generate appropriate image based on type
if ($type === 'marksheet' || $type === 'result') {
    $img = renderMarksheetImage($student);
    $filename = "SCAIT_Marksheet_" . ($student['roll'] ?: $id) . ".jpg";
} else {
    // Default: Diploma
    $img = renderDiplomaImage($student);
    $filename = "SCAIT_Diploma_" . ($student['roll'] ?: $id) . ".jpg";
}

if (!$img) {
    die("Error generating certificate image.");
}

// Output headers
header('Content-Type: image/jpeg');
if ($action === 'download') {
    header('Content-Disposition: attachment; filename="' . $filename . '"');
} else {
    header('Content-Disposition: inline; filename="' . $filename . '"');
}

// Cache control
header('Cache-Control: public, max-age=86400');

imagejpeg($img, null, 92);
exit;

