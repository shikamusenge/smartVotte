<?php
include_once "../../src/layout/header.php";
include_once "../../src/controller/CandidateController.php";
$title = "Candidates";
$page = "candidates";
$user = "admin";
$navs = [
    ["text" => "Dashboard", "href" => "dashboard.php"],
    ["text" => "Candidates", "href" => "candidate.php"],
    ["text" => "Posts", "href" => "posts.php"],
    ["text" => "Reports", "href" => "report.php"],
    ["text" => "Voters", "href" => "voters.php"],
];

$navBar = renderHeader($title, $page, $user, $navs);
echo $navBar;
$CandidateCtl = new CandidateController();
$candidates = $CandidateCtl->getAllCandidates(10, 0); // Example with limit 10 and offset 0

if (isset($_GET['action'])) {
    $id = $_GET['cid'];
    if ($_GET['action'] == 'delete') {
        if ($CandidateCtl->deleteCandidate($id)) {
            echo "<script>alert('Candidate deleted'); location.href='candidate.php'</script>";
        }
    }
    if ($_GET['action'] == 'reject') {
        if ($CandidateCtl->rejectCandidate($id)) {
            echo "<script>alert('Candidate rejected!'); location.href='candidate.php'</script>";
        }
    }
}


// pagination variables
$limit = 4; // number of records per page
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $limit;
$candidates = $CandidateCtl->getAllCandidates($limit, $offset); 
$totalCandidate=$CandidateCtl->getTotalCandidate();
?>

<section class='main-section dat-section'>
    <div class='sub_header'>
     <h3 style='margin-bottom:0.5rem'>Candidates</h3>
    <div class="div"><a href="./candidate_register.php" class="btn">Add Candidate</a></div>   
    </div>
    
    <table border='1'>
        <tr>
            <th>No</th>
            <th>image</th>
            <th>Names</th>
            <th>Date of Birth</th>
            <th>National Identity Card</th>
            <th>Party</th>
            <th>Post</th>
            <th colspan='2'>Action</th>
        </tr>
        <?php
        $no = 0;
        foreach ($candidates as $candidate) {
            $no++;
            $id = $candidate['candidate_id'];
        ?>
        <tr>
            <td><?=$no?></td>
            <td><img src="../../uploads/<?=$candidate['image']?>" style='width:65px'></td>
            <td><?=$candidate['first_name']?> <?=$candidate['last_name']?></td>
            <td><?=$candidate['dob']?></td>
            <td><?=$candidate['nid']?></td>
            <td><?=$candidate['party']?></td>
            <td><?=$candidate['post']?></td>
            <td><?=$candidate['status']?></td>
            <td> 
                <a href="update_candidate.php?cid=<?=$id?>" class='btn btn-approve'>UPDATE</a>
                <a href="candidate.php?action=delete&cid=<?=$id?>" class='btn btn-reject'>DELETE</a>
            </td>
        </tr>
        <?php } ?>
    </table>
    <div class="pagnation">
     <?php
for($i=1;$i<=ceil($totalCandidate/$limit);$i++){
  echo "<a href='candidate.php?page=".$i."' class='btn'>".$i.'</a>';
}
?>   
    </div>


</section>
<style>
.sub_header {
  display: flex;
  justify-items: center;
  justify-content: space-between;
}
.sub_header .btn{
    background-color: green;
    color: white;
}
.pagination{
 position: absolute; 
bottom: 0;
}
.data-section{
    min-height:90vh;
    background-color:black;
}
</style>