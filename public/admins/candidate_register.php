<?php
include_once "../../src/layout/header.php";
include_once "../../src/controller/candidateController.php";
include_once "../../src/controller/postController.php";
include_once "../../src/utils/Validator.php";

$title="@Candidate";
$page="Candite";
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
$candidateCtl = new CandidateController();
$postCtl = new PostController();
$posts = $postCtl->getAllPosts();
$activeposts = $postCtl->getActivePosts();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include_once "../../config/database.php";

    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $dob = $_POST['dob'];
    $nid = $_POST['nid'];
    $party = $_POST['party'];
    $post = $_POST['post'];
    $image = $_FILES['image']['name'];

    // Handle file upload
    $target_dir = "../../uploads/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

    try {
       $newCandidate=["fname"=>$firstName,"lname"=>$lastName,"nid"=>$nid,"party"=>$party,"post"=>$post,"image"=>$image,"dob"=>$dob];
       if($candidateCtl->addCandidate($newCandidate)){
        echo "<script>alert('Candidate Added Successfully')</script>";
       }
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    $conn = null;
}
?>
    <div class='main-section sub_header'>
     <h3 style='margin-bottom:0.5rem'>/<a href="candidate.php">Candidates/</a>add</h3>
    <div class="div"><a href="./candidate.php" class="btn">View Candidate</a></div>   
    </div>
<section class="main-section container-centered">

<div class="form-container" style='width:500px'>
        <h2 class='form-header'>Candidate Registration Form</h2>
<form action="candidate_register.php" method="post" enctype="multipart/form-data">
    <div class="form-input">
    <label for="first_name">First Name:</label>
    <input type="text" id="first_name" name="first_name" required>
</div><div class="form-input">
    <label for="last_name">Last Name:</label>
    <input type="text" id="last_name" name="last_name" required>
</div><div class="form-input">
    <label for="dob">Date of Birth:</label>
    <input type="date" id="dob" name="dob" required>
</div><div class="form-input">
    <label for="nid">National ID:</label>
    <input type="text" id="nid" name="nid" required>
</div><div class="form-input">
    <label for="party">Party:</label>
    <input type="text" id="party" name="party" required>
</div><div class="form-input">
    <label for="post">Post:</label>
    <select id="post" name="post" required>
        <option value="" selected disabled>Choose Post</option>
        <?php
         foreach($activeposts as $post){
            $id=$post['post_id'];
            echo "<option value='$id'>".$post['title']."</option>";
         }
        ?>
    </select>
</div><div class="form-input">
    <label for="image">Image:</label>
    <input type="file" id="image" name="image" required>
</div><div class="form-input">
    <button type="submit">Register</button>
</form>
</div>
</section>