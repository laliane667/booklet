<?php

if(isset($_POST["submit"])){
   
    $pwd = $_POST["pwd"];
    $username = $_POST["uid"]; 
    
    require_once 'dbh.be.php'; 
    require_once 'functions.be.php'; 

    if(emptyInputLogin($username, $pwd) !== false){
        header("location: ../index.php?log_failed:error=emptyinput");
        exit();
    }

    loginUser($conn, $username, $pwd); 
}
else{
    header("location: ../index.php");
    exit();
} 


