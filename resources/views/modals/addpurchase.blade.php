<!-- Modal -->
<div class="modal fade" id="modal-purchase" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Purchase</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form class="form-add-menu" id="form-add-purchase">
                        <input type="hidden" name="id" id="ingre_id">
                        <div class="row">
                           <div class="col-md-12">
                               <div class="row">
                                   <div class="col-md-12">
                                       <div class="form-group">
                                           <label for="formGroupExampleInput">Quantity</label>
                                           <input type="number" class="form-control" id="name1" name="name1"  required="" value="0">
                                       </div>
                                   </div>
                               </div>
                           </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" >Close</button>
                <button type="button" class="btn btn-primary" id="add-purchase">Save changes</button>
            </div>
        </div>
    </div>
</div>

