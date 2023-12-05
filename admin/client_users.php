<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<?php
include 'includes/connection.php';

if (isset($_GET['client_id_a'])) {
  $client_active_id = @$_GET['client_id_a'];

  $update_client_query = "UPDATE client_details SET status=1 WHERE client_id=$client_active_id";
  $update_client_exec = mysqli_query($conn, $update_client_query);
  $_SESSION['success'] = "Client Status Updated Successfully.";
}
if (isset($_GET['client_id_d'])) {
  $client_deactive_id = @$_GET['client_id_d'];

  $update_client_query = "UPDATE client_details SET status=0 WHERE client_id=$client_deactive_id";
  $update_client_exec = mysqli_query($conn, $update_client_query);
  $_SESSION['success'] = "Client Status Updated Successfully.";
}

?>
<style>
  .c-active {
    color: green;
    font-weight: 600;
  }

  .c-deactive {
    font-weight: 600;
    color: orangered;
  }

  .btn-secondary {
    background-color: #666;
    border: 0px;
    color: white;
  }

  .btn-secondary:hover {
    color: white;
    background-color: #444;

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
          Client Users
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Client Users</li>
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
                    <th>Client ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Contact No</th>
                    <th>Residential Address</th>
                    <th>City</th>
                    <th>State</th>
                    <th>Image</th>
                    <th>Status</th>
                    <th>Created On Date</th>
                    <th>Tools</th>
                  </thead>
                  <tbody>
                    <?php
                    include 'includes/connection.php';

                    try {

                      $query_values = "SELECT * FROM client_details";
                      $query_result = mysqli_query($conn, $query_values);
                      while ($row = mysqli_fetch_array($query_result)) {
                        $image = 'uploaded_images/client_images/' . $row['image'];
                        if ($row['status'] == 0) {
                          $status = "Deactive";
                          $c_status = "c-deactive";
                          $ac_dc_status = '<a href="client_users.php?client_id_a=' . $row['client_id'] . '" style="margin-top: 4px;" class="btn btn-success btn-sm btn-lg"><i class="fa fa-check"></i> Activate</a>';
                        } else {
                          $status = "Active";
                          $c_status = "c-active";
                          $ac_dc_status = '<a href="client_users.php?client_id_d=' . $row["client_id"] . '" style="margin-top: 4px;" class="btn btn-secondary btn-sm btn-lg"><i class="fa fa-times"></i> Deactivate</a>';
                        }
                        echo "
                          <tr>
                          <td style='vertical-align: middle;'>" . $row['client_id'] . "</td>
                          <td style='vertical-align: middle;'>" . $row['username'] . "</td>
                          <td style='vertical-align: middle;'>" . $row['email'] . "</td>
                          <td style='vertical-align: middle;'>" . $row['contact_no'] . "</td>
                          <td style='vertical-align: middle;'>" . $row['residential_address'] . "</td>
                          <td style='vertical-align: middle;'>" . $row['city'] . "</td>
                          <td style='vertical-align: middle;'>" . $row['state'] . "</td>
                          <td style='vertical-align: middle;'>
                            <img src='" . $image . "' height='50px' width='50px' style='border-radius:20%'>
                          </td>
                          <td style='vertical-align: middle;' class=" . $c_status . ">" . $status . "</td>
                          <td style='vertical-align: middle;'>" . date('M d, Y', strtotime($row['created_on_date'])) . "</td>
                          <td style='vertical-align: middle;'>
                              <button class='btn btn-danger btn-sm delete btn-lg' data-id='" . $row['client_id'] . "'><i class='fa fa-trash'></i> Delete</button><br>
                              " . $ac_dc_status . "
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
    <?php include 'includes/client_users_modal.php'; ?>

  </div>
  <!-- ./wrapper -->

  <?php include 'includes/scripts.php'; ?>

  <script>
    $(function() {

      $(document).on('click', '.delete', function(e) {
        e.preventDefault();
        $('#delete').modal('show');
        var card_id = $(this).data('id');
        $("#delete #cardid").val(ard_id);
        return false;
      });
    });
  </script>
</body>

</html>