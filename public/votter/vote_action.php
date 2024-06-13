<?php
session_start();
include_once "../../src/controller/VoterController.php";
if(!isset($_SESSION['account_id']))
{
header("Location:../../");
echo $_SESSION['account_id'];

    exit;
}
    $votter=$_SESSION['account_id'];
    $post=$_GET['postId'];
    $candidate=$_GET['candId'];
$voteCtl = new VoterController();
$voteRequest=$voteCtl->vote($post,$votter,$candidate);
if($voteCtl){
     echo "<script>alert('Vote successfuly'); location.href='./'</script>";
}
?>