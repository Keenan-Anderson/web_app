<?php include "includes/head.php";?>

<?php
$query = "SELECT * FROM categories";
$cat_query = mysqli_query($connection, $query);
$messaage = "Category Name";

//New category query
if(isset($_POST['submit'])){
  $cat_name = $_POST['new_cat'];
  $cat_img = $_FILES['new_cat_img']['name'];
  $image_tmp = $_FILES['new_cat_img']['tmp_name'];

  move_uploaded_file($image_tmp, "dist/img/{$cat_img}");

    if(!empty($cat_name)){
      $query = "INSERT INTO categories(cat_name, cat_img, status) VALUES('{$cat_name}', '{$cat_img}', 1)";

      $new_cat_query = mysqli_query($connection, $query);

      if(!$new_cat_query){
        die("category could not be created". mysqli_error($connection));
      }else header("Location: categories.php");  
    }else{
        $messaage = "please enter a category name";
    } 
}


if(isset($_GET['source'])){
    $source = $_GET['source'];
    $cat_id = $_GET['cat_id'];
    $query = "DELETE FROM categories WHERE cat_id = {$cat_id}";
    $delete_query = mysqli_query($connection, $query);
    if(!$delete_query){
        die("category could not be deleted".$connection);
    }else header("Location: categories.php");
}

?>


<body class="hold-transition sidebar-collapse">
<div class="wrapper">

  <!-- Main Sidebar Container -->
  <?php include "includes/nav.php" ?>
      <!-- /.sidebar-menu -->
    

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper container-fluid">
        <div  class="col-md-12 text-center">
          <h1>Categories</h1>
        </div>
        <div class="row">
          <div class="col-md-12">
            <table class="table table-bordered table-hover">
                <tr>
                    <th>ID</th>
                    <th>Category</th>
                    <th>image</th>
                    <th>status</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                <?php
                while($row = mysqli_fetch_assoc($cat_query)){
                    $cat_id = $row['cat_id'];
                    $cat_name = $row['cat_name'];
                    $cat_img = $row['cat_img'];
                    $cat_status = $row['status'];
                    echo "<tr>
                        <td>$cat_id</td>
                        <td>$cat_name</td>
                        <td><img src='dist/img/$cat_img' alt='' width='150'></td>
                        <td>$cat_status</td>
                        <td><a href='edit_category.php?cat_id=$cat_id'>edit</a></td>
                        <td><a href='categories.php?source=delete&cat_id=$cat_id'>delete</a></td>
                    </tr>";
                }
                ?>
            </table>
        </div>


        </div>

        
        <hr>
        <div class="col-md-8 ml-4">
          <h2 class="text-center">Add Category</h2>
                <form action="" method="post" enctype="multipart/form-data">
                    <label for="new_cat">Category Name</label>
                    <div class="input-group">
                      <label for="new_cat"></label>
                        <input name="new_cat" type="text" class="form-control" placeholder="<?php echo $messaage; ?>">
                    </div>
                    
                    <div class="form-group">
                      <label for="new_cat_img">Category Image</label>
                      <input type="file" class="form-control-file" name="new_cat_img" >
                    </div>


                    <input type="submit" name="submit" value="Submit" class="btn btn-primary">
                    
                </form  class="pb-4">
        </div>
        <hr>
    </div>
      
      
      


  </div  class="pb-4">
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
    </div></footer>
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
