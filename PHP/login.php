<?php

$response = array(
    "status" => 0,
    "message" => "Form Failed"
);

session_start();

include("../conf/config.php");

$errorEmpty = false;
$errorEmail = false;

if(isset($_POST['email']) || isset($_POST['password'])){

    $email = $_POST['email'];
    $password = $_POST['password'];

    if(!empty($email) && !empty($password)){
        if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
            $response['message'] = "Invalid Email";
            $errorEmpty=true;
        }else{
            if($errorEmpty == false && $errorEmail == false){
                $dehash = md5($password);
                $query = "SELECT * FROM registration WHERE email = '$email' AND password = '$dehash'";
                $r = mysqli_query($con,$query);
                $check = mysqli_num_rows($r);

                if(isset($_POST['remember_me'])){
                    $remember_me = $_POST['remember_me'];

                    if(!empty($remember_me)){
                        if($check == 1){
                            $response['status'] = 1;
                            //$response['message'] = "Successfully logged in";
                            $response['message'] = "<script>window.location = '../PHP/profile.php'</script>";
                            $response['email'] = $email;
                            $response['password'] = $password;
                        }else{
                            $response['message'] = "Sorry! No record Found";
                            //$response['message'] = "<script>window.location = '../HTML/login.php'</script>";
                        }
                    }
                }else{
                    if($check == 1){
                        $_SESSION['email'] = $email;
                        $response['status'] = 1;
                        $response['message'] = "<script>window.location = '../PHP/profile.php'</script>";
                    }else{
                        $response['message'] = "Sorry! No record Found";
                        //$response['message'] = "<script>window.location = '../HTML/login.php'</script>";
                    }
                }
            }
        }
    }else{
        $response['message'] = "Empty";
        $errorEmpty=true;
    }

}
echo json_encode($response);

?>