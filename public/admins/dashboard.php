<?php
include_once "../../src/layout/header.php";
$title="login success";
$page="Dashboard";
$user="votter";
$navs=[["text"=>"Dashboard","href"=>"dashboard.php"],
["text"=>"Candidates","href"=>"candidate.php"],
["text"=>"Posts","href"=>"posts.php"],
["text"=>"Reports","href"=>"reports.php"],
["text"=>"votters","href"=>"votters.php"],

];

$navBar =  renderHeader($title, $page, $user, $navs);
echo $navBar;

?>