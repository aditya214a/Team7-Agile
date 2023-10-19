<header class="main-header">
  <!-- Logo -->
  <a href="#" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><b>A</b>S</span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><b>Admin</b> Side</span>
  </a>
  <!-- Header Navbar: style can be found in header.less -->
  <nav class="navbar navbar-static-top" style="background-color: #17354b;">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>

    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <!-- User Account: style can be found in dropdown.less -->
        <li class="dropdown user user-menu">
          <a href="#" style="line-height: 35px; padding-top: 8px; padding-bottom: 11px;" class="dropdown-toggle" data-toggle="dropdown">
             <img src="<?php echo './uploaded_images/admin_images/'.$admin_record['image']; ?>" class="user-image" style="width: 42px; height: 42px;     border-radius: 15%;" alt="Admin User Image">
             <span class="hidden-xs"><?php echo $admin_record['username']; ?></span> 
          </a>
          <ul class="dropdown-menu">
            <!-- User image -->
            <li class="user-header" style="background-color: #17354b;">
              <img src="<?php echo './uploaded_images/admin_images/'.$admin_record['image']; ?>" class="img-circle" style="height: 95px; width: 95px; border-radius: 25%;" alt="Admin User Image">

              <p>
                <?php echo $admin_record['username']; ?>
                <small>Member since <?php echo date('M. Y', strtotime($admin_record['created_on_date'])); ?></small>
              </p>
            </li>
            <li class="user-footer" style="background-color: #54697e;">
              <div class="pull-right">
                <a href="./logout.php" class="btn btn-danger btn-flat">Sign out</a>
              </div>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
</header>
