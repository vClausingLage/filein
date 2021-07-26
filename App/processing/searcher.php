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

  <h1>Searcher</h1>
  <h2>for Chariton</h2>

  <?php

  $text = file_get_contents('chariton.xml');

  echo '<p id="text">';
  echo $text;
  echo '<p>';

  ?>

  <?php include '../components/footer.php' ?>

  <script>
    // XMLHttpRequest
    let xhttp = new XMLHttpRequest()
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        loadXML(this)
      }
    };
    xhttp.open("GET", "chariton.xml", true)
    xhttp.send()
    // load XML
    function loadXML(xml) {
      let xmlDoc = xml.responseXML;
      document.getElementById("text").innerHTML = getNodes(xmlDoc)
    }
    // getter Callback
    let getNodes = (xml) => {
      let result = xml.getElementsByTagName('chariton')
      let books = getBooks(xml)
      // let result = doc.getElementsByTagName("chapter")[0].childNodes[0].childNodes[0].nodeValue
      // console.log(result[0])
      return result
    }
    // helper functions
    function getBooks(xml) {
      iterator = xml.getElementsByTagName('chariton')[0]
      console.log(iterator.childNodes[0].innerHTML)
    }
  </script>

</body>

</html>