<?php

require("dbBroker.php");
require("model/task.php");

session_start();

echo "bravo hehe\n\t";
echo $_SESSION['userID'];


if (empty($_SESSION['in'])) {
    header("Location: index.php");
    exit();
}

//echo '$_SESSION['userID']';

$result = Task::viewAllTasks($conn);
if (!$result) {
    echo "Greska kod upita<br>";
    
    die();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!-- <link rel="stylesheet" type="text/css" href="css/style.css"> -->
    <title>Make your TO-DO list</title>
</head>


<body> 

    <h1>Napravi svoju to-do listu </h1>
    <h3><a href="logout.php">odjavi se</a></h3>

     <!--Ubacivanje u listu-->
     <div class="modal-content" style="border: 4px solid green;">
            
                <div class="modal-body">
                    <div class="container task-form">

                        <form action="#" method="post" id="addTasks">
                            <h3 id="naslov" style="color: black" text-align="center">Dodaj task</h3>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" style="border: 1px solid black" name="taskTitle" class="form-control" placeholder="Naziv taska" value="" />
                                    </div>
                                    <div class="form-group">
                                        <input type="text" style="border: 1px solid black" name="taskDescription" class="form-control" placeholder="Opis taska" value="" />
                                    </div>
                                    <div class="form-group">
                                        <input type="text" style="border: 1px solid black" name="dateDue" class="form-control" placeholder="Do kad? format: YYYY-MM-DD" value="" />
                                    </div>
                                    <div class="form-group">
                                        <input type="checkbox" name="taskImportant" class="form-control" value="0"/>
                                        <label for="taskImportant">Vazno?</label><br>
                                    </div>
                                    <div class="form-group">
                                        <input type="checkbox" name="taskUrgent" class="form-control" value="0"/>
                                        <label for="taskUrgent">Hitno?</label><br>
                                    </div>
                                    <div class="form-group">
                                        <button id="btnDodaj" type="submit" class="btn-succ" style="background-color: orange; border: 1px solid black;"><i class="glyphicon glyphicon-plus"></i> Dodaj task
                                        </button>
                                </div>
                            
                            </div>


                        
                        </form>
                    </div>
                </div>
    </div>

    <!--Prikaz taskova -->
    <div id="prikaz" class="panel panel-success" style="margin-top: 1%;">

            <div class="panel-body">
                <table id="myTable" class="table table-hover table-striped" style="color: black; background-color: grey;">
                    <thead class="thead">
                        <tr>
                            <th scope="col">Naziv</th>
                            <th scope="col">Opis</th>
                            <th scope="col">Hitno</th>
                            <th scope="col">Bitno</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($red = $result->fetch_array()) {
                        ?>
                            <tr>
                                <td><?php echo $red["taskTitle"] ?></td>
                                <td><?php echo $red["taskDescription"] ?></td>
                                <td><?php echo $red["taskUrgent"] ?></td>
                                <td><?php echo $red["taskImportant"] ?></td>
                                <td>
                                    <label class="custom-radio-btn">
                                        <input type="radio" name="checked-donut" value=<?php echo $red["taskID"] ?>>
                                        <span class="checkmark"></span>
                                    </label>
                                </td>

                            </tr>
                        <?php
                        }
                        ?>
                        
                    
                    


                    </tbody>
                </table>
       
                
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="js/add.js"> </script>         
</body>
</html>