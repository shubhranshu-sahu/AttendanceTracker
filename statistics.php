<?php
session_start();
if(!isset($_SESSION['user_id'])){
header("location: home.php");
}
$user_id = $_SESSION['user_id'];
require "includes/database_connect.php";

$sql_2 = "SELECT * FROM subjects where user_id = '$user_id'";
$result_2 = mysqli_query($conn, $sql_2);
$data = mysqli_fetch_all($result_2, MYSQLI_ASSOC);
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance statistics</title>
    <?php
    include "includes/head_links.php";
    ?>
    <link rel="stylesheet" href="css/statistics.css">
</head>

<body>
    <?php
    include "includes/header.php";
    ?>
        <div id="table" class="flex justify-center content pt-[8rem]">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-12">
                <table class="w-full text-left rtl:text-right text-gray-400 dark:text-gray-400">
                    <thead class="text-xs text-gray-400 uppercase dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3 bg-gray-800 dark:bg-gray-800">
                                Subject name
                            </th>
                            <th scope="col" class="px-6 py-3 bg-yellow-100">
                                Number of classes attended
                            </th>
                            <th scope="col" class="px-6 py-3 bg-gray-800 dark:bg-gray-800">
                                Percentage
                            </th>
                            <th scope="col" class="px-6 py-3 bg-yellow-100">
                                Classes required to get 75% attendance
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($data as $row) {
                            $subject_id = $row['id'];
                            $sql = "SELECT COUNT(*) as classes_attended FROM attendance where user_id = ? AND subject_id = ? AND status = 'Present'";
                            $stmt = $conn->prepare($sql);
                            $stmt->bind_param("ii", $user_id, $subject_id);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            $rowData = $result->fetch_assoc();
                            $classes_attended = $rowData['classes_attended'];
                            $sql_3 = "SELECT * FROM classes where user_id = '$user_id' AND subject_id = '$subject_id'";
                            $result_3 = mysqli_query($conn, $sql_3);
                            $classData = mysqli_fetch_assoc($result_3);

                        ?>
                            <tr class="border-b border-gray-700 dark:border-gray-700">
                                <th scope="row" class="px-6 py-4 font-medium text-white whitespace-nowrap bg-gray-800 dark:text-white dark:bg-gray-800">
                                    <?= $row['subject_name'] ?>
                                </th>
                                <td class="px-6 py-4 bg-yellow-100">
                                    <?= $classes_attended ?>
                                </td>
                                <td class="px-6 py-4 bg-gray-800 dark:bg-gray-800">
                                    <?= round(($classes_attended / $classData['total_classes'] * 100), 1) ?> %
                                </td>
                                <td class="px-6 py-4 bg-yellow-100">
                                    <?= round(((($classData['total_classes'] * 3) / 4) - $classes_attended), 0) ?>
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
</body>

</html>