<?php
    include_once "../../src/layout/header.php";
    include_once "../../src/controller/candidateController.php";
    include_once "../../src/controller/postController.php";
    include_once "../../src/utils/Validator.php";
if(!isset($_GET['cid'])){
    header("locathion:dashboard.php");
}
$id=$_GET['cid'];

$title="@Candidate Update";
$page="Candite";
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
$candidateCtl = new CandidateController();
$postCtl = new PostController();
$posts = $postCtl->getAllPosts();
$data=$candidateCtl->getCandidate($id);
$activeposts = $postCtl->getActivePosts();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include_once "../../config/database.php";

    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $dob = $_POST['dob'];
    $nid = $_POST['nid'];
    $party = $_POST['party'];
    $post = $_POST['post'];
    $candidate_id=$_POST['id'];
    try {
       $newCandidate=["id"=> $candidate_id,"fname"=>$firstName,"lname"=>$lastName,"nid"=>$nid,"party"=>$party,"post"=>$post,"dob"=>$dob];
       if($candidateCtl->updateCandidate($candidate_id,$newCandidate)){
        echo "<script>alert('Candidate updated Successfully'); location.href='candidate.php'</script>";
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
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
    <input type="hidden" name='id' value="<?=$data['candidate_id']?>">
    <div class="form-input">
    <label for="first_name">First Name:</label>
    <input type="text" id="first_name" name="first_name" value="<?=$data['first_name']?>" required>
</div><div class="form-input">
    <label for="last_name">Last Name:</label>
    <input type="text" id="last_name" name="last_name" value="<?=$data['last_name']?>"  required>
</div><div class="form-input">
    <label for="dob">Date of Birth:</label>
    <input type="date" id="dob" name="dob" value="<?=$data['dob']?>"  required>
</div><div class="form-input">
    <label for="nid">National ID:</label>
    <input type="text" id="nid" name="nid" value="<?=$data['nid']?>"  required>
</div><div class="form-input">
    <label for="party">Party:</label>
    <input type="text" id="party" name="party" value="<?=$data['party']?>"  required>
</div><div class="form-input">
    <label for="post">Post:</label>
    <select id="post" name="post" required>
        <option value="" selected disabled>Choose Post</option>
        <?php
         foreach($activeposts as $post){
            if($post['post_id']==$data['post_id'])
            echo "<option value='".$post['post_id']."' selected>".$post['title']."</option>";
        else
           echo "<option value='".$post['post_id']."'>".$post['title']."</option>";
         }
        ?>
    </select>
</div>
<div class="form-input">
    <button type="submit">Save</button>
</div>
</form>
</section>