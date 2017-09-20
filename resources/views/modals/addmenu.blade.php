<!-- Modal -->
<div class="modal fade" id="modal_add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form class="form-add-menu" id="form-add-menu">
                        <input type="hidden" name="empty" id="check_empty">
                        <div class="row">
                            <div class="col-md-4">
                                <img id="menuImage" src="{{url('images/empty.png')}}" alt="your image" />
                                <input type='file' class="file_class" id="pic_menu"/>
                            </div>
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="formGroupExampleInput">Name</label>
                                            <input type="text" class="form-control" id="name1" name="name1"  required="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="formGroupExampleInput">Status</label>
                                            <select class="form-control" id="name2" name="name2" required="" >
                                                <option selected></option>
                                                <option value="0">Not Available</option>
                                                <option value="1">Available</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="formGroupExampleInput">Price</label>
                                            <input type="text" class="form-control" id="name3" name="name3"   required="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="formGroupExampleInput">Category</label>
                                            <select class="form-control" id="name4" name="name4" required="">
                                                @foreach(App\Category::get() as $cat)
                                                    <option value="{{$cat->id}}">{{$cat->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="formGroupExampleInput">Recipe</label>
                                            <select class="form-control" id="name5" name="name5" required="">
                                                <option selected></option>
                                                @foreach(App\Recipe::get() as $recipe)
                                                <option value="{{$recipe->id}}">{{$recipe->recipe_name}}</option>
                                                @endforeach
                                            </select>
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
                <button type="button" class="btn btn-primary" id="add-menu">Save changes</button>
            </div>
        </div>
    </div>
</div>

