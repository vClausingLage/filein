<!DOCTYPE html>
<html lang="en-us">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel='stylesheet' href='../index.css'>
  <link rel='stylesheet' href='../header-footer.css'>
  <script src="chart.js"></script>
  <title>Sexuality in Antiquity</title>
</head>

<body>

  <?php include '../components/header.php' ?>

  <h1>Data Logger</h1>
  <h2>for Chariton</h2>

  <div style="width:50%;margin:auto">
  <canvas id="dataChart" ></canvas>
  </div>

  <?php
  // data file
  $text = file_get_contents('chariton.txt');
  $text = json_decode($text);

  // $string = 'ἐράω ἐρᾷς ἐρᾷ ἐρῶμεν ἐρᾶτε ἐρῶσῐ ἐρῶσῐν ἤραον 	ἤραες  ἤραε	ἤραεν 	ἠράετον 	ἠραέτην 	ἠράομεν 	ἠράετε 	ἤραον ἤρασα 	ἤρασας  ἤρασε	ἤρασεν 	ἠράσατον 	ἠρασάτην 	ἠράσαμεν 	ἠράσατε 	ἤρασαν ἠρασάμην 	ἠράσω 	ἠράσατο 	ἠράσασθον 	ἠρασάσθην 	ἠρασάμεθα 	ἠράσασθε 	ἠράσαντο ἠρᾱ́θην 	ἠρᾱ́θης 	ἠρᾱ́θη 	ἠρᾱ́θητον 	ἠρᾱθήτην 	ἠρᾱ́θημεν 	ἠρᾱ́θητε 	ἠρᾱ́θησᾰν';
  $string = 'ἐνδιέτριβε ἀνδρὸς ἐρῶμεν';

  $terms = [];
  // push search terms
  function pushTerms($terms, $string)
  {
    // remove redundant white space
    $string = trim($string);
    $string = preg_replace('/\s+/', '|', $string);
    // string to array
    $terms = explode('|', $string);
    return $terms;
  }
  $terms = pushTerms($terms, $string);
  $bookCount = count($text);

  echo 'This text conatins ' . $bookCount . ' books. <br>';

  // search algorithm
  function searchText($text, $terms, $sum)
  {
    $sum = 0;
    for ($i = 0; $i < count($text); $i++) {
      for ($j = 0; $j < count($text[$i]); $j++) {
        for ($k = 0; $k < count($text[$i][$j]); $k++) {
          foreach ($terms as $term) {
            $sum += preg_match_all('/' . $term . '/', $text[$i][$j][$k]);
          }
        }
      }
    }
    return $sum;
  }
  $sum = searchText($text, $terms, $sum);
  echo 'total occurrences of search terms: ' . $sum . '<br>';

  function getDistribution($text, $terms, $distribution)
  {
    $distribution = [];
    for ($i = 0; $i < count($text); $i++) {
      for ($j = 0; $j < count($text[$i]); $j++) {
        for ($k = 0; $k < count($text[$i][$j]); $k++) {
          foreach($terms as $term) {
            if (preg_match_all('/' . $term . '/', $text[$i][$j][$k]) > 0) {
              $count = preg_match_all('/' . $term . '/', $text[$i][$j][$k]);
              array_push($distribution, [$i + 1, $j + 1, $k + 1, $count]);
            }
          }
        }
      }
    }
    return $distribution;
  }
  $distribution_array = getDistribution($text, $terms, $distribution);

  // Books Chapters Paragraphs
  // only BOOKS and CHAPTERS! 
  // output to ARRAY
  function getDistributionData($text, $terms, $distribution) {
    $distribution = [];
    for ($i = 0; $i < count($text); $i++) {
      for ($j = 0; $j < count($text[$i]); $j++) {
        for ($k = 0; $k < count($text[$i][$j]); $k++) {
          foreach($terms as $term) {
            if (preg_match_all('/' . $term . '/', $text[$i][$j][$k]) > 0) {
              $count = preg_match_all('/' . $term . '/', $text[$i][$j][$k]);
              array_push($distribution, [$i + 1, $j + 1, $count]);
            }
          }
        }
      }
    }
    return $distribution;
  }
  $distributionData = getDistributionData($text, $terms, $distribution);
  ?>

  <?php include '../components/footer.php' ?>

<script>
  // data
  let data = '<?php echo json_encode($distribution_array); ?>'
  data = JSON.parse(data)
  let bookCount = '<?php echo json_encode($bookCount); ?>'
  // generate Labels
  function generateLabels(data) {
    let books = []
    let results = []
    // reduce books (data[i][3])
    data.map((el, index) => {
      index = el[0] - 1
      if (el[3] > 0) {
      results[index] = el[3]
      } else {
        results[index] = 0
      }
    })
    console.log(data)
    console.log(results)
    for (i = 0; i < bookCount; i++) {
      books.push(['Book ' + (i + 1)])
    }
    return [books, results]
  }
  [books, results] = generateLabels(data);
  // chartJS
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
                beginAtZero: true,
                ticks: {
                  stepSize: 1
                }
            }   
        },
        plugins: {
          title: {
            display: true,
            text: 'Titel'
          }
        }
    }
});
// stacked bar chart
// https://www.chartjs.org/docs/latest/samples/bar/stacked.html
</script>

</body>

</html>