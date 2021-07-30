<?php

// arrays iterieren
$terms = ['a', 'b', 'c', 'd'];
$texts = [['a a b c', 'b b a cc c cccc'], ['c c c c a b d', 'd a b c']];

function searchTexts($terms, $texts, $sum)
{
  $sum = 0;
  for ($i = 0; $i < count($texts); $i++) {
    for ($j = 0; $j < count($texts[$i]); $j++) {
      // print_r(($i + 1) . ' : ' . $texts[$i][$j]);
      for ($k = 0; $k < count($terms); $k++) {
        echo $terms[$k] . ' : ';
        echo $texts[$i][$j] . ' (text) : ';
        print_r(preg_match_all('/' . $terms[$k] . '/', $texts[$i][$j]) . '<br>');
        $sum += preg_match_all('/' . $terms[$k] . '/', $texts[$i][$j]);
      }
      echo '<br>';
    }
  }
  echo 'found ' . $sum;
}
searchTexts($terms, $texts, $sum);

function getDistribution($text, $terms, $distribution)
{
  $distribution = [];
  for ($i = 0; $i < count($text); $i++) {
    array_push($distribution, array());
    for ($j = 0; $j < count($text[$i]); $j++) {
      array_push($distribution, array());
      for ($k = 0; $k < count($text[$i][$j]); $k++) {
        array_push($distribution, array());
        foreach ($terms as $term) {
          $distribution[$i][$j][$k] = preg_match_all('/' . $term . '/', $text[$i][$j][$k]);
          if ($distribution[$i][$j][$k] > 0) {
            echo 'FOUND!';
            echo ' @ ' . 'Buch ' . ($i + 1) . ' Kap. ' . ($j + 1) . ' Par. ' . ($k + 1);
            echo '<br>';
          } else {
            continue;
          }
        }
      }
    }
  }
  return $distribution;
}
$distribution_array = getDistribution($text, $terms, $distribution);

  // count occurrences whole text
  function getDistribution2($text, $terms, $distribution)
  {
    $distribution = [];
    for ($i = 0; $i < count($text); $i++) {
      for ($j = 0; $j < count($text[$i]); $j++) {
        for ($k = 0; $k < count($text[$i][$j]); $k++) {
          foreach($terms as $term) {
            if (preg_match_all('/' . $term . '/', $text[$i][$j][$k]) > 0) {
              $distribution[$i][$j] = [];
              $distribution[$i][$j][0] = $k; 
              $distribution[$i][$j][1] = preg_match_all('/' . $term . '/', $text[$i][$j][$k]);
            }
          }
        }
      }
    }
    return $distribution;
  }
  $distribution_array = getDistribution2($text, $terms, $distribution);

  // ALLES IN ASSOC ARR UMSCHREIBEN !!!
  function printDistribution($distribution_array) {
    foreach ($distribution_array as $book => $book_content) {
      // continue umschreiben !
      foreach ($book as $chapter) {
        foreach ($chapter as $paragraph) {
          foreach ($paragraph as $key => $value) {
            echo "Key=" . $key . ", Value=" . $value;
            echo "<br>";
          }
        }
      }
    }
    return $distribution_array;
  }
  $distribution_printed = printDistribution($distribution_array);
  // echo '<pre>';
  // print_r($distribution_printed);
  // echo '</pre>';