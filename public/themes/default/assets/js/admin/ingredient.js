$(document).ready(function(){
    var BASEURL = $("#baseURL").val();

    loadIngredient();

    $('#addbtn').on('click',function(){
        $('#modal_add').modal('show');
    })


    $('body').delegate('.btn-purchase','click',function(){
        var id = $(this).data('id');
        $('#ingre_id').val(id);
        $('#modal-purchase').modal('show');
    })


    $('body').delegate('.btn-view','click',function(){
        window.location.href = "ingredient/" + $(this).data('id');
    })

    $('#add-ingredient').on('click',function(e){
        e.stopPropagation();

        var form = $('#form-add-ingredient');
        var form_data = new FormData(form[0]);
        form_data.append('_token', $('meta[name="csrf_token"]').attr('content'));

        if($('#form-add-ingredient').valid()){
                $.ajax({
                    url : BASEURL + '/admin/add-ingredient',
                    type : 'POST',
                    data:form_data,
                    contentType: false,
                    processData: false,
                    success : function(data){
                        swal({
                            title: "",
                            text: "Ingredient added successfully",
                            type:"success"
                        }).then(function () {
                            console.log(data);
                            form[0].reset();
                            loadIngredient();
                            $('#modal_add').modal('hide');
                        })

                    }
                });
        }
    })

    $('#add-purchase').on('click',function(e){
        e.stopPropagation();

        var form = $('#form-add-purchase');
        var form_data = new FormData(form[0]);
        form_data.append('_token', $('meta[name="csrf_token"]').attr('content'));

        if($('#form-add-ingredient').valid()){
            $.ajax({
                url : BASEURL + '/admin/add-purchase',
                type : 'POST',
                data:form_data,
                contentType: false,
                processData: false,
                success : function(data){
                    swal({
                        title: "",
                        text: "Purchase added successfully",
                        type:"success"
                    }).then(function () {
                        console.log(data);
                        form[0].reset();
                        loadIngredient();
                        $('#modal-purchase').modal('hide');
                    })

                }
            });
        }
    })

    $('body').delegate('.btn-delete','click',function(){

        var id = $(this).data('id');

        swal({
            title: "Are you sure?",
            text: "You want to delete this ingredient.",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: 'Okay',
            closeOnConfirm: false
        }).then(function () {
            $.ajax({
                url : BASEURL + '/admin/delete-ingredient',
                type : 'POST',
                data:{
                    _token: $('meta[name="csrf_token"]').attr('content'),
                    id: id
                },
                success : function(data){
                    swal({
                        title: "",
                        text: "Ingredient deleted successfully",
                        type:"success"
                    }).then(function () {
                        console.log(data);
                        loadIngredient()
                    })

                }
            });
        });

    })

    function loadIngredient(){
        $('#tbl-ingredient').DataTable().destroy();
        $('#tbl-ingredient').DataTable( {
            "bInfo" : false,
            "lengthChange": false,
            "pageLength":6,
            searching: true,
            "serverSide": false,
            "ajax": "switch-ajax-ingredient",
            "columns": [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'quantity', name: 'price'},
                {data: 'action', name: 'action'}
            ],
            "language": {
                "paginate": {
                    "previous": "< Previous",
                    "next": "Next >"
                }
            }
        });
    }
})

//New error event handling has been added in Datatables v1.10.5
$.fn.dataTable.ext.errMode = function ( settings, helpPage, message ) {
    console.log(message);
    var productout = $('#tbl-ingredient').DataTable();
    productout.ajax.reload();
};