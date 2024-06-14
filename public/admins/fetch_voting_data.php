
<?php
include_once "../../src/controller/ReportController.php";

$ReportCtl = new ReportController();
$results = $ReportCtl->getPostsData();

echo json_encode($results);
?>