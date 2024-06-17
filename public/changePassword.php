<?php
session_start();
include_once "../src/controller/userController.php";
if(isset($_POST['ok'])){
$userId=$_SESSION['user_id'];
$oldPass=$_POST['oldPassword'];
$newPass=$_POST['newPassword'];
$User=new User();
$res=$User->changePassword($userId,$newPass,$oldPass);
if($res['success']){
    echo "<script>alert('password changed Successfully'); location.href='index.php'</script>";
}else{
       echo "<script>alert('provide valid old password');</script>";

}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link rel="stylesheet" href="../src/assets/css/main.css">
</head>
<body>
    
<div class="main-section">
    <div class="container-centered">
        <div class="form-container" style="width:400px; max-width:90vw;">
            <form method="post" action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>'>
            <h2 class="form-header">RESET PASSWORD</h2>
            <div class="form-input">
                <label for="oldPassword">Old Password</label>
                <input type="password" name="oldPassword">
            </div>
            <div class="form-input">
                <label for="newPassword">New Password</label>
                <input type="password" name="newPassword" id="newPassword">
            </div>
            <div class="form-input">
                <label for="confirmPassword">old Password</label>
                <input type="password" name="confirmPassword" id="confirmPassword" disabled>
            </div>
            <div class="form-input">
                <input type="submit" name="ok" id="save-btn" disabled>
            </div></form>
        </div>
    </div>
</div>
</body>
</html>
<script>
  const newPassField = document.querySelector("#newPassword");
  const confirmPassField = document.querySelector("#confirmPassword");
  const saveBtn=document.getElementById("save-btn");
 newPassField.addEventListener("keyup",()=>{
    confirmPassField.value="";
    const fieldValue=newPassField.value;
    if(fieldValue.length>=8){
        confirmPassField.disabled=false;
    }else{
        confirmPassField.disabled=true;
    }
 })
confirmPassField.addEventListener("keyup",()=>{
    const newPass=newPassField.value;
    const confPass=confirmPassField.value;
    if(newPass===confPass){
        confirmPassField.disabled=false;
        saveBtn.disabled=false;
    }else{
       saveBtn.disabled=true; 
    }
 })

</script>



