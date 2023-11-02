<!-- Update -->
<div class="modal fade" id="edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><b>Update Balance</b></h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="iws_card_details_update.php" enctype="multipart/form-data">
                    <div class="form-group">

                        <input type="hidden" class="card_id" id="card_id" name="id">
                        <!-- select waste disposal id -->
                        <label for="waste_disposal_id" class="col-sm-5 control-label">Select Waste Disposal ID</label>
                        <div class="col-sm-6">
                            <select id="waste_disposal_id" name="waste_disposal_id" class="form-control" style="cursor:pointer;margin-bottom:10px;">
                                <option>--- Select Waste Disposal ID ---</option>
                            </select>
                        </div>

                        <!-- enter waste weight -->
                        <label for="waste_weight" class="col-sm-5 control-label">Waste Weight</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="waste_weight" name="waste_weight" placeholder="waste weight" required>
                        </div>

                        <!-- enter account balance -->
                        <label for="card_balance" class="col-sm-5 control-label mt-2">Points Balance</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="card_balance" name="card_balance" placeholder="card balance" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger btn-flat" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                        <button type="submit" class="btn btn-primary btn-flat" id="update" name="update"><i class="fa fa-check-square-o"></i> Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>