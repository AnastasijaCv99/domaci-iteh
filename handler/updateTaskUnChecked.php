<?php

require ("../dbBroker.php");
require ("../model/task.php");

session_start();
$currUser=$_SESSION['userID'];
$tas=$_POST['taskID'];

$status = Task::updateTaskUnCheck($tas, $conn);

if($status) {
    $status_array['status'] = 'success';
    echo json_encode($status_array);
    } else {
        $status_array['status'] = 'failed';
        echo json_encode($status_array);
        //echo $_POST['taskID'];
        }

?> 

