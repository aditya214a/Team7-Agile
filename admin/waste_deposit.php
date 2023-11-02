<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<?php
include 'includes/connection.php';

if (isset($_GET['waste_id_a'])) {
  $waste_id_a = @$_GET['waste_id_a'];

  $update_query = "UPDATE waste_deposit SET status='Approved' WHERE waste_disposal_id=$waste_id_a";
  $update_query_exec = mysqli_query($conn, $update_query);
  $_SESSION['success'] = "Status Updated Successfully.";
}
if (isset($_GET['waste_id_na'])) {
  $waste_id_na = @$_GET['waste_id_na'];

  $update_query = "UPDATE waste_deposit SET status='Not Approved' WHERE waste_disposal_id=$waste_id_na";
  $update_query_exec = mysqli_query($conn, $update_query);
  $_SESSION['success'] = "Status Updated Successfully.";
}

?>
<style>
  .c-approved {
    color: green;
    font-weight: 600;
  }

  .c-not-approved {
    font-weight: 600;
    color: orangered;
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
          Waste Deposit
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Waste Deposit</li>
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
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <div class="box-header with-border">
              </div>
              <div class="box-body">
                <table id="example1" class="table">
                  <thead class="thead-dark" style="background-color: #284649;color: white;">
                    <th>Waste ID</th>
                    <th>Client Detail</th>
                    <th>Passport Photo</th>
                    <th>Passport No</th>
                    <th>Waste Type</th>
                    <th>Waste Details</th>
                    <th>Status</th>
                    <th>Request Date</th>
                    <th>Tools</th>
                  </thead>
                  <tbody>
                    <?php
                    include 'includes/connection.php';

                    try {

                      $query_values = "SELECT wd.*,cd.username,cd.image,cd.state,cd.city FROM waste_deposit as wd, client_details as cd WHERE wd.client_id=cd.client_id";
                      $query_result = mysqli_query($conn, $query_values);
                      while ($row = mysqli_fetch_array($query_result)) {
                        $image1 = 'uploaded_images/client_images/' . $row['image'];
                        $image2 = 'uploaded_images/passport_photo/' . $row['passport_photo'];
                        if ($row['status'] == 'Not Approved') {
                          $status = "Not Approved";
                          $c_status = "c-not-approved";
                          $an_status = '<a href="waste_deposit.php?waste_id_a=' . $row['waste_disposal_id'] . '" style="margin-top: 4px;" class="btn btn-success btn-sm btn-lg"><i class="fa fa-check"></i> Approve</a>';
                        } else {
                          $status = "Approved";
                          $c_status = "c-approved";
                          $an_status = '<a href="waste_deposit.php?waste_id_na=' . $row["waste_disposal_id"] . '" style="margin-top: 4px;" class="btn btn-danger btn-sm btn-lg"><i class="fa fa-times"> Unapprove</i></a>';
                        }
                        echo "
                          <tr>
                          <td style='vertical-align: middle; text-align: center;'>" . $row['waste_disposal_id'] . "</td>
                          <td style='vertical-align: middle;text-align: center;'>
                              <img src='" . $image1 . "' height='50px' width='50px' style='border-radius:20%'>
                              <p style='margin:0px;'>" . $row['username'] . "</p>
                              <p style='margin:0px;'>" . $row['city'] . ", " . $row['state'] . "</p>
                          </td>
                          <td style='vertical-align: middle; text-align: center;'><img src='" . $image2 . "' height='100px' width='100px' style='border-radius:20%'></td>
                          <td style='vertical-align: middle; text-align: center;'>" . $row['passport_number'] . "</td>
                          <td style='vertical-align: middle; text-align: center;'>" . $row['waste_deposit_type'] . "</td>
                          <td style='vertical-align: middle; text-align: center;'>" . $row['waste_details'] . "</td>
                          <td style='vertical-align: middle; text-align: center;' class=" . $c_status . ">" . $status . "</td>
                          <td style='vertical-align: middle;text-align: center;'>" . date('M d, Y', strtotime($row['request_date'])) . "</td>
                          <td style='vertical-align: middle;'>
                              " . $an_status . "
                          </td>
                          </tr>
                        ";
                      }
                    } catch (PDOException $e) {
                      echo $e->getMessage();
                    }
                    mysqli_close($conn);
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </section>

    </div>
    <?php include 'includes/footer.php'; ?>
  </div>
  <!-- ./wrapper -->

  <?php include 'includes/scripts.php'; ?>
</body>

</html>