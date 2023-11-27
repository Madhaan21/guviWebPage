<?php
session_start();

require_once 'C:/xampp/htdocs/GUVI/vendor/autoload.php'; 

$mongoClient = new MongoDB\Client("mongodb://localhost:27017");
$database = $mongoClient->guvi;
$collection = $database->users;

$userId = $_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $age = $_POST["age"];
    $dob = $_POST["dob"];
    $email = $_POST["email"];
    $contact = $_POST["contact"];

    

    $result = $collection->insertOne([
        "_id" => new MongoDB\BSON\ObjectID($userId),
        "age" => $age,
        "dob" => $dob,
        "email" => $email,
        "contact" => $contact,
        
    ]);

    if ($result->getInsertedCount() > 0) {
        echo 'success';
    } else {
        echo 'error: Failed to insert document.';
    }
}
?>
