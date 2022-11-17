<?php

require ("../dbBroker.php");
require ("../model/task.php");

session_start();

$currUser=$_SESSION['userID'];

/* &&
    (isset($_POST["taskImportant"])|| !isset($_POST["taskImportant"])) &&
    (isset($_POST["taskUrgent"]) || !isset($_POST["taskUrgent"]))*/

if (isset($_POST["taskTitle"]) && 
    isset($_POST["taskDescription"]) && 
    isset($_POST["dateDue"])) 
{
    if(isset($_POST["taskImportant"])) {
        $imp = 1;
    } else $imp = 0;
    if(isset($_POST["taskUrgent"])) {
        $urg = 1;
    } else $urg = 0;
    
    
    //$imp = isset($_POST['taskImportant']) ? 1 : 0;
    //$urg = isset($_POST['taskUrgent']) ? 1 : 0;
    $task = 
    new Task(null, $_POST["taskTitle"], $_POST["taskDescription"], 
    $_POST["dateDue"], null, $imp, $urg, $currUser);

    $status = Task::addTask($task, $conn);

    if ($status) {
        echo "Succ";
    } else {
        echo $status;
        echo "Failed";
    }
}




?>