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
                    <form class="form-add-user" id="form-add-table">


                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="formGroupExampleInput">Table location</label>
                                    <input type="text" class="form-control" id="position" name="position"  required="">
                                </div>
                            </div>
                        </div>


                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" >Close</button>
                <button type="button" class="btn btn-primary" id="add-table">Add</button>
            </div>
        </div>
    </div>
</div>
