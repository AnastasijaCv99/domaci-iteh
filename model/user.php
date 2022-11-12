<?php

class User{
    public $userID;
    public $username;
    public $userPass;
    public $userEmail;

    public function __construct($userID=null, $username=null, $userPass=null, $userEmail=null){
        $this->userID = $userID;
        $this->username = $username;
        $this->userPass = $userPass;
        $this->userEmail = $userEmail;
    }

    public static function login($name, $pass, mysqli $conn) {

        $query = "SELECT * FROM users WHERE username='".$name."' and userPass='".$pass."'";
        return $conn->query($query);
    }

    public static function register($name, $pass, $mail, mysqli $conn) {
        //ubaci u bazu
        $query = "INSERT INTO `users`(`username`, `userPass`, `userEmail`) 
        VALUES ('".$name."','".$pass."','".$mail."')";
        return $conn->query($query); //vrati true ako je uspesno
    }
}


?>
