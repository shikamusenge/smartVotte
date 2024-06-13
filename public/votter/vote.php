<?php
include_once "../../src/layout/header.php";
include_once "../../src/controller/VoterController.php";
if(!isset($_GET['action'])){
    header("location:./");
}
$voteCtl = new VoterController();
$candidates = $voteCtl->getPostsCandidates($_GET['postid']);
$title="Vote ";
$page="Home";
$user="votter";
$navs=[["text"=>"Home","href"=>"index.php"],["text"=>"Vote","href"=>"vote.php"]];

$navBar =  renderHeader("$title", $page, $user, $navs);
echo $navBar;
?>
<section class='main-section'>

 <h3 style='margin-bottom:0.5rem'>/<a href='./index.php'>Posts</a>/votte</h3>
 <div id="candidate-container">
 <?php
 foreach($candidates as $candidate){
    ?>
<div class='candidate-card'>
            <div class='image'><img src="../../uploads/<?=$candidate['image']?>"></div>
            <div class='content'>
            <div><?=$candidate['first_name']?> <?=$candidate['last_name']?></div>
            <div><?=$candidate['dob']?></div>
            <div><?=$candidate['party']?></div>
            <div><?=$candidate['status']?></div>
            <div class='btn'><a href="vote_action.php?candId=<?=$candidate['candidate_id']?>&postId=<?=$_GET['postid']?>" onClick='return confirm("Are you sure you want to vote <?=$candidate['first_name']?> <?=$candidate['last_name']?>")'>Vote</a></div>
 </div>
 </div>
    <?php }?>
</div>
</section>
<style>
.candidate-card {
  display: flex;
  background-color: white;
  width: 400px;
  border-radius: 5px;
  margin:5px;
}
#candidate-container {
  display: flex;
  gap: 0.4rem;
}

.candidate-card .image {
  max-width: 40%;
  display: flex;
  justify-content: center;
  overflow: hidden;
border-radius: 5px;
}
.candidate-card .image img {
  max-width: 170px;
  width: 170px;
  overflow: hidden;
}
.candidate-card .content{
    padding: 0.4rem;
    position: relative; 
    display:flex;
    justify-content:center;
    flex-direction:column;
}
.candidate-card .content .btn{
    background-color:green;
    color:white;
    position: absolute;
    right:0;
    bottom:0;
    margin-bottom:-.5rem; 
    padding-inline:1rem;
}
.candidate-card .content .btn a{
    color:white;
    text-decoration:none;
}
.candidate-card:hover{
    translate:ratio(1:2);
    box-shadow: 4px 4px lightgreen;
}
</style>