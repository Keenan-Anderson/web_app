<?php include "includes/head.php"; ?>
<?php
  if(isset($_SESSION['method']) && $_SESSION['method'] == "local"){
    $user_id = $_SESSION['user_id'];
    $user_email = $_SESSION['user_email'];
    $user_full_name = $_SESSION['user_full_name'];
    $user_education = $_SESSION['user_education'];
    $user_location = $_SESSION['user_location'];
    $user_skills = $_SESSION['user_skills'];
    $user_image = $_SESSION['user_image'];
  }elseif(isset($_SESSION['method']) && $_SESSION['method'] != "local"){
    $user_id = $_SESSION['user_id'];
    $user_full_name = $_SESSION['user_full_name'];
    $user_image = $_SESSION['user_image'];
  }else{
    header("Location: login-v2.php");
  }

  
?>



<!--
`body` tag options:

  Apply one or more of the following classes to to the body tag
  to get the desired effect

  * sidebar-collapse
  * sidebar-mini
-->
<body class="hold-transition sidebar-collapse">
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>


<div class="wrapper">
  <!-- Main Sidebar Container -->
      <?php include "includes/nav.php"; ?>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard v3</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- /.col-md-6 -->
          <div class="col-lg-8">
            <div class="card">
              <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                  <h3 class="card-title">Site overview</h3>
                </div>
              </div>
              <?php
              //count users in DB
                $query = "SELECT * FROM users";
                $all_users_Q = mysqli_query($connection, $query);
                $user_count = mysqli_num_rows($all_users_Q);
                //count categories in DB
                $query = "SELECT * FROM categories";
                $all_cats = mysqli_query($connection, $query);
                 $cat_count = mysqli_num_rows($all_cats);
            ?>


              <script type="text/javascript">
                google.charts.load('current', {'packages':['bar']});
                google.charts.setOnLoadCallback(drawChart);

                function drawChart() {
                  var data = google.visualization.arrayToDataTable([
                    ['data', ''],
                    <?php
                    $element_text = ['users', 'categories'];
                    $element_count = [$user_count, $cat_count];
                    for($i = 0; $i < count($element_text); $i++){
                      echo "['{$element_text[$i]}',{$element_count[$i]}],";
                    }
                    ?>
                    
                  ]);

                  var options = {
                    chart: {
                      title: '',
                      subtitle: '',
                    }
                  };

                  var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                  chart.draw(data, google.charts.Bar.convertOptions(options));
                }
              </script>
              <div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>


            </div>
            <!-- /.card -->
          </div>
          <!-- /.col-md-6 -->
          <div class="col-lg-4">
            <div class="card">
              <div class="card-header border-0">
                <h3 class="card-title">Categories preview</h3>
                <div class="card-tools">
        
                  <!-- <a href="#" class="btn btn-sm btn-tool">
                    <i class="fas fa-bars"></i> -->
                  </a>
                </div>
              </div>
              <?php
              $query = "SELECT * FROM categories LIMIT 3";
              $three_cats = mysqli_query($connection, $query);
              while($row = mysqli_fetch_assoc($three_cats)){
                $cat_id = $row['cat_id'];
                $cat_name = $row['cat_name'];
                $cat_img = $row['cat_img']; 
                echo "<div class='card-body'>
                <div class='d-flex justify-content-between align-items-center border-bottom mb-3'>
                  <p class='text-success text-xl'>
                    <img src='dist/img/$cat_img' width='50'/>
                  </p>
                  <p class='d-flex flex-column text-right'>
                    <span class='text-muted'>$cat_name</span>
                  </p>
                </div>
                </div>";
              }
              ?>
              <p class="text-center">View all <a href="categories.php">categories</a> </p>
             
                <!-- /.d-flex -->

              </div>
            </div>
        </div>

          </div>
          
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer text-center">
    
    <!-- Default to the left -->
    <strong>Copyright &copy; 2021 <a href="">Keenan</a>.</strong> All rights reserved.
  <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
    </div>
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE -->
<script src="dist/js/adminlte.js"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard3.js"></script>
</body>
</html>
