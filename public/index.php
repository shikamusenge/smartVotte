<?php
// Start the session
session_start();
// Include the database configuration file
require_once '../src/controller/userController.php';
// If the user is already logged in, redirect to the dashboard
if (isset($_SESSION['user_id'])) {
    $address="Location:../public/".$_SESSION['USER_ROLE']."/";
    header($address);
    exit;
}
if($_POST){
$client=new User();
$user=["email"=>$_POST['email'],"password"=>$_POST['password']];
$loginRequest=$client->login($user);
if($loginRequest['isLogged']){
    $_SESSION['user_id']=$loginRequest['user_id'];
    $_SESSION['USER_ROLE']=$loginRequest['role'];
    $_SESSION['account_id']=$loginRequest['account_id'];
    if($loginRequest['role']=='admin'){
    echo "<script>alert('user signed in'); location.href='./admin/dashboard.php'</script>";
}
    if($loginRequest['role']=='votter'){
    echo "<script>alert('user signed in'); location.href='./votter/'</script>";}
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
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="wrapper">
        <h2>Login</h2>
        <p>Please fill in your credentials to login.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Email</label>
                <input type="text" name="email" class="form-control" value="">
                <span class="help-block"></span>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control">
                <span class="help-block"></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
            <p>Don't have an account? <a href="./votter/register.php">Sign up now</a>.</p>
        </form>
    </div>
</body>
</html>
