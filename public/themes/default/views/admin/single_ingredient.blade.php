<div class="content-box-large">

    <div class="panel-body">
        <div class="container-fluid">
            <form class="form-update-ingredient" id="form-update-ingredient">
                <input type="hidden" name="id" value="{{$data->id}}">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="formGroupExampleInput">Name</label>
                                    <input type="text" class="form-control" id="name1" name="name1" required="" value="{{$data->name}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="formGroupExampleInput">Quantity</label>
                                    <input type="text" class="form-control" id="name2" name="name2" required="" value="{{$data->quantity}}">
                                </div>
                            </div>
                        </div>
                        @if(Auth::user()->user_type == 1)
                            <button type="button" class="btn btn-primary update-btn pull-right" id="updatebtn">Adjust</button>
                        @endif
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

            var form = $('#form-update-ingredient');
            var form_data = new FormData(form[0]);

            form_data.append('_token', $('meta[name="csrf_token"]').attr('content'));


            if(form.valid()){
                $.ajax({
                    url : BASEURL + '/admin/update-ingredient',
                    type : 'POST',
                    data:form_data,
                    contentType: false,
                    processData: false,
                    success : function(data){
                        swal({
                            title: "",
                            text: "Ingredient updated successfully",
                            type:"success"
                        }).then(function () {

                        })
                    }
                });
            }
        })
        /*UPDATE*/


    })
</script>