<!-- Update Photo -->
<div class="modal fade" id="edit_photo">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><b><span class="fullname"></span></b></h4>
            </div>
            <div class="modal-body">
                <form id="frmUserPhoto" class="form-horizontal" method="POST" action="edit_user_detail.php"
                    enctype="multipart/form-data">
                    <input type="hidden" class="photoid" id="photoid" name="photoid">
                    <div class="form-group">
                        <label for="photo" class="col-sm-3 control-label">Photo</label>

                        <div class="col-sm-9">
                            <input type="file" id="photo" name="photo" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger btn-lg pull-left" data-dismiss="modal"><i
                        class="fa fa-close"></i> Close</button>
                        <button type="submit" class="btn btn-success btn-lg" id="updatephoto" name="updatephoto"><i
                        class="fa fa-check-square-o"></i> Update Photo</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Update Name -->
<div class="modal fade" id="edit_name">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><b><span class="fullname"></span></b></h4>
            </div>
            <div class="modal-body">
                <form id="frmUserName" class="form-horizontal" method="POST" action="edit_user_detail.php"
                    enctype="multipart/form-data">
                    <input type="hidden" class="nameid" id="nameid" name="nameid">
                    <div class="form-group">
                        <label for="username" class="col-sm-3 control-label">Username</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="username" name="username" placeholder="Username"
                                required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger btn-lg pull-left" data-dismiss="modal"><i
                        class="fa fa-close"></i> Close</button>
                        <button type="submit" class="btn btn-success btn-lg" id="updatename" name="updatename"><i
                        class="fa fa-check-square-o"></i> Update Username</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Update Address -->
<div class="modal fade" id="edit_address">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><b><span class="fullname"></span></b></h4>
            </div>
            <div class="modal-body">
                <form id="frmUserAddress" class="form-horizontal" method="POST" action="edit_user_detail.php"
                    enctype="multipart/form-data">
                    <input type="hidden" class="addressid" id="addressid" name="addressid">
                    <div class="form-group">
                        <label for="address" class="col-sm-3 control-label">Address</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="address" name="address" placeholder="Delivery Address"
                                required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger btn-lg pull-left" data-dismiss="modal"><i
                        class="fa fa-close"></i> Close</button>
                        <button type="submit" class="btn btn-success btn-lg" id="updateaddress" name="updateaddress"><i
                        class="fa fa-check-square-o"></i> Update Address</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Update City-->
<div class="modal fade" id="edit_city">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="edit_user_detail.php">
                    <div class="form-group">
                        <label for="city" class="col-sm-3 control-label">Select City</label>
                        <div class="col-sm-9">
                            <select id="city" name="city" class="form-control" style="cursor:pointer;margin-bottom:10px;height: 4rem;">
                                <option>--- Select City ---</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger btn-lg" data-dismiss="modal"><i
                                class="fa fa-close"></i> Close</button>
                        <button type="submit" class="btn btn-success btn-lg" id="updatecity" name="updatecity"><i
                                class="fa fa-check-square-o"></i> Update CIty</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Update Sate-->
<div class="modal fade" id="edit_state">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="edit_user_detail.php">
                    <input type="hidden" class="stateid" id="stateid" name="stateid">
                    <div class="form-group">
                        <label for="state" class="col-sm-3 control-label">Select State</label>
                        <div class="col-sm-9">
                            <select id="state" name="state" class="form-control" style="cursor:pointer;margin-bottom:10px;height: 4rem;">
                                <option>--- Select State ---</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger btn-lg" data-dismiss="modal"><i
                                class="fa fa-close"></i> Close</button>
                        <button type="submit" class="btn btn-success btn-lg" name="updatestate" id="updatestate"><i
                                class="fa fa-check-square-o"></i> Update State</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Update Contact -->
<div class="modal fade" id="edit_contact">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><b><span class="fullname"></span></b></h4>
            </div>
            <div class="modal-body">
                <form id="frmUserContact" class="form-horizontal" method="POST" action="edit_user_detail.php"
                    enctype="multipart/form-data">
                    <input type="hidden" class="contactid" id="contactid" name="contactid">
                    <div class="form-group">
                        <label for="contact" class="col-sm-3 control-label">Contact</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="contact" name="contact" placeholder="Contact Number"
                                required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger btn-lg pull-left" data-dismiss="modal"><i
                        class="fa fa-close"></i> Close</button>
                        <button type="submit" class="btn btn-success btn-lg" id="updatecontact" name="updatecontact"><i
                        class="fa fa-check-square-o"></i> Update Contact</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
