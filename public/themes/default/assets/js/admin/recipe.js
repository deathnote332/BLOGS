$(document).ready(function(){
    var BASEURL = $("#baseURL").val();

    loadRecipe();

    var lists = [];

    $('body').delegate('.btn-view','click',function(){
        window.location.href = "recipies/" + $(this).data('id');
    })

    $('#btn').on('click',function(){

        if($('#qty').val() == '' || $('#ingre_id').val() == '' ){
            swal({
                title: "",
                text: "Empty",
                type:"error"
            }).then(function () {

            })
        }else{
            var listdas = {};
            listdas.qty = $('#qty').val();
            listdas.id =  $('#ingre_id').val();
            lists.push(listdas);
            $("#output").val(JSON.stringify(lists));

            $('#mtable tbody').append($("#mtable tbody tr:last").clone());
            $('#mtable tbody tr:last td:nth-child(2)').html($("#ingre_id option:selected").text());
            $('#mtable tbody tr:last td:first').html($('#qty').val());

            $('#qty').val('');
            $('#ingre_id').val('');
        }

    })


    $('#save').on('click',function(e){
        e.stopPropagation();
        var list = $('#output').val();
        var recipe = $('#recipe').val();
        var form = $('#form-add-recipe');

        if(form.valid()) {
            swal({
                title: "Are you sure?",
                text: "You want to add this ingredient.",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: 'Okay',
                closeOnConfirm: false
            }).then(function () {
                $.ajax({
                    type: "POST",
                    url: BASEURL + "/admin/savers",
                    data: {
                        '_token': $('meta[name="csrf_token"]').attr('content'),
                        recipe: recipe,
                        list: list
                    }
                })
                    .done(function (data) {
                        location.reload()
                    })
            });

        }
    })



    $('#addbtn').on('click',function(){
        $('#modal_add').modal('show');
    })

    function loadRecipe(){
        $('#tbl-recipe').DataTable().destroy();
        $('#tbl-recipe').DataTable( {
            "bInfo" : false,
            "lengthChange": false,
            "pageLength":6,
            searching: true,
            "serverSide": false,
            "ajax": "switch-ajax-recipe",
            "columns": [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
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
    var productout = $('#tbl-recipe').DataTable();
    productout.ajax.reload();
};