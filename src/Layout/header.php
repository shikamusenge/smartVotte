<?php
function renderHeader($title, $page, $user,$navs) {
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
        <div class='brand'><span style='color:green'>SMART</span> VOTE</div>
        <ul>
            <?php foreach ($navs as $nav) {
                if ($nav['text'] == $page) {
                    echo "<li class='active'><a  href='".$nav['href']."'>".$nav['text']."</a>";;
                }else{
                        echo "<li><a href='".$nav['href']."'>".$nav['text']."</a>";
                    }
            }?>
            <li><a href="../changePassword.php">change Password</a></li>
            <li><a href="../logout.php" class='btn'>Logout</a></li>
        </ul>
    </nav>
    <?php
}

?>