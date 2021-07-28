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

  <?php
  // data file
  $text = file_get_contents('chariton.txt');
  $text = json_decode($text);

  // $string = 'ἐράω ἐρᾷς ἐρᾷ ἐρῶμεν ἐρᾶτε ἐρῶσῐ ἐρῶσῐν ἤραον 	ἤραες  ἤραε	ἤραεν 	ἠράετον 	ἠραέτην 	ἠράομεν 	ἠράετε 	ἤραον ἤρασα 	ἤρασας  ἤρασε	ἤρασεν 	ἠράσατον 	ἠρασάτην 	ἠράσαμεν 	ἠράσατε 	ἤρασαν ἠρασάμην 	ἠράσω 	ἠράσατο 	ἠράσασθον 	ἠρασάσθην 	ἠρασάμεθα 	ἠράσασθε 	ἠράσαντο ἠρᾱ́θην 	ἠρᾱ́θης 	ἠρᾱ́θη 	ἠρᾱ́θητον 	ἠρᾱθήτην 	ἠρᾱ́θημεν 	ἠρᾱ́θητε 	ἠρᾱ́θησᾰν';
  $string = 'ἠλέησας Ὑγῖνος';
  
  $terms = [];

  $distribution = [];

  // push search terms
  function pushTerms($terms, $string) {
    // remove redundant white space
    $string = trim($string);
    $string = preg_replace('/\s+/', '|', $string);
    $terms = explode('|', $string);
    return $terms;
  }
  $terms = pushTerms($terms, $string);

  // search algorithm
  function searchText($text, $terms, $sum, $distribution) {
    $sum = 0;
    for ($i = 0; $i < count($text); $i++) {
      echo '<p>Book ' . ($i + 1) . ' </p>';
      for ($j = 0; $j < count($text[$i]); $j++) {
        echo '<p>Chapter ' . ($j + 1) . '</p>';
        for ($k = 0; $k < count($text[$i][$j]); $k++) {
          echo '<p>Paragraph ' . ($k + 1) . '</p>';
          echo $text[$i][$j][$k];
          foreach($terms as $term) {
            $sum += preg_match_all('/' . $term . '/', $text[$i][$j][$k]);
            $distribution[$i][$j][$k] = preg_match_all('/' . $term . '/', $text[$i][$j][$k]);
          }
        }
      }
    }
    return $sum;
    return $distribution;
  }
  $sum = searchText($text, $terms, $sum, $distribution);
  
  echo 'total of occurrences: ' . $sum;

  print_r($distribution);

  ?>

  <?php include '../components/footer.php' ?>

  <script>

  </script>

</body>

</html>