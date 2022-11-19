<?php

class Task{
    public $taskID;
    public $taskTitle;
    public $taskDescription;
    public $dateDue;
    public $taskDone;
    public $taskImportant;
    public $taskUrgent;
    public $userID;

    public function __construct($taskID=null, $taskTitle=null, $taskDescription=null, $dateDue=null, $taskDone=null, $taskImportant=null, $taskUrgent=null, $userID=null)
    {
        $this->taskID = $taskID;
        $this->taskTitle = $taskTitle;
        $this->taskDescription = $taskDescription;
        $this->dateDue = $dateDue;
        $this->taskDone = $taskDone;
        $this->taskImportant = $taskImportant;
        $this->taskUrgent = $taskUrgent;
        $this->userID = $userID;
    
    }

    public static function addTask(Task $task, mysqli $conn) {
        $query = "INSERT INTO tasks(taskTitle, taskDescription, dateDue, taskImportant, taskUrgent, userId) 
        VALUES ('$task->taskTitle','$task->taskDescription','$task->dateDue',$task->taskImportant,$task->taskUrgent, '$task->userID')";
        return $conn->query($query);    
}
    public static function viewAllTasks(mysqli $conn)
    {
        $query = "SELECT * FROM tasks WHERE userId=$_SESSION[userID]";
        return $conn->query($query);
    }

    public static function deleteTask($taskID, mysqli $conn) {
        $query = "DELETE FROM tasks WHERE taskId=$taskID";
        return $conn->query($query);
    }

    public static function updateTaskChecked($taskID, mysqli $conn){
        $q = "UPDATE `tasks` SET `taskDone`='1' WHERE taskID=$taskID";
        return $conn->query($q);
    }

    public static function updateTaskUnCheck($taskID, mysqli $conn){
        $q = "UPDATE `tasks` SET `taskDone`=0 WHERE taskID=$taskID";
        return $conn->query($q);
    }
}
//$taskID, $taskTitle, $taskDescription, $dateDue, $taskDone, $taskImportant, $taskUrgent, $userID
/* task::addTask ----DONE
		task::viewAllTasks ---done
		task::updateTask:checked ---done
		task::deleteTask --- done
		 */
?>