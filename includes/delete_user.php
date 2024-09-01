<?php
session_start();
require "database_connect.php";

$user_id = $_POST['user_id'];

// Prepare and execute the DELETE statements separately


// Delete from attendance table
$sql = "DELETE FROM attendance WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
if (!$stmt->execute()) {
    echo json_encode(array("success" => false, "message" => "Error occurred while deleting user from attendance table!"));
    $stmt->close();
    mysqli_close($conn);
    exit;
}
$stmt->close();

// Delete from classes table
$sql = "DELETE FROM classes WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
if (!$stmt->execute()) {
    echo json_encode(array("success" => false, "message" => "Error occurred while deleting user from classes table!"));
    $stmt->close();
    mysqli_close($conn);
    exit;
}
$stmt->close();

// Delete from subjects table
$sql = "DELETE FROM subjects WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
if (!$stmt->execute()) {
    echo json_encode(array("success" => false, "message" => "Error occurred while deleting user from subjects table!"));
    $stmt->close();
    mysqli_close($conn);
    exit;
}
$stmt->close();

// Delete from users table
$sql = "DELETE FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
if (!$stmt->execute()) {
    echo json_encode(array("success" => false, "message" => "Error occurred while deleting the user from users table!"));
    $stmt->close();
    mysqli_close($conn);
    exit;
}
$stmt->close();

mysqli_close($conn);

echo json_encode(array("success" => true, "message" => "The user has been deleted!"));
?>
