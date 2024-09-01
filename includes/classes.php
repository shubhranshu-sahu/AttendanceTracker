<?php
session_start();
require "database_connect.php";

$user_id = $_SESSION['user_id'];
$subject_ids = $_POST['subject_ids'];
$total_classes = $_POST['total_classes'];

// preparing the SQL statement
$sql = "INSERT INTO classes (user_id, subject_id, total_classes) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);




foreach ($subject_ids as $index => $subject_id) {
    $total_class = $total_classes[$index];
    
    // Bind the parameters
    $stmt->bind_param("iii", $user_id, $subject_id, $total_class);
    
    // Execute the statement
    if (!$stmt->execute()) {
        die('Execute failed: ' . $stmt->error);
    }
}
header("location: ../statistics.php");
// Close the statement and connection
$stmt->close();
$conn->close();
?>
