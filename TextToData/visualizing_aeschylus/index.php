<!DOCTYPE html>
<html lang="en-us">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="hatred.css">
  <script src="https://d3js.org/d3.v6.min.js"></script>
  <title>Data Viewer</title>
</head>
<body>

<div class="container">

<?php
$data = file_get_contents('aeschylData.json');
$data = json_decode($data);
?>
</div>

<div id='svg'>

</div>

<script>
let data = '<?php echo json_encode($data); ?>'
data = JSON.parse(data)
// To Do
// modify data -> bring circles together
let angry = data.angry
let nasty = data.nasty
let affectionate = data.affectionate
let nice = data.nice

startVector = [200,200]
accelerator = 10000

angryVector = [startVector[0],startVector[1],angry * accelerator]
nastyVector = [startVector[0] + (angry * accelerator + nasty * accelerator),startVector[1],nasty * accelerator]
affectionateVector = [startVector[0] + (angry * accelerator + nasty * accelerator),startVector[1] + (nasty * accelerator + affectionate * accelerator),affectionate * accelerator]
niceVector = [startVector[0] + (angry * accelerator + nasty * accelerator),startVector[1] + (nasty * accelerator - affectionate * accelerator),nice * accelerator]

let vectors = [angryVector,nastyVector,affectionateVector,niceVector] // d[0] = x-axis d[1] = y-axis d[2] = radius


let selector = d3.select('#svg')
  .append('svg')
  .attr('width', 500)
  .attr('height', 500)

let figures = selector.selectAll('forms')
  .data(vectors)
  .enter()
  .append('circle')

let formAttributes = figures
  .attr('cx', function (d) { return d[0] })
  .attr('cy', function (d) { return d[1] })
  .attr('r', function (d) { return d[2] })
  .style('fill', 'black')



</script>
</body>
</html>