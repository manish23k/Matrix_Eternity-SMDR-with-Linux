<html>
<head>
<title>Home</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style type="text/css">
</style>
</head>
<?php
session_start();
if (!isset($_SESSION['USERNAME'])) {
     header("Location:/smdr/index.php");
     die();     // just to make sure no scripts execute
}
include_once $_SERVER['DOCUMENT_ROOT']."/smdr/config/config.php";
if(!empty($_GET['message'])) {
    $message = $_GET['message'];
	echo $message;
	}
include_once $_SERVER['DOCUMENT_ROOT']."/smdr/admin/menu.php";
?> 
<div id="main" style="overflow-x:scroll;overflow-y:scroll;width:78%;height:90%">
<body>
<table border="2" >
  <tr>
	<td bgcolor="#C0C0C0" nowrap><div align="center"> <font size="-1"><strong><a style="color:#1F45FC" href="home.php">External Calls</a></strong></font></div></td>
	<td bgcolor="#666666" nowrap><div align="center"> <font size="-1"><strong style="color:#0099FF">VoIP Calls</strong></font></div></td>
	<td bgcolor="#C0C0C0" nowrap><div align="center"> <font size="-1"><strong><a style="color:#1F45FC" href="home2.php">Internal Calls</a></strong></font></div></td>
  </tr>
</table>
  <!-- prerequisites -->
  <link rel="stylesheet" href="style1.css" type="text/css">
        <script src="amcharts.js" type="text/javascript"></script>
        <script src="serial.js" type="text/javascript"></script>

  <!-- cutom functions -->
  <script>
AmCharts.loadJSON = function(url) {
  // create the request
  if (window.XMLHttpRequest) {
    // IE7+, Firefox, Chrome, Opera, Safari
    var request = new XMLHttpRequest();
  } else {
    // code for IE6, IE5
    var request = new ActiveXObject('Microsoft.XMLHTTP');
  }

  // load it
  // the last "false" parameter ensures that our code will wait before the
  // data is loaded
  request.open('GET', url, false);
  request.send();

  // parse adn return the output
  return eval(request.responseText);
};
  </script>
  <h2 align="center" class="style1">Number of VoIP Calls v/s Date (Current Month)</h2>
  <!-- chart container -->
  <div id="chartdiv" style="width:100%;height:65%;"></div>

  <!-- the chart code -->
  <script>
var chart;

// create chart
AmCharts.ready(function() {

  // load the data
  var chartData = AmCharts.loadJSON('chart2.php');

  // SERIAL CHART
  chart = new AmCharts.AmSerialChart();

  chart.dataProvider = chartData;
  chart.categoryField = "category";
  chart.dataDateFormat = "DD";
  

  // GRAPHS

  var graph1 = new AmCharts.AmGraph();
  graph1.title = "Outgoing";
  graph1.lineColor = "#cc4b48";
  //graph1.lineColor = "#ff6600";
  graph1.valueField = "value1";
  graph1.bullet = "round";
  graph1.bulletBorderColor = "#FFFFFF";
  graph1.bulletBorderThickness = 2;
  graph1.lineThickness = 2;
  graph1.lineAlpha = 0.75;
  graph1.balloonText = "<span style='font-size:13px;'>[[title]] Calls on Date [[category]]:<b>[[value]]</b> [[additional]]</span>";
  graph1.dashLengthField = "dashLengthLine";
  graph1.dashLengthLine = 10;
  chart.addGraph(graph1);

  var graph2 = new AmCharts.AmGraph();
  graph2.title = "Incoming";
  graph2.lineColor = "#169b2f";
  //graph2.lineColor = "#B0DE09";
  graph2.valueField = "value2";
  graph2.bullet = "round";
  graph2.bulletBorderColor = "#FF00FF";
  graph2.bulletBorderThickness = 2;
  graph2.lineThickness = 2;
  graph2.lineAlpha = 0.75;
  graph2.dashLengthField = "dashLengthLine";
  graph2.dashLengthLine = 10;
  
  graph2.balloonText = "<span style='font-size:13px;'>[[title]] Calls on Date [[category]]:<b>[[value]]</b> [[additional]]</span>";
  chart.addGraph(graph2);

  // CATEGORY AXIS
  //chart.categoryAxis.parseDates = true;
  var legend = new AmCharts.AmLegend();
  legend.useGraphSettings = true;
  chart.addLegend(legend);
  // WRITE
  chart.write("chartdiv");
});

  </script>

</body>
</div>
</html>

