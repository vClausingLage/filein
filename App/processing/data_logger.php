<!DOCTYPE html>
<html lang="en-us">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel='stylesheet' href='../index.css'>
  <link rel='stylesheet' href='../header-footer.css'>
  <title>Sexuality in Antiquity</title>
</head>

<body>

  <?php include '../components/header.php' ?>

  <h1>Data Logger</h1>
  <h2>for Chariton</h2>

  <!-- <div id="chartContainer" style="height: 370px; width: 100%;"></div> -->

  <?php
  // data file
  $text = file_get_contents('chariton.txt');
  $text = json_decode($text);

  // $string = 'ἐράω ἐρᾷς ἐρᾷ ἐρῶμεν ἐρᾶτε ἐρῶσῐ ἐρῶσῐν ἤραον 	ἤραες  ἤραε	ἤραεν 	ἠράετον 	ἠραέτην 	ἠράομεν 	ἠράετε 	ἤραον ἤρασα 	ἤρασας  ἤρασε	ἤρασεν 	ἠράσατον 	ἠρασάτην 	ἠράσαμεν 	ἠράσατε 	ἤρασαν ἠρασάμην 	ἠράσω 	ἠράσατο 	ἠράσασθον 	ἠρασάσθην 	ἠρασάμεθα 	ἠράσασθε 	ἠράσαντο ἠρᾱ́θην 	ἠρᾱ́θης 	ἠρᾱ́θη 	ἠρᾱ́θητον 	ἠρᾱθήτην 	ἠρᾱ́θημεν 	ἠρᾱ́θητε 	ἠρᾱ́θησᾰν';
  $string = 'ἐνδιέτριβε ἀνδρὸς';

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
  echo 'total occurrences: ' . $sum . '<br>';

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
  function filterDistributionData($distributionaData) {
    $data = [];
    // loop books
    for ($i = 0; $i < count($distributionaData); $i++) {
      $data = [$data, [...$distributionaData[$i]]];
      // to do: loop chapters
      // to do: loop occurreces and sum up
      // $data = [$data, ...[$distributionaData[$i][0]]];
    }
    return $data;
  }
  $distributionaData = getDistributionData($text, $terms, $distribution);
  $distributionaDataFiltered = filterDistributionData($distributionaData);
  echo '<pre>';
  print_r($distributionaData);
  echo '</pre>';
  echo '<pre>';
  print_r($distributionaDataFiltered);
  echo '</pre>';

echo '<br>';
echo 'endgültiges Ergebnis: <br>';
print_r(count($distributionaDataFiltered));

  // data viz
  // https://canvasjs.com/php-charts/chart-index-data-label/
  ?>

  <?php include '../components/footer.php' ?>

<script>
  var test = '<?php echo json_encode($distribution_array); ?>'
  console.log(test)
</script>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

</body>

</html>