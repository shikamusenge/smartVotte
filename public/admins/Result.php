
<?php
include_once "../../src/layout/header.php";
include_once "../../src/controller/ReportController.php";
$title="Voting Graph Results";
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

?>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<section class="main-section">
<h2>Voting Results</h2>
<canvas id="votingResultsChart"></canvas>
</section>
<script>
async function fetchVotingData() {
    const response = await fetch('fetch_voting_data.php');
    const data = await response.json();
    return data;
}

function createChart(data) {
    const ctx = document.getElementById('votingResultsChart').getContext('2d');
    const chartData = {
        labels: [],
        datasets: []
    };
    
    const candidates = new Set();
    data.forEach(row => {
        if (!chartData.labels.includes(row.title)) {
            chartData.labels.push(row.title);
        }
        candidates.add(`${row.candidate_first_name} ${row.candidate_last_name}`);
    });

    candidates.forEach(candidate => {
        const dataset = {
            label: candidate,
            data: [],
            backgroundColor: getRandomColor(),
        };
        data.forEach(row => {
            if (`${row.candidate_first_name} ${row.candidate_last_name}` === candidate) {
                dataset.data.push(row.vote_count);
            }
        });
        chartData.datasets.push(dataset);
    });

    new Chart(ctx, {
        type: 'bar',
        data: chartData,
        options: {
            responsive: true,
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Posts'
                    }
                },
                y: {
                    title: {
                        display: true,
                        text: 'Votes'
                    }
                }
            }
        }
    });
}

function getRandomColor() {
    const letters = '0123456789ABCDEF';
    let color = '#';
    for (let i = 0; i < 6; i++) {
        color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
}

(async function() {
    const votingData = await fetchVotingData();
    createChart(votingData);
})();
</script>

</body>
</html>
