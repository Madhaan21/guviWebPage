<?php
session_start();

require_once 'C:/xampp/htdocs/GUVI/vendor/autoload.php'; 

$mongoClient = new MongoDB\Client("mongodb://localhost:27017");
$database = $mongoClient->guvi;
$collection = $database->users;

$userId = $_SESSION['user_id'];

$userData = $collection->findOne(["_id" => new MongoDB\BSON\ObjectID($userId)]);

// Display user profile data
echo "<h2>Updated Profile</h2>";
echo "<p><strong>Age:</strong> " . $userData['age'] . "</p>";
echo "<p><strong>DOB:</strong> " . $userData['dob'] . "</p>";
echo "<p><strong>Email:</strong> " . $userData['email'] . "</p>";
echo "<p><strong>Contact:</strong> " . $userData['contact'] . "</p>";
?>
