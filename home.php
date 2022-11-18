<?php

require("dbBroker.php");
require("model/task.php");

session_start();

//echo "bravo hehe\n\t";
//echo $_SESSION['userID'];


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
    <link rel="stylesheet" type="text/css" href="css/home.css">
    <title>Make your TO-DO list</title>
        
</head>


<body> 
    
     <!--Ubacivanje u listu-->
     <?php include "menu.html" ?>
    <div> 
        <table class="tabela" style="border: 10px beige; width:80%;">
            <tr style="border: 5px beige;">
                <th style="border: 5px beige; background-color: darkslateblue; width:50%;"><h3 id="naslov" style="text-align:center;">Dodaj task</h3></th>
                <th style="border: 5px beige; background-color: darkslateblue; width:50%;"><h3 id="naslovdesno" style="text-align:center;">Tvoji taskovi</h3></th>
            </tr>
            <tr style="border: 5px beige;">
                <td style="border: 3px darkslateblue; text-align:center;">
                 <!--ubaci task -->
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="task-form">
                            <form action="#" method="post" id="addTasks">
                                <div class="row">
                                <div class="col-md-6">
                                <div class="form-group">
                                <label for="taskTitle">Unesi naziv taska:</label>
                                    <input type="text" style="border: 1px solid black" name="taskTitle" id="title" class="form-control" placeholder="npr. domaci zadatak" value="" />
                                    <br>
                                </div>
                                <br>
                                <div class="form-group">
                                <label for="taskDescription">Unesi opis taska:</label>
                                    <input type="textarea" style="border: 1px solid black" name="taskDescription" id="disc" class="form-control" placeholder="npr. PHP aplikacija" value="" />
                                    <br>
                                </div>
                                <br>
                                <div class="form-group">
                                <label for="dateDue">Rok za task je:</label>
                                    <input type="text" style="border: 1px solid black" name="dateDue" class="form-control" id="date" placeholder="format: YYYY-MM-DD" value="" />
                                    <br>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label for="taskImportant">Bitno?</label>
                                    <input type="checkbox" class = "checkImp" name="taskImportant" class="form-control" value="0"/>
                                    
                                </div>
                                <div class="form-group">
                                    <label for="taskUrgent">Hitno?</label>
                                    <input type="checkbox" class = "checkUrgent" name="taskUrgent" class="form-control" value="0"/>
                                    
                                </div>
                                <br>
                                <div class="form-group">
                                    <button id="btnDodaj" type="submit" class="btn-succ" ><i class="glyphicon glyphicon-plus"></i> Dodaj task
                                    </button>
                                </div>
                                </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                </td>

                <td style="border: 3px darkslateblue; text-align:center; margin-top: 1cm; padding-top: 1cm;">
                <!--Prikaz taskova -->
                <div id="prikaz" class="panel panel-success">
                    <div class="panel-body">
                        <table id="myTable" class="taskovi" style="color: black; width:90%; margin-left: auto; margin-right: auto;">
                            <thead class="thead">
                                <tr style="text-decoration: underline;">
                                    <th style="font-style: oblique; text-decoration: none;">RESENO</th>
                                    <th scope="col">Naziv</th>
                                    <th scope="col">Opis</th>
                                    <th scope="col">Rok</th>
                                    <th scope="col">Bitno</th>
                                    <th scope="col">Hitno</th>
                                </tr>
                            </thead>
                            <tbody class="tbody">
                                <?php
                            while ($red = $result->fetch_array()) {
                                ?>
                                    <tr class="redic" style="text-align:left; background-color: white" id="row<?php echo $red['taskID']?>">
                                        <td style="text-align:center;"> 
                                            <label class="checked-btn">
                                                <?php 
                                                    if($red["taskDone"]==1) {//ako je u bazi checked, da uvek stoji checked
                                                ?>
                                            <input type="checkbox" id="CheckedTask" name="cekiraj" onclick="updateTaskUncheck(<?php echo $red['taskID']?>)" value=<?php echo $red["taskID"] ?>  checked>
                                            <span class="checkmark"></span>
                                                <?php 
                                                    }else if($red["taskDone"]==0) {
                                                ?>
                                            <input type="checkbox" id="CheckedTask" name="cekiraj" onclick="updateTaskChecked(<?php echo $red['taskID']?>)" value=<?php echo $red["taskID"] ?>>
                                            <span class="checkmark"></span>
                                                <?php
                                                }
                                                ?>
                                        </td>
                                        <!--ovde bi mogla funckija da radi nesto -->
                                        <td><?php echo $red["taskTitle"] ?></td>
                                        <td><?php echo $red["taskDescription"] ?></td>
                                        <td><?php echo $red["dateDue"] ?></td>
                                        
                                        <td><?php 
                                        if($red["taskImportant"]==1) {
                                            echo "Da";
                                        } else echo "Ne"; ?></td>
                                        <td><?php 
                                        if($red["taskUrgent"]==1) {
                                            echo "Da";
                                        } else echo "Ne"; ?></td>
                                    <td>
                                    
                                    <label class="custom-radio-btn">
                                        <input type="button" id="izbor"  name="odaberi" onclick="deleteTask(<?php echo $red['taskID']?>)" value=Obrisi>
                                        <span class="checkmark"></span>
                                    </label>
                                    </td>
                                    </tr>
                                <?php
                            }
                                ?>      
                            </tbody>
                        </table>    
                        <br>
                    </div>
                </div>
                </td>
            </tr>
         </table>
    </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="js/add.js"> </script>
        <script src="js/delete.js"> </script>  
        <script src="js/update.js"> </script>         
</body>
</html>