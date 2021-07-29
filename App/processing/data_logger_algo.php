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