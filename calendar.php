<?php
session_start();
require "includes/database_connect.php";
if(!isset($_SESSION['user_id'])){
header("location: home.php");
}
$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM subjects where user_id = '$user_id'";
$result = mysqli_query($conn, $sql);
$data = mysqli_fetch_all($result, MYSQLI_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendar</title>
    <link rel="stylesheet" href="css/calendar.css">
    <?php
include "includes/head_links.php";
?>
</head>
<body class="bg-gray-400">
<div id="container">
<div class="flex justify-center mb-5">
        <!-- HTML Form for User Input -->
<form id="attendanceForm" method="post" action="includes/subjects_data.php">
    <label for="subjectSelect" class="mb-2 text-sm font-medium text-gray-900 dark:text-white">Select Subject:</label>
    <select name="subjectSelect" id="subjectSelect" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
        <option selected>Choose a subject</option>
        <?php
        foreach($data as $subject){
            ?>
            <option value="<?= $subject['id']?>"><?= $subject['subject_name']?></option>
            <?php
        }
        ?>
    </select>

    <label for="yearSelect" class="mb-2 text-sm font-medium text-gray-900 dark:text-white">Select Year:</label>
    <input type="number" id="yearSelect" value="2024" min="2000" max="2100" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

    <label for="monthSelect" class="mb-2 text-sm font-medium text-gray-900 dark:text-white">Select Month:</label>
    <select id="monthSelect" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
        <!-- Options for months (January to December) -->
         <option selected>Choose a month</option>
        <option value="0">January</option>
        <option value="1">February</option>
        <option value="2">March</option>
        <option value="3">April</option>
        <option value="4">May</option>
        <option value="5">June</option>
        <option value="6">July</option>
        <option value="7">August</option>
        <option value="8">September</option>
        <option value="9">October</option>
        <option value="10">November</option>
        <option value="11">December</option>
    </select>

    <button type="submit" class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-full text-sm px-3 py-2.5 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">Show Calendar</button>
</form>
</div>

<!-- Container for the Calendar -->
<div id="calendar"></div>
</div>
    

<?php
include "includes/script.php";
?>
<script src="js/calendar.js"></script>
</body>
</html>