<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<?php
include 'includes/connection.php';

?>

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
                    <th>Disposal Registration ID</th>
                    <th>Client Detail</th>
                    <th>Total Card Points</th>
                    <th>Waste Type</th>
                    <th>Other Waste Type</th>
                    <th>Request Date</th>
                  </thead>
                  <tbody>
                    <?php
                    include 'includes/connection.php';

                    try {

                      $query_values = "SELECT wd.*,cd.username,cd.image,cd.state,cd.city FROM waste_deposit as wd, client_details as cd WHERE wd.client_id=cd.client_id";
                      $query_result = mysqli_query($conn, $query_values);
                      while ($row = mysqli_fetch_array($query_result)) {
                        $image1 = 'uploaded_images/client_images/' . $row['image'];
                        echo "
                          <tr>
                          <td style='vertical-align: middle; text-align: center;'>" . $row['waste_uniq_id'] . "</td>
                          <td style='vertical-align: middle;text-align: center;'>
                              <img src='" . $image1 . "' height='50px' width='50px' style='border-radius:20%'>
                              <p style='margin:0px;'>" . $row['username'] . "</p>
                              <p style='margin:0px;'>" . $row['city'] . ", " . $row['state'] . "</p>
                          </td>
                          <td style='vertical-align: middle; text-align: center;'>" . $row['total_card_points'] . "</td>
                          <td style='vertical-align: middle; text-align: center;'>" . $row['waste_type'] . "</td>
                          <td style='vertical-align: middle; text-align: center;'>" . $row['waste_type_other'] . "</td>
                          <td style='vertical-align: middle;text-align: center;'>" . date('M d, Y', strtotime($row['request_date'])) . "</td>
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
</body>

</html>