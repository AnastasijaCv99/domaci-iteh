<?php 

require("dbBroker.php");
require("model/user.php");

session_start();

if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['email'])) {
    $name = $_POST['username'];
    $pass = $_POST['password'];
    $mail = $_POST['email'];
  
    $newUser = new User(null, $name, $pass, $mail);


    $rs = User::register($newUser, $conn);
    $id = $conn->insert_id;

    
    //register je bool, ako je uspesno odradio registraciju, prebaci ga na home
    if($rs===TRUE){
               
        $_SESSION['in']="userLoggedOrRegistered";
        $_SESSION['userID']=$id;
        header("Location: home.php");
    }
    

    
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/logreg.css"> 
    <title>Make your TO-DO list</title>

</head>

<body>

    <div class="register-form">
        <h3>REGISTER</h3>
        <div class="main-div">
            <form method="POST" action="#">
                <div class="container">
                    <label class="username">Korisnik</label>
                    <input type="text" name="username" class="form-control" required>
                    <br>
                    <label for="password">Lozinka</label>
                    <input type="password" name="password" class="form-control" required>
                    <br>
                    <label class="email">E-mail</label>
                    <input type="text" name="email" class="form-control" required>
                    <br>
                    <button type="submit" class="btn-sub" name="submit">Registruj se</button>
                </div>

            </form>
        </div>
        
        <h3><a href="login.php">Imas nalog? Login</a></h3>

    </div>

</body>

</html>