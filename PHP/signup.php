<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

include("../conf/config.php");

$response = array(
    'status' => 0,
    'message' => 'Form submission failed'
);
$uploadDir = "C:/xampp/htdocs/GUVI/uploads/";
$errorEmpty = false;
$errorEmail = false;

if (isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['email']) && isset($_POST['password']) || isset($_POST['file'])){
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    

    if (!empty($firstname) && !empty($lastname) && !empty($email) && !empty($password) && !empty($_FILES['file']['name'])) {
        
        if (!filter_var($email, FILTER_VALIDATE_EMAIL) || !preg_match('/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/', $email)) {
            $response['message'] = 'Invalid Email';
            $errorEmail = true;
        }else{
            if($errorEmpty == false && $errorEmail == false){
                $uploadStatus = 1;

                $uploadFile='';

                if(!empty($_FILES['file']['name'])){
                    $fileName = basename($_FILES['file']['name']);
                    $targetFilePath = $uploadDir . $fileName;
                    //$fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

                    if(file_exists($targetFilePath)){
                        $response['message'] = 'Sorry! File Already Exists';
                        $uploadStatus=0;
                    }else{
                        if($_FILES['file']['size'] > 5000000){
                            $response['message'] = 'Sorry! Your file is too large';
                            $uploadStatus=0;
                        }else{
                            if(move_uploaded_file($_FILES['file']['tmp_name'], $targetFilePath)){
                                $uploadFile=$fileName;
                                $uploadStatus=1;
                            }else{
                                $response['message'] = 'Sorry! an error occured';
                                $uploadStatus = 0;
                                
                            }
                        }
                        
                    }
                }
                
                if($uploadStatus == 1){
                    $hash = md5($password);
                    $checkQuery = "SELECT * FROM registration WHERE email = ?";
                    $checkStmt = mysqli_prepare($con, $checkQuery);
                    mysqli_stmt_bind_param($checkStmt, 's', $email);
                    mysqli_stmt_execute($checkStmt);
                    mysqli_stmt_store_result($checkStmt);

                    if (mysqli_stmt_num_rows($checkStmt) > 0) {
                        $response['message'] = 'Sorry! Email already exists';
                    } else {
                        
                        $query = "INSERT INTO registration (firstname, lastname, email, password, image) VALUES (?, ?, ?, ?, ?)";
                        $stmt = mysqli_prepare($con, $query);
                        mysqli_stmt_bind_param($stmt, 'sssss', $firstname, $lastname, $email, $hash, $uploadFile);

                        if (mysqli_stmt_execute($stmt)) {
                            $response['status'] = 1;
                            $response['message'] = 'Successfully registered';
                        } else {
                            $response['message'] = 'Error in database operation: ' . mysqli_error($con);
                        }

                        mysqli_stmt_close($stmt);
                    }

                    mysqli_stmt_close($checkStmt);
                }
            }
        }
    } 
    else{
        $response['message'] = 'Empty';
        $errorEmpty = true;

    }
}

echo json_encode($response);
?>
