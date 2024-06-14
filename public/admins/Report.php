
<?php
include_once "../../src/layout/header.php";
include_once "../../src/controller/ReportController.php";
$title="Voting Results";
$page="Reports";
$user="admin";
$navs=[["text"=>"Dashboard","href"=>"dashboard.php"],
["text"=>"Candidates","href"=>"candidate.php"],
["text"=>"Posts","href"=>"posts.php"],
["text"=>"Reports","href"=>"report.php"],
["text"=>"votters","href"=>"votters.php"],

];

$navBar =  renderHeader($title, $page, $user, $navs);
echo $navBar;
$ReportCtl = new ReportController();
$results = $ReportCtl->getPostsData();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Voting Results</title>
    <style>
        table {
            width: 90vw;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
    </style>
</head>
<body>

    
    <section class="main-section">
    <h2>Voting Results</h2> <div> <a href="./Result.php">View Graph</a></div>
    <table>
    <thead>
        <tr>
            <th>Post ID</th>
            <th>Title</th>
            <th>Description</th>
            <th>Date</th>
            <th>Status</th>
            <th>Candidate</th>
            <th>Votes</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($results as $row) { ?>
            <tr>
                <td><?php echo htmlspecialchars($row['post_id']); ?></td>
                <td><?php echo htmlspecialchars($row['title']); ?></td>
                <td><?php echo htmlspecialchars($row['Description']); ?></td>
                <td><?php echo htmlspecialchars($row['date']); ?></td>
                <td><?php echo htmlspecialchars($row['status']); ?></td>
                <td><?php echo htmlspecialchars($row['candidate_first_name'] . ' ' . $row['candidate_last_name']); ?></td>
                <td><?php echo htmlspecialchars($row['vote_count']); ?></td>
            </tr>
        <?php } ?>
    </tbody></table>
</section>

</body>
</html>
