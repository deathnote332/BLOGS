<style>
    #menuImage {
        width: 100%;
        height: 270px;
    }
    input#pic_menu {
        position: relative;
        top: 5px;
    }
</style>
<div class="content-box-large">

    <div class="panel-body">
        <div class="container-fluid">
            <form class="form-update-menu" id="form-update-menu">
                <input type="hidden" name="id" value="{{$data->id}}">
                <input type="hidden" name="empty" id="check_empty">
                <div class="row">
                    <div class="col-md-4">
                        <img id="menuImage" src="{{url($data->image)}}" />
                        @if(Auth::user()->user_type == 1)
                        <input type='file' class="file_class" id="pic_menu" data-file="{{$data->image}}"/>
                        @endif
                    </div>
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="formGroupExampleInput">Name</label>
                                    <input type="text" class="form-control" id="name1" name="name1" placeholder="Example input" required="" value="{{$data->food_name}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="formGroupExampleInput">Price</label>
                                    <input type="text" class="form-control" id="name2" name="name2"  placeholder="Example input" required="" value="{{$data->price}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="formGroupExampleInput">Status</label>
                                    <select class="form-control" id="name3" name="name3" required="">
                                        <option value="0" {{($data->status == 0)?'selected':''}}>Not Available</option>
                                        <option value="1" {{($data->status == 1)?'selected':''}}>Available</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="formGroupExampleInput">Category</label>
                                    <select class="form-control" id="name4" name="name4" required="">
                                        @foreach(App\Category::get() as $cat)
                                            <option value="{{$cat->id}}" {{($data->category_id == $cat->id)?'selected':''}}>{{$cat->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="formGroupExampleInput">Category</label>
                                    <select class="form-control" id="name5" name="name5" required="">
                                        @foreach(App\Recipe::get() as $recipe)
                                        <option value="{{$recipe->id}}" {{($data->recipe_id == $recipe->id)?'selected':''}}>{{$recipe->recipe_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        @if(Auth::user()->user_type == 1)
                        <button type="button" class="btn btn-primary update-btn pull-right" id="updatebtn">Update</button>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        var BASEURL = $("#baseURL").val();

        /*UPDATE*/
        $('#updatebtn').on('click',function(e){
            e.stopPropagation();

            var form = $('#form-update-menu');
            var form_data = new FormData(form[0]);

            form_data.append('file', $('#pic_menu')[0].files[0]);
            form_data.append('file_data', $('#pic_menu').data('file'));
            form_data.append('_token', $('meta[name="csrf_token"]').attr('content'));


            if($('#form-update-menu').valid()){
                $.ajax({
                    url : BASEURL + '/admin/update-menu',
                    type : 'POST',
                    data:form_data,
                    contentType: false,
                    processData: false,
                    success : function(data){
                        swal({
                            title: "",
                            text: "Menu updated successfully",
                            type:"success"
                        }).then(function () {

                        })
                    }
                });
            }
        })
        /*UPDATE*/

        /*FILE*/

        $(":file").change(function () {
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = imageIsLoaded;
                reader.readAsDataURL(this.files[0]);
                $('#check_empty').val('not');
            }
        });

        function imageIsLoaded(e) {
            $('#menuImage').attr('src', e.target.result);
        };
        /*FILE*/

    })
</script>