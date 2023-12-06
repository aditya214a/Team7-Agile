<?php
include 'includes/session.php';
include 'includes/scripts.php';
include 'includes/connection.php';

#print($_SESSION['admin_id']);


$waste_uni_id = @$_POST['waste_uni_id'];
$waste_type = @$_POST['check'];
$waste_weight = @$_POST['waste_weight'];
$q1 = @$_POST['q1'];
$q2 = @$_POST['q2'];
$q3 = @$_POST['q3'];
$q4 = @$_POST['q4'];
$imp_feedback = @$_POST['imp_feedback'];

$waste_uni_idErr = $waste_typeErr  = $imp_feedbackErr = " ";

$dispoal_id_query = "SELECT waste_disposal_id FROM waste_deposit WHERE waste_uniq_id='$waste_uni_id' LIMIT 1";
$dispoal_id_result = mysqli_query($conn, $dispoal_id_query);
$dispoal_id_final = mysqli_fetch_assoc($dispoal_id_result);

if (isset($_POST['add'])) {

    if ($waste_uni_id == "") {
        $waste_uni_idErr = "* You Forgot to Enter waste_uni_id!";
    } else if (empty($waste_type)) {
        $waste_typeErr = "Atleast One Waste Type You Need to Select!";
    } elseif ($imp_feedback == "") {
        $imp_feedbackeErr = "* You Forgot to Enter Feedback!";
    } else {
        $now = date('Y-m-d h:i:sa');
        try {
            $gained_points = 0;
            $penalized_points = 0;

            $waste_type_full = "";
            $count_waste = count($waste_type);
            $count_min = $count_waste - 1;
            $i = 0;
            if ($waste_weight > 0) {
                if ($waste_weight > 2 && $waste_weight <= 4) {
                    $gained_points = 30;
                } elseif ($waste_weight > 4 && $waste_weight <= 6) {
                    $gained_points = 65;
                } elseif ($waste_weight > 6 && $waste_weight <= 15) {
                    $gained_points = 100;
                } elseif ($waste_weight > 1) {
                    $gained_points = 10;
                }
            } else {
                $gained_points = 0;
            }

            #gained and penalized calculations
            if ($gained_points > 0) {
                if ($q1 > 0) {
                    $gained_points += $q1;
                } elseif ($q1 < 0) {
                    $penalized_points += abs($q1); // Penalize for negative value
                }

                if ($q2 > 0) {
                    $gained_points += $q2;
                } elseif ($q2 < 0) {
                    $penalized_points += abs($q2); // Penalize for negative value
                }

                if ($q3 > 0) {
                    $gained_points += $q3;
                } elseif ($q3 < 0) {
                    $penalized_points += abs($q3); // Penalize for negative value
                }

                if ($q4 > 0) {
                    $gained_points += $q4;
                } elseif ($q4 < 0) {
                    $penalized_points += abs($q4); // Penalize for negative value
                }
            } else {
                $gained_points = 0;
                $penalized_points = 0;
                $total_points = 0;
            }

            #total points calculations
            $total_points = $gained_points - $penalized_points;

            if ($total_points >= 0) {
            } else {
                $gained_points = 0;
                $penalized_points = 0;
                $total_points = 0;
            }

            foreach ($waste_type as $waste_type_value) {
                $i++;
                if ($i <= $count_min) {
                    $waste_type_full = $waste_type_full . $waste_type_value . ", ";
                } else {
                    $waste_type_full = $waste_type_full . $waste_type_value;
                }
            }
            $query = "insert into iws_card_history (admin_id,waste_disposal_id,waste_type,waste_weight,gained_points,penalized_points,improve_feedback,total_points,history_created_date) values ({$_SESSION['admin_id']},{$dispoal_id_final['waste_disposal_id']},'$waste_type_full',$waste_weight,$gained_points,$penalized_points,'$imp_feedback',$total_points,'$now')";
            mysqli_query($conn, $query);
            $updateBalanceQuery = "UPDATE waste_deposit SET total_card_points=total_card_points + $total_points WHERE waste_uniq_id='$waste_uni_id'";
            mysqli_query($conn, $updateBalanceQuery);

            $_SESSION['success'] = 'Card History added successfully';
            mysqli_close($conn);
            header('location: iws_card_history.php');  // used for redirecting      
        } catch (Exception $e) {
            $_SESSION['error'] = $e->getMessage();
        }
    }
}
?>
<html>
<?php include 'includes/header.php'; ?>

<head>
    <style>
        input[type=checkbox],
        input[type=radio],
        input[type=file],
        select {
            cursor: pointer;
        }

        .form-check-label {
            cursor: pointer;
        }

        .question {
            display: flex;
        }
    </style>
</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

        <?php include 'includes/navbar.php'; ?>
        <?php include 'includes/menubar.php'; ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Create Card History
                </h1>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box" style="padding:30px;">
                            <form name="addform" class="form-horizontal needs-validation" method="POST" action="create_history.php" enctype="multipart/form-data" novalidate>

                                <div class="row form-group">

                                    <label for="waste_uni_id" class="col-sm-2 control-label">Scan Waste Disposal ID<color style="color:red; font-size:large;">*</color></label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="waste_uni_id" name="waste_uni_id" placeholder="Waste Disposal ID" value="<?php echo $waste_uni_id ?>" required>
                                        <p class="invalid"><?php if (isset($waste_uni_idErr)) echo $waste_uni_idErr; ?></p>
                                    </div>

                                    <label for="waste_type" class="col-sm-2 control-label">Waste Type<color style="color:red; font-size:large;">*</color></label>
                                    <div class="col-sm-2 modal-form pr-0">
                                        <input type="checkbox" id="general" name="check[]" value="General Waste">
                                        <label for="general" class="form-check-label">General Waste</label><br>
                                        <input type="checkbox" id="recyclable" name="check[]" value="Recyclable Waste">
                                        <label for="recyclable" class="form-check-label">Recyclable Waste</label><br>
                                    </div>
                                    <div class="col-sm-2 modal-form pr-0 pl-0">
                                        <input type="checkbox" id="organic" name="check[]" value="Organic Waste">
                                        <label for="organic" class="form-check-label">Organic Waste</label><br>
                                        <input type="checkbox" id="e_waste" name="check[]" value="E-Waste">
                                        <label for="e_waste" class="form-check-label">E-Waste</label><br>
                                    </div>
                                    <div class="col-sm-7"></div>
                                    <div class="col-sm-2 modal-form">
                                        <input type="checkbox" id="hazardous" name="check[]" value="Hazardous Waste">
                                        <label for="hazardous" class="form-check-label">Hazardous Waste</label><br>
                                        <input type="checkbox" id="others" name="check[]" value="Others">
                                        <label for="others" class="form-check-label">Others</label><br>
                                        <p class="invalid"><?php if (isset($waste_typeErr)) echo $waste_typeErr; ?></p>
                                    </div>
                                    <div class="col-sm-2 modal-form">
                                        <input type="checkbox" id="medical" name="check[]" value="Medical Waste">
                                        <label for="medical" class="form-check-label">Medical Waste</label><br>
                                        <input type="text" id="otherCategory" name="otherCategory" class="form-control" placeholder="Enter Other Category" style="display: none;">
                                    </div>
                                </div>

                                <div class="row form-group">

                                    <label for="waste_weight" class="col-sm-2 control-label">Waste Weight(lb)<color style="color:red; font-size:large;">*</color></label>

                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="waste_weight" name="waste_weight" placeholder="waste weight in lbs like 0.50 or 1 or 2 or 8" value="<?php echo $waste_weight ?>" required>
                                    </div>
                                </div>

                                <!-- Question 1 -->
                                <div class="row form-group">
                                    <label for="question1" class="col-sm-6 control-label question">Q1. While checking, did operator found any non-recyclable items from recyclable bag?<color style="color:red; font-size:large;">*</color></label>
                                    <div class="col-sm-2"></div>
                                    <div class="form-check form-check-inline col-sm-1">
                                        <input class="form-check-input" type="radio" name="q1" id="q1_y" value="-10">
                                        <label class="form-check-label" for="q1">Yes</label>
                                    </div>

                                    <div class="form-check form-check-inline col-sm-1">
                                        <input class="form-check-input" type="radio" name="q1" id="q1_n" value="+10" checked>
                                        <label class="form-check-label" for="q1">No</label>
                                    </div>
                                </div>
                                <!-- Question 2 -->
                                <div class="row form-group">
                                    <label for="question2" class="col-sm-8 control-label question">Q2. While checking, did operator found any hazardous materials in the General Waste or other inappropriate bags?<color style="color:red; font-size:large;">*</color></label>
                                    <div class="form-check form-check-inline col-sm-1">
                                        <input class="form-check-input" type="radio" name="q2" id="q2_y" value="-20">
                                        <label class="form-check-label" for="q2">Yes</label>
                                    </div>
                                    <div class="form-check form-check-inline col-sm-1">
                                        <input class="form-check-input" type="radio" name="q2" id="q2_n" value="+10" checked>
                                        <label class="form-check-label" for="q2">No</label>
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <label for="question3" class="col-sm-8 control-label question">Q3. While checking, did you found any waste that doesn't fit into above categories, but designated to "Other" bags?<color style="color:red; font-size:large;">*</color></label>

                                    <div class="form-check form-check-inline col-sm-1">
                                        <input class="form-check-input" type="radio" name="q3" id="q3_y" value="+5" checked>
                                        <label class="form-check-label" for="q3_y">Yes</label>
                                    </div>

                                    <div class="form-check form-check-inline col-sm-1">
                                        <input class="form-check-input" type="radio" name="q3" id="q3_n" value="-5">
                                        <label class="form-check-label" for="q3">No</label>
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <label for="question4" class="col-sm-8 control-label question">Q4. Did customer followed all the instructions provided for waste segregation in InfiGreen Guide?<color style="color:red; font-size:large;">*</color></label>

                                    <div class="form-check form-check-inline col-sm-1">
                                        <input class="form-check-input" type="radio" name="q4" id="q4_everything" value="+20" checked>
                                        <label class="form-check-label" for="q4">Everything</label>
                                    </div>

                                    <div class="form-check form-check-inline col-sm-1">
                                        <input class="form-check-input" type="radio" name="q4" id="q4_almost" value="+10">
                                        <label class="form-check-label" for="q4">Almost</label>
                                    </div>

                                    <div class="form-check form-check-inline col-sm-1">
                                        <input class="form-check-input" type="radio" name="q4" id="q4_nothing" value="-20">
                                        <label class="form-check-label" for="q4">Nothing</label>
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <label for="imp_feedback" class="col-sm-2 control-label">Feedback for Customer<color style="color:red; font-size:large;">*</color></label>
                                    <div class="col-sm-3">
                                        <textarea id="imp_feedback" style="resize:none;" class="form-control" placeholder="Enter the Improvement Feedback" name="imp_feedback" rows="4" cols="50"></textarea>
                                        <p class="invalid"><?php if (isset($imp_feedbackErr)) echo $imp_feedbackErr; ?></p>
                                    </div>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <a href="iws_card_history.php"><button type="button" class="btn btn-danger btn-flat" name="close"><i class="fa fa-close"></i> Close</button></a>
                            <button type="submit" class="btn btn-primary btn-flat" name="add" id="add"><i class="fa fa-save"></i> Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
            </section>

        </div>
        <?php include 'includes/footer.php'; ?>

    </div>
    <!-- ./wrapper -->

    <?php include 'includes/scripts.php'; ?>


</body>

</html>