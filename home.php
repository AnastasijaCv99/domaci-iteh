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

/*$cookie_name = "user";
$cookie_value = "John Doe";
setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day*/

/*$result = Task::viewAllTasks($conn);

if (!$result) {
    echo "Greska kod upita<br>";
    die();
}*/
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
                                    <input type="text" style="border: 1px solid black" name="taskTitle" id="title" class="form-control" placeholder="npr. domaci zadatak" value="" required/>
                                    <br>
                                </div>
                                <br>
                                <div class="form-group">
                                <label for="taskDescription">Unesi opis taska:</label>
                                    <input type="textarea" style="border: 1px solid black" name="taskDescription" id="disc" class="form-control" placeholder="npr. PHP aplikacija" value="" required/>
                                    <br>
                                </div>
                                <br>
                                <div class="form-group">
                                <label for="dateDue">Rok za task je:</label>
                                    <input type="text" style="border: 1px solid black" name="dateDue" class="form-control" id="date" placeholder="format: YYYY-MM-DD" value="" required/>
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
                        <!-- poziv viewAll i smestanje u result! -->
                        <?php 
                        $result = Task::viewAllTasks($conn);

                        if (!$result) {
                            echo "Greska kod upita<br>";
                            die();
                        }
                        //ako user ima taskove, prikazi sve, ako nema nikakvih taskova, nemoj nista da mu prikazes od tabele! -->
                        if ($result->num_rows>0) {
                        ?>
                        <table id="myTable" class="taskovi" style="color: black; width:90%; margin-left: auto; margin-right: auto;">
                                                        
                        <br>
                        <br>
                            <thead class="thead">
                                <tr style="text-decoration: underline;">
                                    <th style="font-style: oblique; text-decoration: none;">RESENO</th>
                                    <th style="width:15%" scope="col">Naziv</th>
                                    <th style="width:15%" scope="col">Opis</th>
                                    <th style="width:30%" scope="col">Rok</th>
                                    <th scope="col">Bitno</th>
                                    <th scope="col">Hitno</th>
                                </tr>
                            </thead>
                            <tbody class="tbody">
                                <!-- pocetak phpa za prikaz svega-->
                                <?php
                            while ($red = $result->fetch_array()) {
                                ?>
                                    <tr class="redic" style="text-align:left; background-color: white" id="row<?php echo $red['taskID']?>">
                                        <td style="text-align:center;"> 
                                            <label class="checked-btn">
                                                <!--ako je checked, prikazi da je checked, i odcekiraj -->
                                                <?php 
                                                    if($red["taskDone"]==1) {
                                                ?>
                                            <input type="checkbox" id="CheckedTask" name="cekiraj" onclick="updateTaskUncheck(<?php echo $red['taskID']?>)" value=<?php echo $red["taskID"] ?> checked>
                                            <!--prikazi ovde one koji su checked sa strikethrough -->
                                                      <!-- pocetak prikaza taskova-->
                                                        <td><s> <?php echo $red["taskTitle"] ?> </s></td>
                                                        <td><s> <?php echo $red["taskDescription"] ?> </s></td>
                                                        <td><s> <?php echo $red["dateDue"] ?> </s></td>
                                                        
                                                        <td><s> <?php 
                                                        if($red["taskImportant"]==1) {
                                                            echo "Da";
                                                        } else echo "Ne"; ?> </s></td>
                                                        <td><s> <?php 
                                                        if($red["taskUrgent"]==1) {
                                                            echo "Da";
                                                        } else echo "Ne"; ?> </s></td>
                                                    <td>
                                                    
                                                    <label class="custom-radio-btn">
                                                        <input type="button" id="izbor"  name="odaberi" onclick="deleteTask(<?php echo $red['taskID']?>)" value=Obrisi>
                                                        <span class="checkmark"></span>
                                                    </label>
                                                    </td>
                                                    </tr>  
                                                     <!-- kraj prikaza taskova-->
                                                           
                                            <!--ako nije checked, prikazi to, i kad cekira nek ostane cekirano-->
                                                <?php 
                                                    }else if($red["taskDone"]==0) {
                                                ?>
                                            <input type="checkbox" id="CheckedTask" name="cekiraj" onclick="updateTaskChecked(<?php echo $red['taskID']?>)" value=<?php echo $red["taskID"] ?>>
                                            <span class="checkmark"></span>
                                            <!-- pocetak prikaza taskova-->
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
                                    <!-- kraj prikaza taskova-->
                                                <?php 
                                                }
                                                ?>
                                    </td>
                                        
                                <?php
                            }
                        }
                                ?> <!-- kraj phpa-->      
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
        <script src="js/search.js"> </script>      
</body>
</html>

