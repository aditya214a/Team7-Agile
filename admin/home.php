<?php
include 'includes/session.php';
include 'includes/connection.php';
include 'includes/format.php';
?>
<?php
$today = date('Y-m-d');
$year = date('Y');
if (isset($_GET['year'])) {
  $year = $_GET['year'];
}
?>
<?php include 'includes/header.php'; ?>
<style>
  /* side-box-icon */
  .icon.icon-side {
    font-size: 30px;
    top: 10px;
  }

  .small-box:hover .icon {
    font-size: 60px;
    top: 5px;
  }

  /* box text */
  .box-text {
    color: white;
    font-size: larger;
    font-family: cursive;
  }
</style>

<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">

    <?php include 'includes/navbar.php'; ?>
    <?php include 'includes/menubar.php'; ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Dashboard
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Dashboard</li>
        </ol>
      </section>
      <!-- Main content -->
      <section class="content">
        <?php
        if (isset($_SESSION['error'])) {
          echo "
            <div class='alert alert-danger alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-warning'></i> Error!</h4>
              " . $_SESSION['error'] . "
            </div>
          ";
          unset($_SESSION['error']);
        }
        if (isset($_SESSION['success'])) {
          echo "
            <div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-check'></i> Success!</h4>
              " . $_SESSION['success'] . "
            </div>
          ";
          unset($_SESSION['success']);
        }
        ?>
        <!-- Row 1 Small Boxes (Stat box) -->
        <div class="row">
          <!-- small box 1-->
          <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-green">
              <div class="inner">
                <?php
                $client_active_query = "SELECT client_id FROM client_details WHERE status=1";
                $client_active_query_exec = mysqli_query($conn, $client_active_query);
                $c_active_no = mysqli_num_rows($client_active_query_exec);
                ?>
                <h3 class="box-text"><?php echo $c_active_no; ?></h3>
                <p>Client Users Active</p>
              </div>
              <div class="icon">
                <i class="fa fa-user"></i>
              </div>
              <?php if ($power_row['power'] == "Root User") { ?>
                <a href="client_users.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              <?php } else { ?>
                <a href="#" class="small-box-footer">Unaccessible by General User!</a>
              <?php } ?>
            </div>
          </div>
          <!-- small box 2-->
          <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-blue">
              <div class="inner">
                <?php
                $client_tot_query = "SELECT client_id FROM client_details";
                $client_tot_query_exec = mysqli_query($conn, $client_tot_query);
                $client_tot_no = mysqli_num_rows($client_tot_query_exec);
                ?>
                <h3 class="box-text"><?php echo $client_tot_no; ?></h3>
                <p>Total Client Users</p>
              </div>
              <div class="icon">
                <i class="fa fa-users"></i>
              </div>
              <?php if ($power_row['power'] == "Root User") { ?>
                <a href="client_users.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              <?php } else {
              ?>
                <a href="#" class="small-box-footer">Unaccessible by General User!</a>
              <?php } ?>
            </div>
          </div>
        </div>
        <!-- row end -->

        <!-- Row 2 Big Boxes (Stat box) -->
        <div class="row">
          <!-- Big box 1-->
          <div class="col-lg-6 col-xs-9">
            <div class="small-box bg-orange">
              <div class="inner">
                <?php
                include 'includes/connection.php';

                $power_query = "SELECT admin_id FROM admin_details Where power='Root User'";
                $power_query_exec = mysqli_query($conn, $power_query);
                $power_query_count = mysqli_num_rows($power_query_exec);
                ?>
                <h3 class="box-text"><?php echo $power_query_count; ?></h3>
                <p>Total Number of Root User</p>
              </div>
              <div class="icon">
                <i class="fa fa-superpowers"></i>
              </div>
              <?php if ($power_row['power'] == "Root User") { ?>
                <a href="admin_users.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              <?php } else {
              ?>
                <a href="#" class="small-box-footer">Unaccessible by General User!</a>
              <?php } ?>
            </div>
          </div>
          <!-- Big box 2-->
          <div class="col-lg-6 col-xs-9">
            <div class="small-box" style="background-color:darkslategrey; color:white;">
              <div class="inner">
                <?php
                include 'includes/connection.php';

                $power_general_query = "SELECT admin_id FROM admin_details Where power='General User'";
                $power_general_query_exec = mysqli_query($conn, $power_general_query);
                $power_general_count = mysqli_num_rows($power_general_query_exec);
                ?>
                <h3 class="box-text"><?php echo $power_general_count; ?></h3>
                <p>Total Number of General Users</p>
              </div>
              <div class="icon">
                <i class="fa fa-user"></i>
              </div>
              <?php if ($power_row['power'] == "Root User") { ?>
                <a href="admin_users.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              <?php } else {
              ?>
                <a href="#" class="small-box-footer">Unaccessible by General User!</a>
              <?php } ?>
            </div>
          </div>

        </div>
        <!-- row end -->

      </section>
    </div>
    <?php include 'includes/footer.php'; ?>
  </div>
  <!-- ./wrapper -->
  <?php include 'includes/scripts.php'; ?>
</body>

</html>