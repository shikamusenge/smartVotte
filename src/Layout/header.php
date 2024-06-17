<?php
session_start();
function renderHeader($title, $page, $user,$navs) {
    if(!isset($_SESSION['USER_ROLE'])){
        echo "<script>alert('Authentication Required !'); location.href='../index.php'</script>";
        exit;
    }
    if($_SESSION['USER_ROLE']!=$user){
        echo "<script>alert('UnAuthrolized !'); location.href='../'</script>";
        exit;
    }
   ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= $title?></title>
        <link rel="stylesheet" href="../../src/assets/css/main.css">
        
    </head>
    <body>
    <nav>
       <div class="brand">SMART<span style="color: green">ONLINE</span>  VOTE</div>
        <ul>
            <?php foreach ($navs as $nav) {
                if ($nav['text'] == $page) {
                    echo "<li class='active'><a  href='".$nav['href']."'>".$nav['text']."</a>";;
                }else{
                        echo "<li><a href='".$nav['href']."'>".$nav['text']."</a>";
                    }
            }?>
            <li><a href="../changePassword.php">change Password</a></li>
            <li><a href="../logout.php" class='btn' style="background-color:green; padding-block:0.3rem; color:white">Logout</a></li>
        </ul>
    </nav>
    <?php
}
?>