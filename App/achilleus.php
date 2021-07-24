<?php

// $achilleus = fopen('../Sources/Achilleus_Tatios-Leukippe_Kleitophon-Text.md', 'r') or die('not readable');

function print_array($array)
{
  foreach ($array as $word) {
    echo $word;
  }
}

if (file_exists('../Sources/Achilleus_Tatios-Leukippe_Kleitophon-Text.md')) {
  $text = file_get_contents('../Sources/Achilleus_Tatios-Leukippe_Kleitophon-Text.md');
}

$text = preg_replace('/[,.·’“”‘:]/iu', '', $text);
$text = strtolower($text);
$text = explode(' ', $text);
$substantives = preg_grep('/ος|ός|ὸς/mu', $text);
// remove duplicates
// $substantives = array_unique($substantives);

echo 'This is the pattern outcome: <br>';
print_r($substantives);
echo count($substantives);
echo '<br>';
echo 'this is the text: <br>';

print_array($text);
