<!DOCTYPE html>
<html lang="en-us">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="index.css">
  <link rel="stylesheet" href="header-footer.css">
  <title>Sexuality in Antiquity</title>
</head>
<body>

<?php
function factorial($x) {
  if ($x === 0) {
    return 1;
  }
  else {
    return $x * factorial($x - 1);
  }
}
$num = 4;
if ($num > 0) {
  $result = factorial($num);
  echo "The factorial of $num is $result";
}
?>


<?php include 'components/header.php' ?>

<div class="container">

<h1>Sexuality in Antiquity</h1>
<h2>a Science-Blog</h2>

<div>
<h1>combine</h1>
<div class="flex">
  <div class="card colorOne"><h2>interpretation</h2></div>
  <div class="card"><p>and</p></div>
  <div class="card colorOne"><h2>data</h2></div>
</div>
</div>

</div>

<?php include 'components/footer.php' ?>

</body>
</html>