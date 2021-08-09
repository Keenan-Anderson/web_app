<?php include "includes/head.php"; ?>
    
<?php
  if(isset($_SESSION['method']) == "local"){
    $user_id = $_SESSION['user_id'];
    $user_email = $_SESSION['user_email'];
    $user_full_name = $_SESSION['user_full_name'];
    $user_education = $_SESSION['user_education'];
    $user_location = $_SESSION['user_location'];
    $user_skills = $_SESSION['user_skills'];
    $user_image = $_SESSION['user_image'];
  }elseif(isset($_SESSION['method']) != "local"){
    $user_id = $_SESSION['user_id'];
    $user_full_name = $_SESSION['user_full_name'];
    $user_image = $_SESSION['user_image'];
  }else{
    header("Location: login-v2.php");
  }

// $query = "SELECT * FROM users WHERE user_id = '{$_SESSION['user_id']}'";
// $select_img = mysqli_query($connection, $query);
// $db_user = mysqli_fetch_assoc($select_img);
// $image = $db_user['user_image'];

if(isset($_POST['submit'])){
    $user_id = $_SESSION['user_id'];
    $user_full_name = $_POST['user_full_name'];
    $user_email = $_POST['user_email'];
    $user_education = $_POST['user_education'];
    $user_location = $_POST['user_location'];
    $user_skills = $_POST['user_skills'];


    $image = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];

    move_uploaded_file($image_tmp, "dist/img/{$image}");
    $image = 'dist/img/'.$image;
    if(empty($image)){
        $query = "SELECT * FROM users WHERE user_id = '{$user_id}'";
        $select_img = mysqli_query($connection, $query);
        $row = mysqli_fetch_assoc($select_img);
        $image = $row['user_image'];
    }

    $query = "UPDATE users SET ";
    $query .= "user_id = '{$user_id}', ";
    $query .= "user_full_name = '{$user_full_name}', ";
    $query .= "user_email = '{$user_email}', ";
    $query .= "user_education = '{$user_education}', ";
    $query .= "user_location = '{$user_location}', ";
    $query .= "user_skills = '{$user_skills}', ";
    $query .= "user_image = '{$image}' ";
    $query .= "WHERE user_id = '{$user_id}'";

    $update_user = mysqli_query($connection, $query);

    if(!$update_user){
        die("profile update failed". mysqli_error($connection));
    }else{
      $_SESSION['user_image'] = $image;
        echo "<p class='bg-success' >Profile updated</p>";
        header("Location: profile.php");

    }
   
    
}

?>

  <!-- Main Sidebar Container -->
  <?php include "includes/nav.php"; ?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-center">Edit Profile</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">

      <div class="col-md-12">
          <form action="" method="post" enctype="multipart/form-data">
          <div class="text-center">
                  <img class="img-fluid img-circle"
                       src="<?php echo $image;?>"
                       alt="User profile picture"
                       width="500">
                       
                </div>

          <div class="form-group">
                <label for="image">Profile Picture: </label><br>
                <input type="file" class="btn" name="image" >
          </div>
            

            <div class="form-group">
                <label for="user_full_name">Full Name</label>
                <input type="text" class="form-control" name="user_full_name" value="<?php echo $user_full_name; ?>">
            </div>

            <div class="form-group">
                <label for="user_email">E-mail</label>
                <input type="text" class="form-control" name="user_email" value="<?php echo $user_email; ?>">
            </div>

            <div class="form-group">
                <label for="">Education</label>
                <input type="text" class="form-control" name="user_education" value="<?php echo $user_education; ?>">
            </div>

            <div class="form-group">
                <label for="user_location">Location</label>
                <input type="text" class="form-control" name="user_location" value="<?php echo $user_location; ?>">
            </div>

            <div class="form-group">
                <label for="user_skills">Skills</label>
                <input type="text" class="form-control" name="user_skills" value="<?php echo $user_skills; ?>" >
            </div>
            <div class="form-group text-center">
                <input type="submit" class="btn btn-primary" name="submit" value="Update Profile">
            </div>
            

          </form> 





    </div>
    <!-- /.content -->
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
