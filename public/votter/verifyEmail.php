<?php
require_once '../../src/controller/userController.php';

// Get the email from the POST request
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

// Create a new instance of the user controller
$userCtl = new User(); // Assuming the class name is UserController

// Check if the email exists
$results = $userCtl->emailExists($email);

// Output the results as JSON
header('Content-Type: application/json');
echo json_encode(['available' => !$results]); // Return a JSON object with a single property 'available'
?>