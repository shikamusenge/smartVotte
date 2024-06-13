<?php
include_once "../../src/layout/header.php";
include_once "../../src/controller/VoterController.php";
$title="Votters";
$page="votters";
$user="votter";
$navs=[["text"=>"Dashboard","href"=>"dashboard.php"],
["text"=>"Candidates","href"=>"candidate.php"],
["text"=>"Posts","href"=>"posts.php"],
["text"=>"Reports","href"=>"reports.php"],
["text"=>"votters","href"=>"votters.php"],

];

$navBar =  renderHeader($title, $page, $user, $navs);
echo $navBar;
$VotterCtl = new VoterController();
$votters = $VotterCtl->getAllVotters();

if(isset($_GET['action'])){
    $id=$_GET['id'];
    if($_GET['action']=='approve'){
       if($VotterCtl->approveVotter($id)){
        echo"<script>alert('votter aproved'); location.href='votters.php'</script>";
       } 
    }
     if($_GET['action']=='reject'){
       if($VotterCtl->rejectVotter($id)){
        echo"<script>alert('votter rejected!'); location.href='votters.php'</script>";
       } 
    }
}

?>

<section class='main-section'>
 <h3 style='margin-bottom:0.5rem'>/Votters</h3>
 <table border='1'>
    <tr>
        <th>No</th>
        <th>Names</th>
        <th>Date of birth</th>
        <th>National Identity Card</th>
        <th>status</th>
        <th>Phone</th>
        <th colspan='3'>Action</th>
    </tr>
 <?php
 $no=0;
 foreach($votters as $votter){
    $no++;
    $id=$votter['votter_id'];
    ?>
<tr>
<td><?=$no?></td>
<td><?=$votter['first_name']?> <?=$votter['last_name']?></td>
<td><?=$votter['dob']?></td>
<td><?=$votter['nid']?></td>
<td><?=$votter['status']?></td>
<td><?=$votter['phoneNumber']?></td>
<?php if($votter['status']=='waiting'){ ?>
<td> 
    <a href="votters.php?action=approve&id=<?=$id?>" class='btn btn-approve'>approve</a>
    <a href="votters.php?action=reject&id=<?=$id?>" class='btn btn-reject'>Reject</a>
</td>
<?php
}
?>
</tr>
    <?php }?>
</table>
</section>