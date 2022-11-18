<?php

require ("../dbBroker.php");
require ("../model/task.php");

session_start();
$currUser=$_SESSION['userID'];
$tas=$_POST['taskID'];

$response = Task::updateTaskChecked($tas, $conn);

if($response) {
    $response_array['status'] = 'success';
    echo json_encode($response_array);
    } else {
        $response_array['status'] = 'failed';
        echo json_encode($response_array);
        //echo $_POST['taskID'];
    }
?> 

