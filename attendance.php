<?php
session_start();
if(!isset($_SESSION['user_id'])){
header("location: home.php");
exit;
}
$user_id = $_SESSION['user_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/attendance.css">
    <?php
    include "includes/head_links.php";
    ?>
    <title>Attendance</title>
</head>
<body class="bg-yellow-200">
    <?php
    include "includes/header.php";
    ?>

<div class=" content pt-[8rem] mt-30">
<div id="date_picker">
    <p class="text-black text-2xl">Choose the date you wish to see your attendance of: </p>
    <form action="includes/fetch_attendance.php" method="post" id="show_attendance">
        
<div class="relative max-w-sm">
  <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
     <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
        <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
      </svg>
  </div>
  <input type="date" name="date" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date">
</div>
<button type="submit" class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-4 py-2 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">See your attendance</button>
    </form>
</div>
</div>
    
<div id="table" class="text-black flex justify-center"></div>
<div id="statistics" class="flex justify-center"></div>

 





<?php
include "includes/script.php";
?>
<script src="js/attendance.js"></script>
</body>
</html>