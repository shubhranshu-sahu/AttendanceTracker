<?php
session_start();
require "../includes/database_connect.php";

$email = $_POST['email'];
$password = $_POST['password'];
$password = sha1($password);
$sql = "SELECT * FROM users where email = '$email' AND password = '$password'";
$result = mysqli_query($conn, $sql);
if(!$result){
$response = array("success"=> false, "message"=> "Something went wrong!");
echo json_encode($response);
return;
}
$row_count = mysqli_num_rows($result);
if($row_count==0){
echo json_encode(array("success"=> false, "message"=> "Login failed! Invalid email or password"));
return;
}
$data = mysqli_fetch_assoc($result);
$_SESSION['user_id'] = $data['id'];
$_SESSION['name'] = $data['name'];
$_SESSION['email'] = $data['email'];

header("location: ../dashboard.php");
mysqli_close($conn);

?>