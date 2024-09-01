<?php
session_start();
require "../includes/database_connect.php";
if(!isset($_SESSION['user_id'])){
header("location : home.php");
}
$user_id = $_SESSION['user_id'];
$subject_id = $_POST['subject_id'];
$date = $_POST['date'];
$status = $_POST['status'];
// Validate subject_id
$sql = "SELECT id FROM subjects WHERE id = '$subject_id'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) == 0) {
    echo json_encode(array("success" => false, "message" => "Invalid subject ID!"));
    exit;
}
//check if the attendance is already marked for this subject
$sql = "SELECT * FROM attendance where user_id = '$user_id' AND subject_id = '$subject_id' AND date = '$date'";
$result = mysqli_query($conn, $sql);
if(!$result){
echo json_encode(array("success"=> false, "message"=> "Something went wrong!"));
exit;
}
$marked = mysqli_fetch_assoc($result);
$row_count = mysqli_num_rows($result);
if($row_count>0 && $marked['STATUS'] != "Not marked yet" ){
echo json_encode(array("success"=> false, "message"=>"Attendance is already marked for this subject!"));
exit;
}
else {
    $sql_2 = "INSERT into attendance (user_id, subject_id, date, status) values ('$user_id', '$subject_id', '$date', '$status')";
$result_2 = mysqli_query($conn,$sql_2);
if(!$result_2){
    echo json_encode(array("success"=> false, "message"=> "Something went wrong!"));
    exit;
    }
    else{
        echo json_encode(array("success"=> true, "message"=> "Attendance marked successfully!"));
    }
}
mysqli_close($conn);