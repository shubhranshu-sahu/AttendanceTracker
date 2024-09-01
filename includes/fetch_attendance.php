<?php
header('Content-Type: application/json');
session_start();
$user_id = $_SESSION['user_id'];
require "database_connect.php";
$date = isset($_POST['date'])? $_POST['date'] : "";

$sql = "SELECT subjects.subject_name, attendance.status 
        FROM subjects 
        LEFT JOIN attendance 
        ON subjects.id = attendance.subject_id 
        AND attendance.date = ? WHERE subjects.user_id = ?";

//prepare the sql statement
$stmt = $conn-> prepare($sql);
if($stmt==false){
echo json_encode(array("error"=> "Prepare failed:" . $conn-> error));
exit;
}
//Bind the parameters to the SQL statement
$stmt-> bind_param("ss",$date, $user_id);

//execute 
$stmt-> execute();

//get the result
$result = $stmt->get_result();

//fetch the data from the result set
$attendance_data = [];
while($row = $result->fetch_assoc()){
$attendance_data[] = $row;
}
$stmt->close();
$conn->close();
echo json_encode($attendance_data);

