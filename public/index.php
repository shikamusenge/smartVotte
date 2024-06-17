<?php
// Start the session
session_start();
// Include the database configuration file
require_once '../src/controller/userController.php';
// If the user is already logged in, redirect to the dashboard
if (isset($_SESSION['user_id'])) {
    $page=$_SESSION['USER_ROLE']=='admin'?'admins':'votter';
    $address="Location:../public/".$page."/";
    header($address);
    exit;
}
if($_POST){
$client=new User();
$user=["email"=>$_POST['email'],"password"=>$_POST['password']];
$loginRequest=$client->login($user);
if($loginRequest['isLogged'] && $loginRequest['status']==1||$loginRequest['isLogged']&&$loginRequest['role']=='admin'){
    $_SESSION['user_id']=$loginRequest['user_id'];
    $_SESSION['USER_ROLE']=$loginRequest['role'];
    $_SESSION['account_id']=$loginRequest['account_id'];
    if($loginRequest['role']=='admin'){
    echo "<script>alert('user signed in'); location.href='./admins/dashboard.php'</script>";
}
    if($loginRequest['role']=='votter'){
    echo "<script>alert('user signed in'); location.href='./votter/'</script>";}
       }
if($loginRequest['isLogged']&&$loginRequest['status']==0){
    echo "<script>alert('Acount waiting for admin approval'); location.href='./approvapage.php'</script>";
}
else{
    echo "<script>alert('".$loginRequest['message']."')</script>";
}
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="../src/assets/css/main.css">
</head>
<body>
    <div class="main-section container-centered">
      <div class="form-container" style="width:fit-content">
        <h2 class='form-header'>Login</h2>
          <hr>
        <br>
        <h3>Please fill in your credentials to login.</h3>
      <br>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-input">
                <label>Email</label>
                <input type="text" name="email" class="form-control" value="">
                <span class="help-block"></span>
            </div>
            <div class="form-input">
                <label>Password</label>
                <input type="password" name="password" class="form-control">
                <span class="help-block"></span>
            </div>
            <div class="form-input">
                <button type="submit" class="btn" value="Login">Login</button>
            </div>
            <br>
            <hr>
            <p>Don't have an account? <a href="./votter/register.php">Sign up now</a>.</p>
        </form>
    </div>   
    </div>
   
</body>
</html>
