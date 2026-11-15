<?php
// Helper for Homepage Gallery & Photo Management
if (!isset($con)) {
    require_once(__DIR__ . '/connection.php');
}

function ensureGalleryTable($con) {
    if (!$con) return false;
    $sql = "CREATE TABLE IF NOT EXISTS site_gallery (
        id INT AUTO_INCREMENT PRIMARY KEY,
        slot_type VARCHAR(30) DEFAULT 'gallery',
        title_en VARCHAR(255) DEFAULT 'SCAIT Computer Lab',
        title_hi VARCHAR(255) DEFAULT 'कंप्यूटर लैब व प्रैक्टिकल क्लास',
        image_path VARCHAR(255) NOT NULL,
        sort_order INT DEFAULT 0,
        updated_at INT DEFAULT 0
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
    mysqli_query($con, $sql);

    // Seed initial 6 gallery photos if empty
    $chk = mysqli_query($con, "SELECT COUNT(*) as c FROM site_gallery WHERE slot_type = 'gallery'");
    $row = $chk ? mysqli_fetch_assoc($chk) : ['c' => 0];
    if (intval($row['c']) === 0) {
        $defaults = [
            ['Computer Lab Session', 'कंप्यूटर लैब सत्र', 'images/ami/1.jpg', 1],
            ['1:1 Dedicated PC Practice', '1:1 प्रैक्टिकल अभ्यास', 'images/ami/2.jpg', 2],
            ['Student Practical Batch', 'छात्र प्रैक्टिकल बैच', 'images/ami/3.jpg', 3],
            ['Classroom Guidance', 'क्लासरूम मार्गदर्शन', 'images/ami/4.jpg', 4],
            ['Hindi & English Typing Lab', 'हिन्दी व इंग्लिश टाइपिंग लैब', 'images/ami/5.jpg', 5],
            ['SCAIT Campus & Students', 'SCAIT कैंपस व विद्यार्थी', 'images/ami/6.jpg', 6],
        ];
        $now = time();
        $stmt = mysqli_prepare($con, "INSERT INTO site_gallery (slot_type, title_en, title_hi, image_path, sort_order, updated_at) VALUES ('gallery', ?, ?, ?, ?, ?)");
        if ($stmt) {
            foreach ($defaults as $d) {
                mysqli_stmt_bind_param($stmt, "sssii", $d[0], $d[1], $d[2], $d[3], $now);
                mysqli_stmt_execute($stmt);
            }
        }
    }
    return true;
}

function getHomepageGalleryPhotos($con) {
    ensureGalleryTable($con);
    $photos = [];
    if ($con) {
        $res = mysqli_query($con, "SELECT * FROM site_gallery WHERE slot_type = 'gallery' ORDER BY sort_order ASC, id ASC");
        if ($res) {
            while ($r = mysqli_fetch_assoc($res)) {
                $photos[] = $r;
            }
        }
    }
    if (empty($photos)) {
        for ($i = 1; $i <= 6; $i++) {
            $photos[] = [
                'id' => $i,
                'slot_type' => 'gallery',
                'title_en' => 'SCAIT Computer Lab',
                'title_hi' => 'कंप्यूटर लैब व प्रैक्टिकल क्लास',
                'image_path' => "images/ami/{$i}.jpg",
                'sort_order' => $i,
                'updated_at' => 0
            ];
        }
    }
    return $photos;
}

function getDirectorPhoto($con) {
    ensureGalleryTable($con);
    if ($con) {
        $res = mysqli_query($con, "SELECT * FROM site_gallery WHERE slot_type = 'director' ORDER BY id DESC LIMIT 1");
        if ($res && mysqli_num_rows($res) > 0) {
            return mysqli_fetch_assoc($res);
        }
    }
    return null;
}
?>
