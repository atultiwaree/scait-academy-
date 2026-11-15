<?php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit;
}

require_once __DIR__ . '/../connection.php';

$id = isset($_GET['id']) ? trim($_GET['id']) : '';

// Also check URI if rewrites route /veriy/:id here
if (empty($id)) {
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $parts = array_values(array_filter(explode('/', $uri)));
    $last = end($parts);
    if (!empty($last) && !in_array(strtolower($last), ['veriy', 'verify', 'api.php', 'index.html'])) {
        $id = $last;
    }
}

if (empty($id)) {
    echo json_encode([
        'verified' => false,
        'message' => 'No enrollment or roll number provided.'
    ]);
    exit;
}

$stmt = mysqli_prepare($con, "SELECT * FROM s_cer_det WHERE roll = ? OR enroll = ? LIMIT 1");
mysqli_stmt_bind_param($stmt, "ss", $id, $id);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);
$student = mysqli_fetch_assoc($res);
mysqli_stmt_close($stmt);

if (!$student) {
    echo json_encode([
        'verified' => false,
        'message' => 'No record found for ID: ' . htmlspecialchars($id)
    ]);
    exit;
}

// Format photo path for browser
$photo = $student['photo'] ?? '';
if (!empty($photo) && !preg_match('~^https?://~i', $photo)) {
    $cleanPhoto = ltrim($photo, '/');
    if (file_exists(__DIR__ . '/../' . $cleanPhoto)) {
        $photo = '/' . $cleanPhoto;
    } elseif (file_exists(__DIR__ . '/../certificate/' . $cleanPhoto)) {
        $photo = '/certificate/' . $cleanPhoto;
    } else {
        $photo = '/' . $cleanPhoto;
    }
}

echo json_encode([
    'verified' => true,
    'message' => 'Certificate is valid and verified.',
    'data' => [
        'studentName' => $student['name'],
        'fatherName' => $student['fname'],
        'motherName' => $student['mname'],
        'rollNumber' => $student['roll'],
        'enrollmentNumber' => $student['enroll'],
        'courseName' => $student['course'],
        'session' => $student['session'] ?: '2021-2022',
        'duration' => $student['duration'] ?: '1 Year',
        'overallGrade' => $student['grade'] ?: 'A',
        'totalPercentage' => $student['percentage'] ?: 'N/A',
        'dateOfIssue' => $student['issue_date'] ?: $student['dob'],
        'photo' => $photo
    ]
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

