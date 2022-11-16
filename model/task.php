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
        VALUES ('$task->taskTitle','$task->taskDescription','$task->dateDue','$task->taskImportant','$task->taskUrgent', '$task->userID')";
        return $conn->query($query);    
}
    public static function viewAllTasks(mysqli $conn)
    {
        $query = "SELECT * FROM tasks WHERE userId=$_SESSION[userID]";
        return $conn->query($query);
    }


}
//$taskID, $taskTitle, $taskDescription, $dateDue, $taskDone, $taskImportant, $taskUrgent, $userID
/* task::addTask ----DONE
		task::viewAllTasks
		task::updateTask
		task::deleteTask
		task::searchByDateDue
		task::sortByDateDue
		task::sortByUrgent
		task::sortByImportant
		task::sortByGetLast */
?>