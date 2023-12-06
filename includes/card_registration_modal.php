<!-- Add -->
<div class="modal fade" id="card_register">
    <div class="modal-dialog" style="margin-top: 28rem;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><b>Select the Following Waste Category That Garbage Out From Your Premises</b></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="add_card.php" enctype="multipart/form-data">
                    <!-- Waste Type -->
                    <div class="form-group">
                        <label for="waste_type" class="col-sm-4 control-label">Waste Type<color style="color:red; font-size:large;">*</color></label>
                        <div class="col-sm-4 modal-form pr-0">
                            <input type="checkbox" id="general" name="check[]" value="General Waste">
                            <label for="general" class="form-check-label">General Waste</label><br>
                            <input type="checkbox" id="recyclable" name="check[]" value="Recyclable Waste">
                            <label for="recyclable" class="form-check-label">Recyclable Waste</label><br>
                        </div>
                        <div class="col-sm-4 modal-form pr-0 pl-0">
                            <input type="checkbox" id="organic" name="check[]" value="Organic Waste">
                            <label for="organic" class="form-check-label">Organic Waste</label><br>
                            <input type="checkbox" id="e_waste" name="check[]" value="E-Waste">
                            <label for="e_waste" class="form-check-label">E-Waste</label><br>
                        </div>
                        <div class="col-sm-4"></div>
                        <div class="col-sm-4 modal-form">
                            <input type="checkbox" id="hazardous" name="check[]" value="Hazardous Waste">
                            <label for="hazardous" class="form-check-label">Hazardous Waste</label><br>
                            <input type="checkbox" id="others" name="check[]" value="Others">
                            <label for="others" class="form-check-label">Others</label><br>

                        </div>
                        <div class="col-sm-4 modal-form">
                            <input type="checkbox" id="medical" name="check[]" value="Medical Waste">
                            <label for="medical" class="form-check-label">Medical Waste</label><br>
                            <input type="text" id="otherCategory" name="otherCategory" class="form-control" placeholder="Enter Other Category" style="display: none;">
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

<script>
    document.getElementById('others').addEventListener('change', function() {
        var otherCategoryTextBox = document.getElementById('otherCategory');

        otherCategoryTextBox.style.display = this.checked ? 'block' : 'none';
    });
</script>