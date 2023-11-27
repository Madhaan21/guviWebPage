<?php

include_once("../conf/config.php");
include_once("../PHP/fetch.php");

if(isset($_POST['firsname']) || isset($_POST['lastname']) || isset($_POST['password'])){

    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $password = $_POST['password'];

    $email = $_SESSION['email'];

   $hash = md5($password);

    if(empty($firstname) || empty($lastname) || empty($password)){
     
        echo "empty field";
    }else{

        if(preg_match('/^[a-f0-9]{32}$/', $password)){

            $query = "UPDATE registration SET firstname = '$firstname' , lastname = '$lastname', password = '$password' WHERE email = '$email' ";
        }else{
            $query = "UPDATE registration SET firstname = '$firstname' , lastname = '$lastname', password = '$hash' WHERE email = '$email' ";
        }

        $r = mysqli_query($con,$query);

        if($r == 1){

            echo "<script>alert('Updated Successfully');window.location='../PHP/profile.php'</script>";
        }else{
            echo "<script>alert('Failed to Update');window.location='../PHP/profile.php'</script>";
        }
    }
}
?>