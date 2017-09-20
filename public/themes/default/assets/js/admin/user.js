$(document).ready(function(){
    var BASEURL = $("#baseURL").val();
    loadUser();
    
    $('#add-btn').on('click',function(){
        $('#modal_add').modal('show');
    })

    $('#add-user').on('click',function(e){
        e.stopPropagation();

        var form = $('#form-add-user');
        var form_data = new FormData(form[0]);

        form_data.append('_token', $('meta[name="csrf_token"]').attr('content'));

        if(form.valid()){
            $.ajax({
                url : BASEURL + '/admin/add-user',
                type : 'POST',
                data:form_data,
                contentType: false,
                processData: false,
                success : function(data){
                    swal({
                        title: "",
                        text: "User added successfully",
                        type:"success"
                    }).then(function () {
                        form[0].reset();
                        loadUser()
                        $('#modal_add').modal('hide');
                    })
                }
            });
        }
    })

    function loadUser(){
        $('#tbl-user').DataTable().destroy();
        $('#tbl-user').DataTable( {
            "bInfo" : false,
            "lengthChange": false,
            "pageLength":6,
             searching: true,
            "serverSide": false,
            "ajax": "switch-ajax-user",
            "columns": [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'user_type', name: 'user_type'}
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
    var productout = $('#tbl-user').DataTable();
    productout.ajax.reload();
};