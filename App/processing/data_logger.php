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
  // FOR Data
  // $text = file_get_contents('chariton.txt');
  // $text = json_decode($text);
  $terms = ['a', 'b', 'c', 'd'];
  $texts = [['this is text a', 'this is text b and b'], ['this is text c', 'this is text d and d and d']];

  function searchTexts($terms, $texts)
  {
    for ($i = 0; $i < count($texts); $i++) {
      for ($j = 0; $j < count($texts[$i]); $j++) {
        // print_r(($i + 1) . ' : ' . $texts[$i][$j]);
        for ($k = 0; $k < count($terms); $k++) {
          print_r(preg_match_all('/' . $terms[$k] . '/', $texts[$i][$j]) . '<br>');
        }
        echo '<br>';
      }
    }
  }

  searchTexts($terms, $texts);

  ?>

  <?php include '../components/footer.php' ?>

  <script>

  </script>

</body>

</html>