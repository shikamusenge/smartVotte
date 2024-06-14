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
["text"=>"Reports","href"=>"report.php"],
["text"=>"votters","href"=>"votters.php"],

];

$navBar =  renderHeader($title, $page, $user, $navs);
echo $navBar;
$postCtl = new PostController();
$posts = $postCtl->getAllPosts();

if(isset($_POST['add-post'])){
    $title=validateInput($_POST['title']);
    $date=validateInput($_POST['date']);
    $description=validateInput($_POST['description']);

       if($postCtl->registerPost($title,$description,$date)){
        echo"<script>alert('post added successfully'); location.href='posts.php'</script>";
       } 
}

?>

<section class='main-section'>
 <h3 class='paths' style='margin-bottom:0.5rem'>/<a href='posts.php' style='text-decoration:none;'>Posts</a>/add</h3>
 <div class="container-centered">
  <div class="form-container post-form">
    <div class="form-title">Add new Post</div>
    <form method='post'>
    <div class="form-input">
        <label for="title">title</label>
        <input type="text" id='title' name='title' required>
    </div>
    <div class="form-input">
        <label for="date">Date</label>
        <input type="text" id='date' name='date' required>
    </div>
    <div class="form-input">
        <label for="description">description</label>
        <textarea type="text" id='description' name='description' main='20' required></textarea>
    </div>
    <div class="form-input">
       <button type="submit" class='btn' name='add-post'>Submit</button>
    </div>
 </form>
</div>  
 </div>

 
</section>