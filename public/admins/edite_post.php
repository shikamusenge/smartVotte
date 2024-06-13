<?php
include_once "../../src/layout/header.php";
include_once "../../src/controller/postController.php";
include_once "../../src/utils/Validator.php";

$title="@Posts";
$page="Posts";
$user="admin";
$navs=[["text"=>"Dashboard","href"=>"dashboard.php"],
["text"=>"Candidates","href"=>"candidate.php"],
["text"=>"Posts","href"=>"posts.php"],
["text"=>"Reports","href"=>"reports.php"],
["text"=>"votters","href"=>"votters.php"],

];

$navBar =  renderHeader($title, $page, $user, $navs);
echo $navBar;
$postCtl = new PostController();
$data = $postCtl->getPost($_GET['id']);
$id= $_GET['id'];
if(!isset($_GET['id'])){
    header("Location:posts.php");
}
if(isset($_POST['edit-post'])){
    $title=validateInput($_POST['title']);
    $date=validateInput($_POST['date']);
    $description=validateInput($_POST['description']);

       if($postCtl->editPost($id,$title,$description,$date)){
        echo"<script>alert('post updated successfully'); location.href='posts.php'</script>";
       } 
}

?>

<section class='main-section'>
 <h3 class='paths' style='margin-bottom:0.5rem'>/<a href='posts.php' style='text-decoration:none;'>Posts</a>/add</h3>
 <div class="container-centered">
  <div class="form-container post-form">
    <div class="form-title">update Post</div>
    <form method='post'>
    <div class="form-input">
        <label for="title">title</label>
        <input type="text" id='title' name='title' value="<?=$data['title']?>" required>
    </div>
    <div class="form-input">
        <label for="date">Date</label>
        <input type="text" id='date' name='date' value="<?=$data['date']?>"  required>
    </div>
    <div class="form-input">
        <label for="description">description</label>
        <textarea type="text" id='description' name='description' main='20' required><?=$data['Description']?></textarea>
    </div>
    <div class="form-input">
       <button type="submit" class='btn' name='edit-post'>Save</button>
    </div>
 </form>
</div>  
 </div>

 
</section>