<?php

require "../dbBroker.php";
require "../model/task.php";

session_start();

$currUser=$_SESSION['userID'];

/* &&
    (isset($_POST["taskImportant"])|| !isset($_POST["taskImportant"])) &&
    (isset($_POST["taskUrgent"]) || !isset($_POST["taskUrgent"]))*/

if (($_POST["taskTitle"]!='')  && 
    ($_POST["taskDescription"]!='') && 
    ($_POST["dateDue"]!=''))
{
    
        if ($_POST['taskImportant']=="1") {
            $imp=1;
        } else $imp=0;
        if ($_POST['taskUrgent']=='1') {
            $urg=1;
        } else $urg=0;

        //$imp = isset($_POST['taskImportant']) ? 1 : 0;
        //$urg = isset($_POST['taskUrgent']) ? 1 : 0;

    $task = 
    new Task(null, $_POST["taskTitle"], $_POST["taskDescription"], 
    $_POST["dateDue"], null, $_POST['taskImportant'], $_POST['taskUrgent'], $currUser);

    $response = Task::addTask($task, $conn);

    if($response) {
        $response_array['status'] = 'success';
        echo json_encode($response_array);
        } else {
            $response_array['status'] = 'failed';
            echo json_encode($response_array);
            //echo $_POST['taskID'];
        }
    




    /*$response = array();

    if ($status) {
        $response['success']= "Succ";
    } else {
    $response['error']= "Err";
    }
    exit(json_encode($response));
*/
}

?>

