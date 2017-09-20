$(document).ready(function(){
    var BASEURL = $("#baseURL").val();
    loadMenu();

    $('#addbtn').on('click',function(){
        $('#modal_add').modal('show');
    })

    $('body').delegate('.btn-delete','click',function(){

        var id = $(this).data('id');

        swal({
            title: "Are you sure?",
            text: "You want to delete this menu.",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: 'Okay',
            closeOnConfirm: false
        }).then(function () {
            $.ajax({
                url : BASEURL + '/admin/delete-menu',
                type : 'POST',
                data:{
                    _token: $('meta[name="csrf_token"]').attr('content'),
                    id: id
                },
                success : function(data){
                    swal({
                        title: "",
                        text: "Menu deleted successfully",
                        type:"success"
                    }).then(function () {
                        console.log(data);
                        loadMenu()
                    })

                }
            });
        });

    })

    $(":file").change(function () {
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = imageIsLoaded;
            reader.readAsDataURL(this.files[0]);
            $('#check_empty').val('not');
        }
    });

    $('#add-menu').on('click',function(e){
        e.stopPropagation();

        var form = $('#form-add-menu');
        var form_data = new FormData(form[0]);

        form_data.append('file', $('#pic_menu')[0].files[0]);
        form_data.append('_token', $('meta[name="csrf_token"]').attr('content'));

        if($('#form-add-menu').valid()){
            $.ajax({
                url : BASEURL + '/admin/add-menu',
                type : 'POST',
                data:form_data,
                contentType: false,
                processData: false,
                success : function(data){
                    swal({
                        title: "",
                        text: "Menu added successfully",
                        type:"success"
                    }).then(function () {
                        console.log(data);
                        form[0].reset();
                        loadMenu()
                        $('#modal_add').modal('hide');
                    })

                }
            });
        }

    })
    $('body').delegate('.btn-view','click',function(){
        window.location.href = "menu/" + $(this).data('id');
    })
    function loadMenu(){
        $('#tbl-menu').DataTable().destroy();
        $('#tbl-menu').DataTable( {
            "bInfo" : false,
            "lengthChange": false,
            "pageLength":6,
             searching: true,
            "serverSide": false,
            "ajax": "switch-ajax-menu",
            "columns": [
                {data: 'img', name: 'img'},
                {data: 'name', name: 'name'},
                {data: 'price', name: 'price'},
                {data: 'status', name: 'status'},
                {data: 'category', name: 'category'},
                {data: 'recipe', name: 'recipe'},
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

    function imageIsLoaded(e) {
        $('#menuImage').attr('src', e.target.result);
    };


})

//New error event handling has been added in Datatables v1.10.5
$.fn.dataTable.ext.errMode = function ( settings, helpPage, message ) {
    console.log(message);
    var productout = $('#tbl-menu').DataTable();
    productout.ajax.reload();
};
