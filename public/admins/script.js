// Separate the concerns of fetching data and creating the chart
async function fetchData(url) {
  try {
    const response = await fetch(url);
    if (!response.ok) {
      throw new Error(`Error fetching data: ${response.status}`);
    }
    return response.json();
  } catch (error) {
    console.error(error);
    return [];
  }
}

function createChart(data, chartElementId) {
  const ctx = document.getElementById(chartElementId).getContext("2d");
  const chartData = {
    labels: data.map((post) => post.title),
    datasets: [
      {
        label: "Number of Votes",
        data: data.map((post) => post.vote_count),
        backgroundColor: "rgba(75, 192, 192, 0.2)",
        borderColor: "rgba(75, 192, 192, 1)",
        borderWidth: 1,
      },
    ],
  };

  new Chart(ctx, {
    type: "bar",
    data: chartData,
    options: {
      scales: {
        y: {
          beginAtZero: true,
        },
      },
      legend: {
        display: false, // hide legend
      },
      title: {
        display: true,
        text: "Posts with Vote Counts",
        fontSize: 18,
        fontColor: "#333",
      },
      layout: {
        padding: {
          left: 10,
          right: 10,
          top: 20,
          bottom: 10,
        },
      },
    },
  });
}

// Use an immediately invoked async function to fetch data and create the chart
(async () => {
  try {
    const data = await fetchData("fetch_voting_data.php");
    createChart(data, "postsChart");
  } catch (error) {
    console.error(error);
  }
})();
