<style>
  .disabled-link {
    pointer-events: none;
    text-decoration: none;
  }
</style>
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel" style="padding: 5px 2px 5px 5px;">
      <div class="pull-left image">
        <img src="<?php echo './uploaded_images/admin_images/' . $admin_record['image']; ?>" class="img-circle" style="height: 45px; max-height: 45px; border-radius: 18%;" alt="Admin User Image">
      </div>
      <div class="pull-left info">
        <p><?php echo $admin_record['username']; ?></p>
        <a><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
      <!-- Disable for General Users some of Features -->
      <?php
      include 'includes/connection.php';

      $power_query = "SELECT power FROM admin_details WHERE admin_id=" . $admin_record['admin_id'] . "";
      $power_query_execute = mysqli_query($conn, $power_query);
      $power_row = mysqli_fetch_assoc($power_query_execute);
      ?>
      <li class="header">REPORTS</li>
      <li><a href="home.php"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
      <li class="header">ADMIN DETAILS</li>
      <!-- if root user -->
      <?php if ($power_row['power'] == 'Root User') { ?>
        <li><a href="admin_users.php"><i class="fa fa-users"></i> <span>Admin Users</span></a></li>
      <?php } ?>
      <!-- if general user -->
      <?php if ($power_row['power'] == 'General User') { ?>
        <li><a href="#" class="disabled-link" style="color: grey; cursor:pointer;"><i class="fa fa-users"></i> <span>Admin Users</span></a></li>
      <?php } ?>
      <li class="header">CLIENT DETAILS</li>
      <!-- if root user -->
      <?php if ($power_row['power'] == 'Root User') { ?>
        <li><a href="client_users.php"><i class="fa fa-users"></i> <span>Client Users</span></a></li>
      <?php } ?>
      <!-- if general user -->
      <?php if ($power_row['power'] == 'General User') { ?>
        <li><a href="#" class="disabled-link" style="color: grey; cursor:pointer;"><i class="fa fa-users"></i> <span>Client Users</span></a></li>
      <?php } ?>
      <li class="header">WASTE DETAILS</li>
      <li><a href="waste_deposit.php"><i class="fa fa-cubes"></i> <span>Waste Deposit</span></a></li>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>