<link rel="stylesheet" href="../css_admin/css_admin.css">

<?php
    require_once 'req_admin/header_admin.php';
    require_once 'controller_admin/controller.php';
?>
<style>
  h1{
    background: black;
    padding: 5px 0;
    height: 80px;
    line-height: 80px;
    color: white;
  }
</style>
<?php
  $data = [];
  $sql = "select danhmucsanpham.*, COUNT(sanpham.MaDanhMuc) AS 'number' from sanpham INNER JOIN danhmucsanpham ON sanpham.MaDanhMuc = danhmucsanpham.MaDanhMuc GROUP BY sanpham.MaDanhMuc";
  $sta = TruyVan($sql);
  foreach($sta as $row)
  {
      $data[] = $row;
  }
?>
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-2">
       <?php require_once './req_admin/left_admin.php'; ?>
    </div>
    <div class="col-sm-10">
    <html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['TenDanhMuc', 'number'],
          <?php 
              foreach($data as $key){
                echo "['".$key['TenDanhMuc']."', ".$key['number']."],";
              }
          ?>
        ]);

        var options = {
          title: '',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="piechart_3d" style="width: 900px; height: 500px;"></div>
  </body>
</html>
    </div>
  </div>
</div>
