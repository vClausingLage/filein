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
console.log(data)
// To Do
// modify data -> bring circles together
let weight = [[100,100,25],[200,100,30],[100,200,10],[200,200,40]] // d[0] = x-axis d[1] = y-axis d[2] = radius

let selector = d3.select('#svg')
  .append('svg')
  .attr('width', 500)
  .attr('height', 500)

let forms = selector.selectAll('forms')
  .data(weight)
  .enter()
  .append('circle')

let formAttributes = forms
  .attr('cx', function (d) { return d[0] })
  .attr('cy', function (d) { return d[1] })
  .attr('r', function (d) { return d[2] })
  .style('fill', 'black')



</script>
</body>
</html>