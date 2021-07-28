<?php

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