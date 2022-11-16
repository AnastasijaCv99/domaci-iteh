<?php 

require("dbBroker.php");
require("model/user.php");

session_start();

if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['email'])) {
    $name = $_POST['username'];
    $pass = $_POST['password'];
    $mail = $_POST['email'];
  
    $newUser = new User(null, $name, $pass, $mail);
    //$id = $conn->query("SELECT userId FROM users WHERE username='$newUser->username' and userPass='$newUser->userPass'");

    //$rs = User::register($newUser, $conn);
    //$rs->num_rows==1
    //register je bool, ako je uspesno odradio registraciju, prebaci ga na home
    if(User::register($newUser, $conn)){
    //    $_SESSION['userID'] = $id->fetch_assoc()['userId'];

        $_SESSION['in']="userLoggedOrRegistered";
        
        header("Location: home.php");
    }
    
 //napravi validaciju za unete stvari!!
    
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

    <div class="register-form">
        <h3>LOGIN</h3>
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
                    <button type="submit" class="btn btn-primary" name="submit">Registruj se</button>
                </div>

            </form>
        </div>
        <h3><a href="index.php">LOGIN</a></h3>

    </div>

</body>

</html>