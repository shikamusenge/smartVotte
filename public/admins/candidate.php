<?php
include_once "../../src/layout/header.php";
include_once "../../src/controller/CandidateController.php";
$title = "Candidates";
$page = "candidates";
$user = "candidate";
$navs = [
    ["text" => "Dashboard", "href" => "dashboard.php"],
    ["text" => "Candidates", "href" => "candidates.php"],
    ["text" => "Posts", "href" => "posts.php"],
    ["text" => "Reports", "href" => "reports.php"],
    ["text" => "Voters", "href" => "voters.php"],
];

$navBar = renderHeader($title, $page, $user, $navs);
echo $navBar;
$CandidateCtl = new CandidateController();
$candidates = $CandidateCtl->getAllCandidates(10, 0); // Example with limit 10 and offset 0

if (isset($_GET['action'])) {
    $id = $_GET['id'];
    if ($_GET['action'] == 'approve') {
        if ($CandidateCtl->approveCandidate($id)) {
            echo "<script>alert('Candidate approved'); location.href='candidates.php'</script>";
        }
    }
    if ($_GET['action'] == 'reject') {
        if ($CandidateCtl->rejectCandidate($id)) {
            echo "<script>alert('Candidate rejected!'); location.href='candidates.php'</script>";
        }
    }
}

?>

<section class='main-section'>
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
            <th>Status</th>
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
            <?php if ($candidate['status'] == 'waiting') { ?>
            <td> 
                <a href="candidates.php?action=approve&id=<?=$id?>" class='btn btn-approve'>Approve</a>
                <a href="candidates.php?action=reject&id=<?=$id?>" class='btn btn-reject'>Reject</a>
            </td>
            <?php } ?>
        </tr>
        <?php } ?>
    </table>
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
</style>