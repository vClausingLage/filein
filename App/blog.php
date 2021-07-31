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

<h1>Sexuality in Antiquity</h1>
<h2>a Science-Blog</h2>

<?php
include 'components/blogposts.php';

$posts = new Posts();
$fetch = $posts->getPosts();
?>

<?php include 'components/footer.php' ?>

</body>
</html>