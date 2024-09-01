<?php
session_start();
require "database_connect.php";

if (!isset($_SESSION['user_id'])) {
    http_response_code(403);
    echo json_encode(["success" => false, "message" => "Unauthorized"]);
    exit;
}

$user_id = $_SESSION['user_id'];
$subject_id = $_POST['subjectSelect'];
$year = $_POST['year'];
$month = $_POST['month'];

$sql = "SELECT * FROM attendance WHERE user_id = ? AND subject_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $user_id, $subject_id);
$stmt->execute();
$result = $stmt->get_result();

$attendance_data = $result->fetch_all(MYSQLI_ASSOC);

$stmt->close();
mysqli_close($conn);

echo json_encode(["success" => true, "data" => $attendance_data]);
?>
