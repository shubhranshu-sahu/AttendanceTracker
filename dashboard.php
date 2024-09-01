<?php
require "includes/database_connect.php";
session_start();
if(!isset($_SESSION['user_id'])){
header("location: home.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/dashboard.css">
    <?php
    include "includes/head_links.php";
    ?>
    <title>Dashbaord</title>
</head>

<body class="bg-gray-300">
   <?php
   include "includes/header.php";
   ?>
  <div class="content pt-[8rem] h-100 bg-[url('../img/bg2.jpg')] bg-cover bg-centre fixed-bg">
    <h1 class="font-bold text-gray-600 text-center">Welcome, <?= $_SESSION['name']?>!</h1>
  
<?php
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM subjects where user_id = '$user_id'";
$result = mysqli_query($conn, $sql);
if(!$result){
echo "Something went wrong!!";
return;
}
$row_count = mysqli_num_rows($result);
if($row_count==0){
?>
<div class="button-container">
<button type="button" data-modal-target="subjects-modal" data-modal-toggle="subjects-modal" class=" transition ease-in-out delay-150 bg-blue-500 hover:-translate-y-1 hover:scale-110 hover:bg-indigo-500 duration-300 border text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Set up your subjects</button>
</div>
<?php
} else {
  ?>
  <div id="content" class="flex mt-10">
    <?php
    $sql_2 = "SELECT * FROM classes where user_id = '$user_id'";
    $result_2 = mysqli_query($conn, $sql_2);
    $count = mysqli_num_rows($result_2);
    if($count == 5){
?>
 <div id="chart" class="mt-10 w-1/2">
    <?php
     include "chart.php";
     ?>
  </div>
  <div class="w-1/2">
  <div class="button-container">
<button type="button" data-modal-target="attendance_form-modal" data-modal-toggle="attendance_form-modal" class=" transition ease-in-out delay-150 bg-blue-500 hover:-translate-y-1 hover:scale-110 hover:bg-indigo-500 duration-300 border text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Mark your attendance</button>
<a href="attendance.php"><button type="button" class=" transition ease-in-out delay-150 bg-blue-500 hover:-translate-y-1 hover:scale-110 hover:bg-indigo-500 duration-300 border text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">See your attendance</button></a>
</div>
<div id="calendar_button" class="flex justify-center mt-10">
    <a href="calendar.php" class=" transition ease-in-out delay-150 bg-blue-500 hover:-translate-y-1 hover:scale-110 hover:bg-indigo-500 duration-300 border text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2" ><button type="button">Calendar</button></a>
</div>
  </div>
  </div>
  <?php
    } else {
    ?>
  <div class="w-full">
  <div class="button-container">
<button type="button" data-modal-target="attendance_form-modal" data-modal-toggle="attendance_form-modal" class=" transition ease-in-out delay-150 bg-blue-500 hover:-translate-y-1 hover:scale-110 hover:bg-indigo-500 duration-300 border text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Mark your attendance</button>
<a href="attendance.php"><button type="button" class=" transition ease-in-out delay-150 bg-blue-500 hover:-translate-y-1 hover:scale-110 hover:bg-indigo-500 duration-300 border text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">See your attendance</button></a>
</div>
<div id="calendar_button" class="flex justify-center mt-10">
    <a href="calendar.php" class=" transition ease-in-out delay-150 bg-blue-500 hover:-translate-y-1 hover:scale-110 hover:bg-indigo-500 duration-300 border text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2" ><button type="button">Calendar</button></a>
</div>
  </div>
  </div>

<?php
}}
?>
  
  </div>
  <?php
$sql_2 = "SELECT * from subjects where user_id = '$user_id'";
$result_2 = mysqli_query($conn, $sql_2);
if(!$result_2){
echo json_encode(array("success"=> false, "message"=> "Something went wrong!"));
exit;
}
$subjects = mysqli_fetch_all($result_2, MYSQLI_ASSOC);
mysqli_close($conn);
  ?>
 <!-- Marking attendance form modal -->
 <div id="attendance_form-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-black">
                        Mark attendance
                    </h3>
                    <button type="button" class="end-2.5 text-gray-900 bg-transparent hover:bg-gray-200 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600" data-modal-hide="attendance_form-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4 md:p-5">
                    <form class="space-y-4" action="includes/mark_attendance.php" method="post">
                        <div>
                            <label for="subject_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Subject</label>
                            <select id="subject_name" name="subject_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
    <option selected>Choose a subject</option>
    <?php
    foreach ($subjects as $subject) {
      # code...
      ?>
      <option value="<?=$subject['id']?>"><?=$subject['subject_name']?></option>
    <?php
    }
    ?>
  </select>
                        </div>
                        <div>
                            <label for="date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Date</label>
                            <input type="date" name="date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date">

                        </div>  
                        
                        <div>
                            <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Your Status</label>
                            <select id="status" name="status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
    <option selected>Status</option>
   <option value="present">Present</option>
   <option value="absent">Absent</option>
   <option value="no class">No class</option>
  </select>
                        </div>                    
                        


                     
                       
                        <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Mark Attendance</button>
                        
                    </form>
                </div>
            </div>
        </div>
    </div> 

<!-- Subject setting form -->
<div id="subjects-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-black">
                    Fill in your subjects
                </h3>
                <button type="button" class="end-2.5 text-gray-900 bg-transparent hover:bg-gray-200 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600" data-modal-hide="subjects-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5">
                <form class="space-y-4" action="includes/setting_subjects.php" method="post">
                    <!-- Subject 1 -->
                    <div>
                        <label for="subject_1" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Subject's name</label>
                        <input type="text" name="subject_1" id="subject_1" placeholder="e.g. Physics" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required />
                        <label for="classes_1" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Number of classes</label>
                        <input type="number" name="classes_1" id="classes_1" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required />
                    </div>
                    <!-- Subject 2 -->
                    <div>
                        <label for="subject_2" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Subject's name</label>
                        <input type="text" name="subject_2" id="subject_2" placeholder="e.g. Mathematics" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required />
                        <label for="classes_2" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Number of classes</label>
                        <input type="number" name="classes_2" id="classes_2" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required />
                    </div>
                    <!-- Subject 3 -->
                    <div>
                        <label for="subject_3" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Subject's name</label>
                        <input type="text" name="subject_3" id="subject_3" placeholder="e.g. DBMS" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required />
                        <label for="classes_3" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Number of classes</label>
                        <input type="number" name="classes_3" id="classes_3" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required />
                    </div>
                    <!-- Subject 4 -->
                    <div>
                        <label for="subject_4" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Subject's name</label>
                        <input type="text" name="subject_4" id="subject_4" placeholder="e.g. Chemistry" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required />
                        <label for="classes_4" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Number of classes</label>
                        <input type="number" name="classes_4" id="classes_4" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required />
                    </div>
                    <!-- Subject 5 -->
                    <div>
                        <label for="subject_5" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Subject's name</label>
                        <input type="text" name="subject_5" id="subject_5" placeholder="e.g. Data Structures" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required />
                        <label for="classes_5" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Number of classes</label>
                        <input type="number" name="classes_5" id="classes_5" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required />
                    </div>
                    <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit the subjects</button>
                </form>
            </div>
        </div>
    </div>
</div>




  
    <?php
    include "includes/script.php";
    ?>


      </body>


 </html>