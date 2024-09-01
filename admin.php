<?php
require "includes/database_connect.php";
session_start();
if(!isset($_SESSION['admin_id'])){
header("location: home.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    include "includes/head_links.php";
    ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>Admin Dashboard</title>
    </head>
<body>
    <?php
    include "includes/header.php";
    ?>
    <div class="content bg-gray-300 pt-[8rem] h-100">
      
        <div style="font-weight: bold;" class="flex justify-center text-black text-3xl mb-10 mt-3">ATTENDANCE RECORD</div>

<div class="relative overflow-x-auto sm:rounded-lg flex  items-center">
<table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
    <thead class="text-xs text-gray-400 uppercase bg-gray-700 dark:bg-gray-700 dark:text-gray-400">
        <tr>
            <th scope="col" class="px-4 py-3">
                Student name
            </th>
            <th scope="col" class="px-6 py-3">
                Subjects
            </th>
            <th scope="col" class="px-6 py-3">
                Attendance percentage
            </th>
            <th scope="col" class="px-6 py-3">
                Number of classes
            </th>
            <th scope="col" class="px-6 py-3">
                Present
            </th>
            <th scope="col" class="px-6 py-3">
                Absent
            </th>
            <th scope="col" class="px-6 py-3">
               No class
            </th>
            <th>
                Classes left
            </th>
            <th></th>
        </tr>
    </thead>
    <tbody>
    <?php
       $sql = "SELECT * FROM users";
       $result = mysqli_query($conn, $sql);
       $allUsers = mysqli_fetch_all($result, MYSQLI_ASSOC);
       foreach($allUsers as $user){
        $user_id = $user['id'];
        ?>
        <tr class="odd:bg-gray-900 odd:dark:bg-gray-900 even:bg-gray-800 even:dark:bg-gray-800 border-b border-gray-700 dark:border-gray-700">
            <th scope="row" class="px-6 py-4 font-medium text-white whitespace-nowrap dark:text-white">
                <?= $user['name']?>
            </th>
            <td class="px-6 py-4">
                <?php
                $sql_2 = "SELECT * FROM subjects where user_id = '$user_id'";
                $result_2 = mysqli_query($conn, $sql_2);
                $allSubjects = mysqli_fetch_all($result_2, MYSQLI_ASSOC);
                foreach($allSubjects as $subject){
                    echo $subject['subject_name'] . '<br/>';
                }
                ?>
            </td>
            <td class="px-6 py-4">
                <?php
            $sql_2 = "SELECT * FROM subjects where user_id = '$user_id'";
                $result_2 = mysqli_query($conn, $sql_2);
                $allSubjects = mysqli_fetch_all($result_2, MYSQLI_ASSOC);
                foreach($allSubjects as $subject){
                   $subject_id = $subject['id'];
                   $sql_3 = "SELECT COUNT(*) as classes_attended FROM attendance where user_id = ? AND subject_id = ? AND status = 'Present'";
                            $stmt = $conn->prepare($sql_3);
                            $stmt->bind_param("ii", $user_id, $subject_id);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            $rowData = $result->fetch_assoc();
                            $classes_attended = $rowData['classes_attended'];
                   $sql_4 = "SELECT * FROM classes where user_id = '$user_id' AND subject_id = '$subject_id'";
                            $result_4 = mysqli_query($conn, $sql_4);
                            $classData = mysqli_fetch_assoc($result_4);
                     echo round(($classes_attended / $classData['total_classes']) * 100, 1) ." %". '<br/>';     
                }
                ?>
            </td>
            <td class="px-6 py-4">
                <?php
            foreach($allSubjects as $subject){
                   $subject_id = $subject['id'];
                   $sql_3 = "SELECT * FROM attendance where user_id = '$user_id' AND subject_id='$subject_id'";
                   $result = mysqli_query($conn, $sql_3);
                   $rows = mysqli_num_rows($result);
                   echo $rows . '<br/>';
                }
                ?>
            </td>
            <td class="px-6 py-4">
                <?php
            foreach($allSubjects as $subject){
                   $subject_id = $subject['id'];
                   $sql_3 = "SELECT COUNT(*) as classes_attended FROM attendance where user_id = ? AND subject_id = ? AND status = 'Present'";
                            $stmt = $conn->prepare($sql_3);
                            $stmt->bind_param("ii", $user_id, $subject_id);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            $rowData = $result->fetch_assoc();
                            $classes_attended = $rowData['classes_attended'];
                     echo $classes_attended . '<br/>';     
                }
                ?>
            </td>
            <td class="px-6 py-4">
                <?php
            foreach($allSubjects as $subject){
                   $subject_id = $subject['id'];
                   $sql_3 = "SELECT COUNT(*) as classes_missed FROM attendance where user_id = ? AND subject_id = ? AND status = 'Absent'";
                            $stmt = $conn->prepare($sql_3);
                            $stmt->bind_param("ii", $user_id, $subject_id);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            $rowData = $result->fetch_assoc();
                            $classes_missed = $rowData['classes_missed'];
                     echo $classes_missed . '<br/>';    
                }
                ?>
            </td>
            <td class="px-6 py-4">
                <?php
            foreach($allSubjects as $subject){
                   $subject_id = $subject['id'];
                   $sql_3 = "SELECT COUNT(*) as no_class FROM attendance where user_id = ? AND subject_id = ? AND status = 'No class'";
                            $stmt = $conn->prepare($sql_3);
                            $stmt->bind_param("ii", $user_id, $subject_id);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            $rowData = $result->fetch_assoc();
                            $classes_cancelled = $rowData['no_class'];
                     echo $classes_cancelled . '<br/>';     
                }
                ?>
            </td>
            <td class="px-6 py-4">
            <?php
            foreach($allSubjects as $subject){
                   $subject_id = $subject['id'];
                   $sql_3 = "SELECT * FROM classes where user_id = '$user_id' AND subject_id = '$subject_id'";
                   $result_3 = mysqli_query($conn, $sql_3);
                   $data = mysqli_fetch_assoc($result_3);
                   $total = $data['total_classes'];
                $sql_4 = "SELECT * FROM attendance where user_id = '$user_id' AND subject_id = '$subject_id'";
                   $row_count = mysqli_num_rows(mysqli_query($conn, $sql_4));
                   echo ($total - $row_count) . '<br/>';

                }
                ?>
            </td>
            <td>
            <i style="color: #b71616;" class="fa-solid fa-trash delete-icons text-xl" data-user-id="<?= $user_id?>"></i>
            </td>
            </tr>
<?php
       }
       ?>
          </tbody>
</table>
</div>
    </div>
    <?php
    include "includes/script.php";
    ?>
    <script src="js/admin.js"></script>
</body>
</html>
