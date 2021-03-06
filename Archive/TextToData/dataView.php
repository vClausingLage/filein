<!DOCTYPE html>
<html lang="en-us">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="chart.js"></script>
  <title>Data Viewer</title>
</head>
<body>

<div class="container">

<h1>View the Data</h1>

<p>The dataset contains <span id="total"></span> total hits for the search field.</p>

<div style="width:80%;margin:auto">
  <canvas id="dataChart" ></canvas>
</div>

<?php
$data = file_get_contents('data.json');
$data = json_decode($data);
?>

</div>

<script>
let books = []
let results = []
let data = '<?php echo json_encode($data); ?>'
data = JSON.parse(data)
document.getElementById('total').innerHTML = data.total
function createLabels({distribution}) {
  for (let i = 0; i < distribution.length; i++) {
    books.push('Book ' + (i + 1))
    results.push(distribution[i][1] / distribution[i][2])
  }
}
createLabels(data)
let ctx = document.getElementById('dataChart').getContext('2d');
let myChart = new Chart(ctx, {
  type: 'bar',
  data: {
      labels: books,
      datasets: [{
          label: 'Results',
          data: results,
          borderWidth: 1
      }]
  },
  options: {
      scales: {
          x: {
            display: true
          },
          y: {
              beginAtZero: true//,
              //ticks: {
              //  stepSize: 1
              //}
          }   
      },
      plugins: {
        title: {
          display: true,
          text: 'distribution of word field'
        }
      }
  }
});
// stacked bar chart
// https://www.chartjs.org/docs/latest/samples/bar/stacked.html
</script>
</body>
</html>