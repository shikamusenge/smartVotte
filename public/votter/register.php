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
        <button type="submit" name="save_votter">Signup</button>
    </div>
    </div>
</form>
</div>
</section>
</body>
</html>