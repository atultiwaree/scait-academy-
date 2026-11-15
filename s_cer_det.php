<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: index.php?error=" . urlencode("Unauthorized access"));
    exit();
}

require_once('connection.php');

if (isset($_POST['submit'])) {
    $name   = trim($_POST['s_name'] ?? '');
    $fname  = trim($_POST['f_name'] ?? '');
    $mname  = trim($_POST['m_name'] ?? '');
    $enroll = trim($_POST['e_number'] ?? '');
    $roll   = trim($_POST['r_number'] ?? '');
    $dob    = trim($_POST['dob'] ?? '');
    $course = trim($_POST['course'] ?? '');
    $dur    = trim($_POST['duration'] ?? '');
    $gen    = strtolower(trim($_POST['gender'] ?? 'male'));
    $session = trim($_POST['session'] ?? date('Y'));
    $issue_date = trim($_POST['issue_date'] ?? date('d-m-Y'));
    $overallGrade = trim($_POST['overall_grade'] ?? 'A');
    $totalPercentage = trim($_POST['total_percentage'] ?? '85.00');

    if ($name === '' || $roll === '' || $course === '') {
        header("Location: admin-user-add.php?error=" . urlencode("Student Name, Roll Number, and Course are required."));
        exit();
    }

    // Process 6 Subjects if submitted
    $subjectsArray = [];
    if (isset($_POST['subject_name']) && is_array($_POST['subject_name'])) {
        foreach ($_POST['subject_name'] as $idx => $sname) {
            $sname = trim($sname);
            if ($sname === '') continue;

            $theory = trim($_POST['theory_marks'][$idx] ?? '0');
            $practical = trim($_POST['practical_marks'][$idx] ?? '0');
            $subGrade = trim($_POST['subject_grade'][$idx] ?? 'A');

            $subjectsArray[] = [
                'name' => $sname,
                'theoryMarks' => $theory,
                'practicalMarks' => $practical,
                'grade' => $subGrade
            ];
        }
    }
    $subjects_json = !empty($subjectsArray) ? json_encode($subjectsArray, JSON_UNESCAPED_UNICODE) : null;

    $locate = "";
    if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK && is_uploaded_file($_FILES['file']['tmp_name'])) {
        $file = $_FILES['file']['tmp_name'];
        $image_info = @getimagesize($file);
        
        if ($image_info !== false) {
            $width = $image_info[0];
            $height = $image_info[1];
            $mime = $image_info['mime'];

            $source = null;
            if ($mime === 'image/jpeg' || $mime === 'image/jpg') {
                $source = @imagecreatefromjpeg($file);
            } elseif ($mime === 'image/png') {
                $source = @imagecreatefrompng($file);
            } elseif ($mime === 'image/webp') {
                $source = @imagecreatefromwebp($file);
            }

            if ($source) {
                $clean_roll = preg_replace('/[^a-zA-Z0-9_-]/', '', $roll);
                $file_name = ($clean_roll !== '' ? $clean_roll : 'student_' . time()) . '.jpg';

                $students_upload_dir = __DIR__ . '/upload/students/';
                if (!is_dir($students_upload_dir)) @mkdir($students_upload_dir, 0755, true);

                $target_path = $students_upload_dir . $file_name;
                
                // Save optimized photo (413x531)
                $nwidth = 413;
                $nheight = 531;
                $newimage = imagecreatetruecolor($nwidth, $nheight);
                imagecopyresampled($newimage, $source, 0, 0, 0, 0, $nwidth, $nheight, $width, $height);
                imagejpeg($newimage, $target_path, 92);

                $locate = "upload/students/" . $file_name;
            }
        }
    }

    // Default placeholder photo if no photo was uploaded
    if ($locate === '') {
        $locate = "pass.png_thump.png";
    }

    $stmt = mysqli_prepare($con, "
        INSERT INTO s_cer_det 
        (name, fname, mname, enroll, roll, dob, course, duration, gender, photo, session, grade, percentage, issue_date, subjects_json) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");
    
    if ($stmt) {
        mysqli_stmt_bind_param(
            $stmt, 
            "sssssssssssssss", 
            $name, $fname, $mname, $enroll, $roll, $dob, $course, $dur, $gen, $locate, $session, $overallGrade, $totalPercentage, $issue_date, $subjects_json
        );
        if (mysqli_stmt_execute($stmt)) {
            header("Location: admin-user-add.php?error=success&roll=" . urlencode($roll) . "&cor=" . urlencode($course));
            exit();
        } else {
            header("Location: admin-user-add.php?error=" . urlencode("Database insert failed: " . mysqli_stmt_error($stmt)));
            exit();
        }
    } else {
        header("Location: admin-user-add.php?error=" . urlencode("Database prepare error: " . mysqli_error($con)));
        exit();
    }
} else {
    header("Location: admin-user-add.php");
    exit();
}
