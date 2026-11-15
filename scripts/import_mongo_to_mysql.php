<?php
require_once __DIR__ . "/../connection.php";

$jsonPath = __DIR__ . "/../scratch/mongo_students_with_local_photos.json";
if (!file_exists($jsonPath)) {
    die("Error: $jsonPath does not exist!\n");
}

$students = json_decode(file_get_contents($jsonPath), true);
echo "Loaded " . count($students) . " students from JSON.\n";

$inserted = 0;
$updated = 0;
$errors = 0;

$stmtInsert = mysqli_prepare($con, "
    INSERT INTO s_cer_det 
    (name, fname, mname, enroll, roll, dob, course, duration, gender, photo, session, grade, percentage, issue_date, subjects_json)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
");

$stmtUpdate = mysqli_prepare($con, "
    UPDATE s_cer_det 
    SET name=?, fname=?, mname=?, enroll=?, dob=?, course=?, duration=?, photo=?, session=?, grade=?, percentage=?, issue_date=?, subjects_json=?
    WHERE id=?
");

foreach ($students as $s) {
    $name = trim($s['studentName'] ?? '');
    $fname = trim($s['fatherName'] ?? '');
    $mname = trim($s['motherName'] ?? '');
    $enroll = trim($s['enrollmentNumber'] ?? '');
    $roll = trim($s['rollNumber'] ?? '');
    
    // Format DOB
    $dob = '';
    if (!empty($s['dob'])) {
        $timestamp = strtotime($s['dob']);
        $dob = $timestamp ? date('d-m-Y', $timestamp) : $s['dob'];
    }
    
    $course = trim($s['courseName'] ?? 'ADCA');
    $duration = trim($s['duration'] ?? '1 Year');
    $gender = 'male'; // default
    $photo = trim($s['localPhoto'] ?? '');
    $session = trim($s['session'] ?? '');
    $grade = trim($s['overallGrade'] ?? 'A');
    $percentage = trim($s['totalPercentage'] ?? '');
    
    // Format issue date
    $issue_date = '';
    if (!empty($s['dateOfIssue'])) {
        $timestamp = strtotime($s['dateOfIssue']);
        $issue_date = $timestamp ? date('d-m-Y', $timestamp) : $s['dateOfIssue'];
    }
    
    $subjects_json = isset($s['subjects']) ? json_encode($s['subjects'], JSON_UNESCAPED_UNICODE) : null;
    
    if (empty($roll) && empty($enroll)) {
        continue;
    }
    
    // Check if record exists
    $checkQ = mysqli_prepare($con, "SELECT id FROM s_cer_det WHERE roll = ? AND course = ? LIMIT 1");
    mysqli_stmt_bind_param($checkQ, "ss", $roll, $course);
    mysqli_stmt_execute($checkQ);
    $res = mysqli_stmt_get_result($checkQ);
    $existing = mysqli_fetch_assoc($res);
    mysqli_stmt_close($checkQ);
    
    if ($existing) {
        $id = $existing['id'];
        mysqli_stmt_bind_param(
            $stmtUpdate,
            "sssssssssssssi",
            $name, $fname, $mname, $enroll, $dob, $course, $duration, $photo, $session, $grade, $percentage, $issue_date, $subjects_json, $id
        );
        if (mysqli_stmt_execute($stmtUpdate)) {
            $updated++;
        } else {
            $errors++;
            echo "Update error on $roll: " . mysqli_error($con) . "\n";
        }
    } else {
        mysqli_stmt_bind_param(
            $stmtInsert,
            "sssssssssssssss",
            $name, $fname, $mname, $enroll, $roll, $dob, $course, $duration, $gender, $photo, $session, $grade, $percentage, $issue_date, $subjects_json
        );
        if (mysqli_stmt_execute($stmtInsert)) {
            $inserted++;
        } else {
            $errors++;
            echo "Insert error on $roll: " . mysqli_error($con) . "\n";
        }
    }
}

mysqli_stmt_close($stmtInsert);
mysqli_stmt_close($stmtUpdate);

$totRes = mysqli_query($con, "SELECT COUNT(*) as cnt FROM s_cer_det");
$totRow = mysqli_fetch_assoc($totRes);

echo "\nMigration Complete!\n";
echo "Inserted: $inserted\n";
echo "Updated: $updated\n";
echo "Errors: $errors\n";
echo "Total Records in s_cer_det: " . $totRow['cnt'] . "\n";
