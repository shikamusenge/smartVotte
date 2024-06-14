<?php
include_once "../../src/layout/header.php";
include_once "../../src/controller/VoterController.php";
$title="Votters";
$page="votters";
$user="admin";
$navs=[["text"=>"Dashboard","href"=>"dashboard.php"],
["text"=>"Candidates","href"=>"candidate.php"],
["text"=>"Posts","href"=>"posts.php"],
["text"=>"Reports","href"=>"report.php"],
["text"=>"Voters","href"=>"votters.php"],];

$navBar =  renderHeader($title, $page, $user, $navs);
echo $navBar;
$VotterCtl = new VoterController();

// pagination variables
$limit = 5; // number of records per page
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $limit;

$votters = $VotterCtl->getAllVotters($limit, $offset);

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
        
    if($_GET['action']=='delete'){
       if($VotterCtl->deleteVotter($id)){
        echo"<script>alert('votter deleted!'); location.href='votters.php'</script>";
       }}
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
<td> 
<?php if($votter['status']=='waiting'){ ?>
    <a href="votters.php?action=approve&id=<?=$id?>" class='btn btn-approve'>approve</a>
    <a href="votters.php?action=reject&id=<?=$id?>" class='btn btn-reject'>Reject</a>

<?php
}else{
    ?>
    <a href="votters.php?action=delete&id=<?=$id?>" class='btn btn-approve'>DELETE</a>
    <a href="edite_votter.php?votter_id=<?=$id?>" class='btn btn-reject'>UPDATE</a>
    <?php
}
?>
</td>
</tr>
    <?php }?>
</table>

<!-- pagination links -->
<nav aria-label="Pagination">
  <ul class="pagination">
    <?php 
    for($i=1; $i<=ceil($VotterCtl->getTotalVotters() / $limit); $i++): ?>
    <li class="page-item <?= $i == $page ? 'active' : '' ?>"><a class="page-link" href="votters.php?page=<?= $i ?>"><?= $i ?></a></li>
    <?php endfor; ?>
  </ul>
</nav>

</section>