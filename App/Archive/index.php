<?php

$string = 'Ἐκ Διὸς ἀρχώμεσθα, τὸν οὐδέποτ’ ἄνδρες ἐῶμεν ἄρρητον· μεσταὶ δὲ Διὸς πᾶσαι μὲν ἀγυιαί, πᾶσαι δ’ ἀνθρώπων ἀγοραί, μεστὴ δὲ θάλασσα καὶ λιμένες· πάντη δὲ Διὸς κεχρήμεθα πάντες.';

echo 'ganzer String:' . $string;

echo '<br>';

$string = preg_replace('/[,.·’]/iu', '', $string);

echo 'ohne Punktuation:' . $string;

echo '<br>';
