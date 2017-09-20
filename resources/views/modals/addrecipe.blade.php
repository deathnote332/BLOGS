
<!-- Modal -->
<div class="modal fade" id="modal_add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Recipe</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <input id='output' type="text" hidden>
                    <form class="form-add-recipe" id="form-add-recipe">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="formGroupExampleInput">Recipe Name</label>
                                    <input type="text" class="form-control" id="recipe" name="recipe" required="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="formGroupExampleInput">Quantity</label>
                                    <input type="text" class="form-control" id="qty"  name="qty">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="sel1">Select list:</label>
                                    <select class="form-control" id="ingre_id" name="ingre_id">
                                        <option selected></option>
                                        @foreach(App\Ingredient::get() as $sub)
                                            <option value="{{$sub->id}}">{{$sub->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-primary" id="btn">ADD</button>
                            </div>
                        </div>


                        <table class="table table-bordered" id="mtable">
                            <thead>
                            <tr>
                                <td>Qty</td>
                                <td>Name</td>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>

                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" >Close</button>
                <button type="button" class="btn btn-primary" id="save">Save</button>
            </div>
        </div>
    </div>
</div>

