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

    
    public static function login($username, $userPass, mysqli $conn) {
        $query = $conn->query("SELECT userId FROM users WHERE username='$username' and userPass='$userPass'");
        return  $query;//$conn->query($query); //broj redova koji su se izvrsili
    }

    public static function register($user, mysqli $conn) {
        //ubaci u bazu
        $query = "INSERT INTO `users`(`username`, `userPass`, `userEmail`) 
        VALUES ('$user->username','$user->userPass','$user->userEmail')";
        return $conn->query($query); 
    }
}


?>
