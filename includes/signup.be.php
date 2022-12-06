<?php

if(isset($_POST["submit"])){
    
    $name = $_POST["name"];    
    $email = $_POST["email"];    
    $username = $_POST["uid"];    
    $pwd = $_POST["pwd"];    
    $pwdRepeat = $_POST["pwdRepeat"];    

    
    require_once 'dbh.be.php'; 
    require_once 'functions.be.php'; 
    

    if(emptyInputSignup($name, $email, $username, $pwd, $pwdRepeat) !== false){
        header("location: ../index.php?sg_failed:error=emptyinput");
        exit();
    }

    if(invalidUid($username) !== false){
        header("location: ../index.php?sg_failed:error=invaliduid");
        exit();
    }

    if(invalidEmail($email) !== false){
        header("location: ../index.php?sg_failed:error=invalidemail");
        exit();
    }

    if(pwdMatch($pwd, $pwdRepeat) !== false){
        header("location: ../index.php?sg_failed:error=passwordsdontmatch");
        exit();
    }


    if(uidExists($conn, $username, $email) !== false){
        header("location: ../index.php?sg_failed:error=usernametaken");
        exit();
    }

    
    createUser($conn, $name, $email, $username, $pwd);  

}
else{
    header("location: ../signup.php");
    exit();
}
