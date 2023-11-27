<?php
session_start();
if(isset($_SESSION['email'])){
    $email=$_SESSION['email'];
}
else if(isset($_COOKIE['email']) || isset($_COOKIE['password'])){
    $email = $_COOKIE['email'];
}
define('BASE_URL', 'http://localhost/GUVI/');
define('UPLOADS_DIR', 'C:/xampp/htdocs/GUVI/uploads/');

$query = "SELECT * FROM registration WHERE email = ?";
$stmt = mysqli_prepare($con, $query);

if ($stmt) {
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    // Fetch the data
    while ($fetch = mysqli_fetch_assoc($result)) {
        $firstname=$fetch['firstname'];
        $lastname=$fetch['lastname'];
        $email=$fetch['email'];
        $password=$fetch['password'];
        $image = BASE_URL . 'uploads/' . $fetch['image'];


        $_SESSION['firstname'] = $firstname;
        $_SESSION['lastname'] = $lastname;
        $_SESSION['email'] = $email;
        $_SESSION['password'] = $password;
        $_SESSION['image'] = $image;
        mysqli_stmt_close($stmt);


    } 
}

?>