<?php include "includes/profile_head.php";?>
<?php

//update category query
if(isset($_POST['submit'])){
  $cat_id = $_GET['cat_id'];
  $cat_name = $_POST['new_cat'];
  $cat_status = $_POST['status'];

  $cat_img = $_FILES['cat_img']['name'];
  $image_tmp = $_FILES['cat_img']['tmp_name'];

  move_uploaded_file($image_tmp, "dist/img/{$cat_img}");

  if(!empty($cat_name)){
    $query = "UPDATE categories ";
    $query .= "SET cat_name = '{$cat_name}', cat_img = '{$cat_img}', status = {$cat_status} ";
    $query .= "WHERE cat_id = '{$cat_id}'";
  $update_query = mysqli_query($connection, $query);
  if(!$update_query){
      die("category could not be updated" . $connection);
  }else header("Location: categories.php");  
  }else{
      $messaage = "please enter a category name";
  } 
}

if(isset($_GET['cat_id'])){
  $cat_id= $_GET['cat_id'];
  $query = "SELECT * FROM categories WHERE cat_id = {$cat_id}";
  $cat_by_id = mysqli_query($connection, $query);
  $db_cat = mysqli_fetch_assoc($cat_by_id);
  $cat_name = $db_cat['cat_name'];
  $cat_img = $db_cat['cat_img'];
  $cat_status = $db_cat['status'];
  if(empty($cat_img)){
    $cat_img = "no image found";
  }
}

?>


<body class="hold-transition sidebar-collapse">
<div class="wrapper">

  <!-- Main Sidebar Container -->
  <?php include "includes/nav.php" ?>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper container-fluid">
    <div  class="col-md-6 text-center">
          <h1>Categories</h1>
        </div>
        <div class="row">
        <div class="col-md-4">
                <form action="" method="post" enctype="multipart/form-data">
                    
                    <div class="form-group">
                      <label for="new_cat">Category Name :</label>
                      <input name="new_cat" type="text" class="form-control" value="<?php echo $cat_name; ?>">
                    </div>
                    
                   
                    <div class="form-group">
                      <label for="cat_img">Category Image</label>
                      <input type="file" class="form-control-file" name="cat_img" >
                    </div>

                    <div class="form-group">
                      <select name="status" id="">
                        <option value="<?php echo $cat_status ?>"><?php echo $cat_status ?></option>
                        <?php if($cat_status != 1){
                          echo "<option value='1'>1</option>";
                        }else{
                          echo "<option value='2'>2</option>";
                        }
                        ?>
                      </select>
                    </div>
                    <input type="submit" name="submit" value="update category" class="btn btn-primary">
                </form>
        </div>
        <div class="col-md-6 text-center">
          <h4>Category Image</h4>
          <img src="dist/img/<?php echo $cat_img ?>" alt="category image" width="350">
        </div>
    </div>
        
    </div>
    
      
      
      


  </div>
<!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
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
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>
