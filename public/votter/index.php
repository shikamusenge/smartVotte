<?php
include_once "../../src/layout/header.php";
$votter=$_SESSION['account_id'];
include_once "../../src/controller/VoterController.php";
$postCtl = new VoterController();
$posts = $postCtl->getPostsDetails($votter);
$title="login success";
$page="Home";
$user="votter";
$navs=[["text"=>"Home","href"=>"index.php"],["text"=>"Vote","href"=>"vote.php"]];

$navBar =  renderHeader("$title", $page, $user, $navs);
echo $navBar;
?>
<section class='main-section'>
 <h3 style='margin-bottom:0.5rem'>/Posts</h3>
 <table border='1'>
    <tr>
        <th>No</th>
        <th>Title</th>
        <th>Description</th>
        <th>candidates</th>
        <th>status</th>
        <th colspan='3'>Action</th>
    </tr>
 <?php
 $no=0;
 if(count($posts)==0){
    echo "<tr><td colspan='7' style='text-align:center;padding:2rem;'>No post Which is ready If Avilable will be desiplayede here</tr>";
 }
 foreach($posts as $post){
    $no++;
    $id=$post['postId'];
    $statusAction=$post['post_status']=='ready'?"Vote now":$post['post_status'];
    ?>
<tr>
<td><?=$no?></td>
<td><?=$post['title']?></td>
<td style='max-width:250px'><?=$post['Description']?></td>
<td><?=$post['total_candidate']?></td>
<td><?=$post['post_status']?></td>
<?php if($id=$post['post_status']=='ready'){
    ?>
    <td> 
    <a href="vote.php?action=<?=$statusAction?>&postid=<?=$post['postId']?>" class='btn btn-approve btn-green' ><?=$statusAction?></a>
</td>
<?php
}
?>
</tr>
    <?php }?>
</table>
</section>