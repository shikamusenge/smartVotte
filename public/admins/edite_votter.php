<?php
include_once "../../src/layout/header.php";
include_once "../../src/controller/VoterController.php";
$title = "CUpdate Votter";
$page = "Voters";
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
$voterCtl = new VoterController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'first_name' => $_POST['first_name'],
        'last_name' => $_POST['last_name'],
        'dob' => $_POST['dob'],
        'nid' => $_POST['nid'],
        'phoneNumber' => $_POST['phoneNumber'],
        "votter_id" =>$_POST['votter_id']
    ];
    $voterCtl->updateVoter($data);
    header('Location: votters.php');
}

$voter = $voterCtl->getSingleVoter($_GET['votter_id']);
?>

<section class="main-section container-centered">
    <div class="form-container" style="width:400px; max-width:98vw;">
        <h2 class="form-header">Update Voter</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <input type="hidden" name="votter_id" value="<?= $voter['votter_id'] ?>">
            <div class="form-input">
                <label for="first_name">First Name:</label>
                <input type="text" class="form-control" id="first_name" name="first_name" value="<?= $voter['first_name'] ?>" required>
            </div>
            <div class="form-input">
                <label for="last_name">Last Name:</label>
                <input type="text" class="form-control" id="last_name" name="last_name" value="<?= $voter['last_name'] ?>" required>
            </div>
            <div class="form-input">
                <label for="dob">Date of Birth:</label>
                <input type="date" class="form-control" id="dob" name="dob" value="<?= $voter['dob'] ?>" required>
            </div>
            <div class="form-input">
                <label for="nid">National Identity Card:</label>
                <input type="text" class="form-control" id="nid" name="nid" value="<?= $voter['nid'] ?>" required>
            </div>
            <div class="form-input">
                <label for="phoneNumber">Phone Number:</label>
                <input type="text" class="form-control" id="phoneNumber" name="phoneNumber" value="<?= $voter['phoneNumber'] ?>" required>
            </div>
            <div class="form-input">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</body>
