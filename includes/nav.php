<?php //include "functions.php";
  if(!isset($_SESSION['method'])){
    $image = "dist/img/".$_SESSION['user_image'];
    $f_name = $_SESSION['user_full_name'];
  }else{
    $f_name = $_SESSION['user_full_name'];
    $image = $_SESSION['user_image'];
  }
  
?>
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.php" class="nav-link">Home</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>

      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge">3</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Nora Silvester
                  <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">The subject goes here</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
        </div>
      </li>
      <!-- Notifications Dropdown Menu -->
      
    </ul>
  </nav>
  <!-- /.navbar -->
<aside class="main-sidebar sidebar-dark-primary elevation-4" >
    <!-- Brand Logo -->
    <a href="index3.php" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Keenans Web App</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar" >
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img 
          src="<?php echo $image;?>"
           class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="profile.php" class="d-block"><?php echo $f_name; ?></a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline mt-4">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="d-flex-column mt-4" style="height:100vh;">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
           
          <li class="nav-header"></li>
          <li class="nav-item">
          <a href="index3.php" class="nav-link"><i class="nav-icon fas fa-circle"></i>
              <p>DashBoard</p>
            </a>
          </li>
          <hr>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-circle"></i>
              <p>
                Profile
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="profile.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Profile</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="edit_profile.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Edit Profile</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="categories.php" class="nav-link">
              <i class="fas fa-circle nav-icon"></i>
              <p>Categories</p>
            </a>
          </li>    
          <li class="nav-item justify-self-end">
            <a href="sign_out.php" class="nav-link">
              <i class="fas fa-circle nav-icon"></i>
              <p>Sign Out</p>
            </a>
          </li>
        </ul>
        <!-- <div style="height: 500px;">

        </div> -->
        
      </nav>
            <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>