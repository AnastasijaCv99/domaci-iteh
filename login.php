<?php 

require("dbBroker.php");
require("model/user.php");

session_start();

if (isset($_POST['username']) && isset($_POST['password'])) {
    $name = $_POST['username'];
    $pass = $_POST['password'];
        
    //$korisnik = new User($name, $pass);

    $response = User::login($name, $pass, $conn);
    
   

   if ($response->num_rows==1) {
        $_SESSION['in']="userLoggedOrRegistered";
        $_SESSION['userID'] = $response->fetch_assoc()['userId'];  //$korisnik->userID
       
        //$_SESSION['userID'] = $response;//$korisnik->userID
        header("Location: home.php");
       
        exit();
    } else {
       echo "Wrong username or password";
    }

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

    <div class="login-form">
        <h3>LOGIN</h3>
        <div class="main-div">
            <form method="POST" action="#">
                <div class="container">
                    <label class="username">Korisnik</label>
                    <input type="text" name="username" class="form-control" required>
                    <br>
                    <label for="password">Lozinka</label>
                    <input type="password" name="password" class="form-control" required>
                    <button type="submit" class="btn btn-primary" name="submit">Prijavi se</button>
                </div>

            </form>
        </div>
    </div>

</body>

</html>