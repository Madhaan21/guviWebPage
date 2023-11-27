<?php

require_once 'C:/xampp/htdocs/GUVI/vendor/autoload.php'; 

$mongoClient = new MongoDB\Client("mongodb://localhost:27017");
$database = $mongoClient->guvi;
$collection = $database->users;


session_start();

$userId = $_SESSION['user_id'];

// Fetch user data based on the user ID
$userData = $collection->findOne(["_id" => new MongoDB\BSON\ObjectID($userId)]);

// Return user data as JSON
header('Content-Type: application/json');
echo json_encode($userData);

?>