<?php
session_start();
require "database_connect.php";

if (!isset($_SESSION['user_id'])) {
    exit;
}

$user_id = $_SESSION['user_id'];

// Retrieve subject names and classes counts from POST request
$subjects = [];
$classes = [];

for ($i = 1; $i <= 5; $i++) {
    $subject_name = $_POST["subject_$i"];
    $classes_count = $_POST["classes_$i"];

    if (!empty($subject_name) && !empty($classes_count)) {
        $subjects[] = $subject_name;
        $classes[] = $classes_count;
    }
}

if (count($subjects) != count($classes)) {
    echo json_encode(array("success" => false, "message" => "Mismatched subjects and classes."));
    exit;
}

// Insert subjects into the database
$subject_ids = [];
foreach ($subjects as $index => $subject_name) {
    $sql = "INSERT INTO subjects (user_id, subject_name) VALUES ('$user_id', '$subject_name')";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        echo json_encode(array("success" => false, "message" => "Error inserting subject: " . mysqli_error($conn)));
        mysqli_close($conn);
        exit;
    }

    $subject_ids[] = mysqli_insert_id($conn);
}

// Insert classes into the database
foreach ($subject_ids as $index => $subject_id) {
    $classes_count = $classes[$index];
    $sql = "INSERT INTO classes (user_id,subject_id, total_classes) VALUES ('$user_id','$subject_id', '$classes_count')";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        echo json_encode(array("success" => false, "message" => "Error inserting classes: " . mysqli_error($conn)));
        mysqli_close($conn);
        exit;
    }
}

mysqli_close($conn);
header("location: ../dashboard.php");
exit;
?>
