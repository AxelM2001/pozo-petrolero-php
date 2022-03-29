<?php

$con = new mysqli("localhost","root","","pozo petrolero");

$sql = "SELECT Pozo, Presion_medida, Fecha_registro FROM registros";
$res = $con->query($sql);

?>





<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Pozo', 'Nivel de presion','Fecha_registro'],
          <?php

            while ($fila = $res->fetch_assoc()){
                echo "['".$fila["Pozo"]."', ".$fila["Presion_medida"]." , ".$fila["Fecha_registro"]."],";
            }

          ?>
          
        ]);

        var options = {
          title: 'Grafico de pozos petroleros'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="piechart" style="width: 900px; height: 500px;"></div>
  </body>
</html>