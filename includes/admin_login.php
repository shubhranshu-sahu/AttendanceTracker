<?php
require "database_connect.php";
$admin_email = $_POST['admin_email'];
$admin_password = $_POST['admin_password'];
$sql = "SELECT * FROM admin where admin_email = '$admin_email' AND admin_password = '$admin_password'";
$result = mysqli_query($conn, $sql);
if(!$result){
echo json_encode(array("success"=> false, "message"=> "Query failed!!"));
exit;
}
$data = mysqli_fetch_assoc($result);
if($data == null){
echo json_encode(array("success"=> false, "message"=> "Invalid Admin ID or password!" ));
exit;
}
session_start();
$_SESSION['admin_id'] = $data['id'];
$_SESSION['admin_name'] = $data['admin_name'];
header("location: ../admin.php");
mysqli_close($conn);
?>