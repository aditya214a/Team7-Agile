<!-- Add -->
<div class="modal fade" id="card_register">
    <div class="modal-dialog" style="margin-top: 28rem;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><b>Enter Following Details</b></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="add_card.php" enctype="multipart/form-data">
                    <!-- aadhaar number -->
                    <div class="form-group">
                        <label for="passport_number" class="col-sm-4 control-label">Passport Number<color style="color:red; font-size:large;">*</color></label>
                        <div class="col-sm-8 modal-form">
                            <input type="text" class="form-control" id="passport_number" name="passport_number" placeholder="Enter Passport Numberr" required>
                        </div>
                    </div>
                    <!-- aadhaar photo -->
                    <div class="form-group">
                        <label for="passport_photo" class="col-sm-4 control-label">Passport Front Photo<color style="color:red; font-size:large;">*</color></label>
                        <div class="col-sm-8">
                            <input type="file" id="passport_photo" name="passport_photo" required>
                        </div>
                    </div>
                    <!-- Waste Type -->
                    <div class="form-group">
                        <label for="waste_type" class="col-sm-4 control-label">Waste Type<color style="color:red; font-size:large;">*</color></label>
                        <div class="col-sm-4 modal-form pr-0">
                            <input type="checkbox" id="household" name="check[]" value="Household Waste">
                            <label for="household" class="form-check-label">Household Waste</label><br>
                            <input type="checkbox" id="medical" name="check[]" value="Medical Waste">
                            <label for="medical" class="form-check-label">Medical Waste</label><br>
                        </div>
                        <div class="col-sm-4 modal-form pr-0 pl-0">
                            <input type="checkbox" id="agricultural" name="check[]" value="Agricultural Waste">
                            <label for="agricultural" class="form-check-label">Agricultural Waste</label><br>
                            <input type="checkbox" id="construction" name="check[]" value="Construction Waste">
                            <label for="construction" class="form-check-label">Construction Waste</label><br>
                        </div>
                    </div>
                    <!-- Enter Waste Details -->
                    <div class="form-group">
                        <label for="waste_details" class="col-sm-4 control-label">Waste Details</label>
                        <div class="col-sm-8 modal-form">
                            <input type="text" class="form-control" id="waste_details" name="waste_details" placeholder="Vegetables, Fruits, Masks etc.,">
                        </div>
                    </div>



                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger btn-lg" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                        <button type="submit" class="btn btn-primary btn-lg" id="add" name="add"><i class="fa fa-save"></i> Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>