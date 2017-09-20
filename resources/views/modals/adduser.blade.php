<!-- Modal -->
<div class="modal fade" id="modal_add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form class="form-add-user" id="form-add-user">


                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="formGroupExampleInput">First Name</label>
                                            <input type="text" class="form-control" id="name1" name="name1"  required="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="formGroupExampleInput">Last Name</label>
                                            <input type="text" class="form-control" id="name1_1" name="name1_1"  required="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="formGroupExampleInput">Email</label>
                                            <input type="text" class="form-control" id="name2" name="name2"  required="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="formGroupExampleInput">Password</label>
                                            <input type="password" class="form-control" id="name3" name="name3"  required="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="formGroupExampleInput">Confirm Password</label>
                                            <input type="password" class="form-control" id="name4" name="name4"  required="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="formGroupExampleInput">User Type</label>
                                            <select class="form-control" id="name5" name="name5" required="">
                                                <option selected></option>
                                                <option value="1">Admin</option>
                                                <option value="2">Kitchen</option>
                                                <option value="3">Cashier</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" >Close</button>
                <button type="button" class="btn btn-primary" id="add-user">Save changes</button>
            </div>
        </div>
    </div>
</div>

