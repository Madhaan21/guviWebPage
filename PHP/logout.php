<?php
session_start();
if(isset($_SESSION['email'])){
    
    session_destroy();
    header("Location:../HTML/login.php");
}
else{
    if(isset($_COOKIE['email']) || isset($_COOKIE['password'])){
        $email=$_COOKIE['email'];
        $password=$_COOKIE['password'];
        
        setcookie("email",$email,time()-3600);
        setcookie("password",$password,time()-3600);
        header("Location:../HTML/login.php");

    }
}
?>