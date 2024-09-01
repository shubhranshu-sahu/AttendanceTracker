<?php
require "includes/database_connect.php";
if(!isset($_SESSION['user_id'])){
header("location: home.php");
}
$user_id = $_SESSION['user_id'];
$sql_3 = "SELECT * FROM subjects where user_id = '$user_id'";
$result_3 = mysqli_query($conn, $sql_3);
$data_3 = mysqli_fetch_all($result_3, MYSQLI_ASSOC);

//prepare the subject names and classes count arrays
$subjects_array = [];
$classes_array = [];
$attendance = [];

foreach($data_3 as $subject){
    $subject_id = $subject['id'];
    $sql = "SELECT COUNT(*) as present_classes FROM attendance where user_id = '$user_id' AND STATUS = 'Present' AND subject_id = '$subject_id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $classes = $row['present_classes'];
    $classes_array[$subject_id] = $classes;
    $subjects_array[$subject_id] = $subject['subject_name']; 
    $sql_4 = "SELECT * FROM classes where user_id = '$user_id' AND subject_id = '$subject_id'";
    $result_4 = mysqli_query($conn, $sql_4);
    $classes_data = mysqli_fetch_assoc($result_4);
    $total_classes = $classes_data['total_classes'];
    $attendance[$subject_id] = round((($classes / $total_classes)*100), 1);
}
    $classes_json = json_encode(array_values($classes_array));
    $subjects_json = json_encode(array_values($subjects_array));
    $attendance_json = json_encode(array_values($attendance));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
   <div>
    <canvas id="myChart"></canvas>
   </div>
   <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

   <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo $subjects_json ?>, 
                datasets: [{
                    label: 'Number of classes attended',
                    data: <?php echo $classes_json ?>, 
                    borderWidth: 1,
                    backgroundColor: 'rgba(20,184,166,0.2)',
                    borderColor: 'rgba(20,184,166,1)',
                    yAxisID: 'y'
                }, {
                    label: 'Attendance %',
                    data: <?php echo $attendance_json ?>, 
                    borderWidth: 1,
                    backgroundColor: 'rgba(249,115,22,0.2)',
                    borderColor: 'rgba(249,115,22,1)',
                    yAxisID: 'y1'
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        position: 'left',
                        title: {
                            display: true,
                            text: 'Number of Classes Attended'
                        }
                    },
                    y1: {
                        beginAtZero: true,
                        position: 'right',
                        title: {
                            display: true,
                            text: 'Attendance %'
                        },
                       
                        type: 'linear',
                        grid: {
                            drawOnChartArea: false
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.dataset.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                if (context.parsed.y !== null) {
                                    label += context.parsed.y;
                                }
                                return label;
                            }
                        }
                    }
                }
            }
        });
    </script>


<?php
include "includes/script.php";
?>
</body>
</html>