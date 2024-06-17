<?php
include_once "../../src/layout/header.php";
include_once "../../src/controller/postController.php";
$title="Posts";
$page="Posts";
$user="admin";
$navs=[["text"=>"Dashboard","href"=>"dashboard.php"],
["text"=>"Candidates","href"=>"candidate.php"],
["text"=>"Posts","href"=>"posts.php"],
["text"=>"Reports","href"=>"report.php"],
["text"=>"votters","href"=>"votters.php"],

];

$navBar =  renderHeader($title, $page, $user, $navs);
echo $navBar;
$postCtl = new PostController();
$posts = $postCtl->getAllPosts();

if(isset($_GET['action'])){
    $id=$_GET['id'];
    if($_GET['action']=='Launch'){
       if($postCtl->setPostReady($id)){
        echo"<script>alert('post is now in votting mode'); location.href='posts.php'</script>";
       } 
    }
     if($_GET['action']=='close'){
       if($postCtl->closePost($id)){
        echo"<script>alert('votting mode closed!'); location.href='posts.php'</script>";
       } 
    }
}

?>

<section class='main-section'>
 <div class='sub_header'>
     <h3 style='margin-bottom:0.5rem'>/Posts</h3>
    <div class="div"><a href="./add_post.php" class="btn">Add New Post</a></div>   
    </div>
 <table border='1'>
    <tr>
        <th>No</th>
        <th>Title</th>
        <th>Description</th>
        <th>candidates</th>
        <th>date</th>
        <th>status</th>
        <th colspan='3'>Action</th>
    </tr>
 <?php
 $no=0;
 if(count($posts)==0){
    echo "<tr><td colspan='7' style='text-align:center;padding:2rem;'>No post added Click <a href='add_post.php' class='btn'> here </a> to add new</td></tr>";
 }
 foreach($posts as $post){
    $no++;
    $id=$post['post_id'];
    $statusAction=$post['p_status']=='onhold'?"Launch":"close";
    ?>
<tr>
<td><?=$no?></td>
<td><?=$post['title']?></td>
<td style='max-width:250px'><?=$post['Description']?></td>
<td><?=$post['total']?></td>
<td><?=$post['date']?></td>
<td><?=$post['p_status']?></td>
<td> 
    <a href="posts.php?action=<?=$statusAction?>&id=<?=$id?>" class='btn btn-approve'><?=$statusAction?></a>
    <a href="edite_post.php?action=reject&id=<?=$id?>" class='btn btn-edit'>edit</a>
    <a href="posts.php?action=delete&id=<?=$id?>" class='btn btn-reject'>Delete</a>
</td>
</tr>
    <?php }?>
</table>
</section>