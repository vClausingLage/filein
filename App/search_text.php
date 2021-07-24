<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel='stylesheet' href='index.css'>
  <link rel='stylesheet' href='header-footer.css'>
  <title>Sexuality in Antiquity</title>
</head>

<body>

  <?php include 'components/header.php' ?>

  <h1>Search Texts</h1>

  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
    <input type="text" name="search" placeholder="enter keyword">
    <input type="submit" value="Search">
  </form>
  <?php

  if (file_exists('../Sources/Achilleus_Tatios-Leukippe_Kleitophon-Text.md')) {
    $text = file_get_contents('../Sources/Achilleus_Tatios-Leukippe_Kleitophon-Text.md');
  }

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_REQUEST['search'];
    if (empty($name)) {
      echo "enter a keyword";
    } else {
      echo 'You searched for "' . $name . '".';
      echo '<br>';
      echo 'Result: ';
    }
  }

  ?>

  <?php include 'components/footer.php' ?>

</body>

</html>