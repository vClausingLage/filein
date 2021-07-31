<?php

function print_array($array)
{
  foreach ($array as $word) {
    echo $word;
  }
}
if (file_exists('../Sources/Achilleus_Tatios-Leukippe_Kleitophon-Text.md')) {
  $text = file_get_contents('../Sources/Achilleus_Tatios-Leukippe_Kleitophon-Text.md');
}

// replacements
$particles = ['δὲ', 'δέ', 'μὲν', 'γὰρ', 'ὡς', 'οὖν', 'καὶ', 'Καὶ', 'αὐ', 'οὐκ', 'ἦν', 'ἂν', 'μὴ', 'οὐ', 'δ', 'εἰ', 'ἅμα', 'ἔνθα', 'πρὶν', 'πρῶτον', 'πῶς', 'κἂν', 'ἵνα', 'ὥστε', 'ὥσπερ', 'ὅπως', 'ὅταν', 'οὕτω', 'ἤδη', 'νῦν', 'ὅτι', 'ἀλλὰ', 'ἔτι', 'οὔτε', 'τότε', 'μέν', 'μή', 'ἐὰν', 'μηδὲ', 'Ὡς', 'ἣν', 'κάτω', 'σποράδην', 'Ἧι', 'αὖθις', 'Ἐνταῦθα'];
$articles = ['ὁ', 'Ὁ', 'τοῦ', 'τῷ', 'τὸν', 'τοὺς', 'τοῖς', 'τῶν', 'οἱ', 'ἡ', 'τῆς', 'τῇ', 'τὴν', 'ταῖς', 'τὰς', 'τὸ', 'τὰ', 'πρὸ'];
$pronouns = ['ἐγὼ', 'τις', 'τίς', 'ἃ', 'οἷς', 'ὦ', 'αἱ', 'ὃς'];
$prepositions = ['πρὸς', 'εἰς', 'ἐν', 'ἐπὶ', 'παρὰ', 'κατὰ', 'περὶ', 'ἐκ', 'ἐς', 'μέχρι', 'ὑπὸ', 'ἀπὸ', 'ἐξ'];
$exceptionals = ['μου', 'μοι', 'με', 'ἐμὲ', 'σὺ', 'σου', 'σοι', 'p.', 'ἐστιν', 'ἔφη', 'εἶναι', 'εἶπεν', 'εῖ'];
$numbers = ['/[0-9]/'];
// prepare text
$text = preg_replace('/,.·’“”‘:;/mu', ' ', $text);
$text = preg_replace('/\b(' . implode(')\b|\b(', $particles) . ')/mu', ' ', $text);
$text = preg_replace('/\b(' . implode(')\b|\b(', $articles) . ')/mu', ' ', $text);
$text = preg_replace('/\b(' . implode(')\b|\b(', $pronouns) . ')/mu', ' ', $text);
$text = preg_replace('/\b(' . implode(')\b|\b(', $prepositions) . ')/mu', ' ', $text);
$text = preg_replace('/\b(' . implode(')\b|\b(', $exceptionals) . ')/mu', ' ', $text);
$text = preg_replace($numbers, '', $text);
$text = strtolower($text); // not working -- why?
print_r($text);
$text = explode(' ', $text);
// find all substantives (M|F|N)
// this has to be refined!
$substantives = preg_grep('/ος|ός|ὸς/mu', $text);
// remove duplicates (if wanted)
// $substantives = array_unique($substantives);

// find most occurrences
$count = array_count_values($text);
arsort($count);

print_r($count);
