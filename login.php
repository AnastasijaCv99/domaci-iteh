<?php 

require("dbBroker.php");
require("model/user.php");

session_start();

if (isset($_POST['username']) && isset($_POST['password'])) {
    $name = $_POST['username'];
    $pass = $_POST['password'];
    //$userID = 1;
//mozda umesto userID da ide broj 1
   // $korisnik = new User($name, $pass);
    

    $response = User::login($name, $pass, $conn);

   if ($response->num_rows == 1) {
        $_SESSION['userID'] = $response->fetch_assoc()['userID'];
        header("Location: home.php");
        exit();
    } else {
       echo '<script> alert("Wrong username or password"); </script>';
    }
    

   /*  echo json_encode($response);

    if ($response) {
        echo `
        <script>
        alert("Uspesno ste se ulogovali");
        </script>
        `;
        $_SESSION['userID'] = $korisnik->userID;
        header('Location: home.php');
        exit();
    } else {
        echo `
        <script>
        alert("Wrong username or password");
        </script>
        `;
    }*/

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