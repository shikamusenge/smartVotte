<?php
// Include necessary files
session_start();
require_once '../../src/controller/VoterController.php';
require_once '../../src/controller/UserController.php';
require_once '../../src/utils/Validator.php';
// Create a new instance of the VoterController
$voteCtl = new VoterController();
$User=new User();
// Get the candidates for the post
if(isset($_POST['save_votter'])){
$fname=validateInput($_POST['fname']);
$lname=validateInput($_POST['lname']);
$dob=validateInput($_POST['dob']);
$nid=validateInput($_POST['nid']);
$phone=validateInput($_POST['phone']);
$votter=[
    "fname"=>$fname,
    "lname"=>$lname,
    "dob"=>$dob,
    "nid"=>$nid,
    "phone"=>$phone,
];
$email=validateInput($_POST['email']);
$new_pass=validateInput($_POST['new_pass']);
$conf_pass=validateInput($_POST['conf_pass']);
$account=$voteCtl->register($votter);
$userInfo=["account"=>$account,"email"=>$email,"password"=>$new_pass];
if($User->register($userInfo)){
     echo "<script>alert('Register successfuly'); location.href='../index.php'</script>";

}
}

// Render the main section
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../src/assets/css/main.css">
</head>
<body>
    

<section class='main-section container-centered'>
    <div class="form-container" style="width:400px; max-width:90vw">
        <form method="post">
        <!-- Render the voter registration form here -->
        <?php include_once '../../src/layout/votterRegistrerForm.php'; ?>
        <?php include_once '../../src/layout/userForm.php'; ?>
         <div class="form-input">
        <button type="submit" id='save' name="save_votter">Signup</button>
    </div>
    </div>
</form>
</div>
</section>
</body>
</html>
<script>
// Select elements
const emailInput = document.querySelector('#email');
const newPasswordInput = document.querySelector('#new_pass');
const submitButton = document.querySelector('#save');
const emailMessage = document.querySelector('#email_message');

// Set API URL
const apiUrl = 'verifyEmail.php';

// Disable submit button by default
submitButton.disabled = true;

// Add event listener to email input
emailInput.addEventListener('change', async () => {
  const email = emailInput.value.trim(); // Trim whitespace from input value
  // Create FormData object
  const formData = new FormData();
  formData.append('email', email);

  try {
    // Send request to API
    const response = await fetch(apiUrl, {
      method: 'POST',
      body: formData
    });

    // Parse JSON response
    const data = await response.json();
    if (data.available) {
      emailMessage.textContent = 'Email is valid';
      submitButton.disabled = false;
    } else {
      emailMessage.textContent = 'Email is taken';
      submitButton.disabled = true;
    }
  } catch (error) {
    console.error('Error verifying email:', error);
    emailMessage.textContent = 'Error verifying email';
    submitButton.disabled = true;
  }
});
</script>