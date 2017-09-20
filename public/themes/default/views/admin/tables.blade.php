{!! Theme::asset()->usePath()->add('user-css','/css/admin/user.css') !!}


<div class="col-md-12">

    <div class="content-box-large">
        <div class="panel-heading">
            <div class="panel-title">List of Users</div>
        </div>
        <div class="panel-body">
            <button type="button" class="btn btn-primary add-btn" id='add-btn'>Add Table</button>
            <table id="tbl-table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>Table #</th>
                    <th>Location</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

@include('modals.addtable')

<script>
    var BASEURL = $("#baseURL").val();
    $(document).ready(function () {
        loadTable()

        $('#add-btn').on('click',function(){
            $('#modal_add').modal('show');
        })

        $('#add-table').on('click',function(e){

            e.stopPropagation();

            var form = $('#form-add-table');
            var form_data = new FormData(form[0]);

            form_data.append('_token', $('meta[name="csrf_token"]').attr('content'));

            if(form.valid()){
                $.ajax({
                    url : BASEURL + '/admin/addtable',
                    type : 'POST',
                    data:form_data,
                    contentType: false,
                    processData: false,
                    success : function(data){
                        swal({
                            title: "",
                            text: "Table added successfully",
                            type:"success"
                        }).then(function () {
                            form[0].reset();
                            loadTable()
                            $('#modal_add').modal('hide');
                        })
                    }
                });
            }
        })

    })


    function loadTable(){
        $('#tbl-table').DataTable().destroy();
        $('#tbl-table').DataTable( {
            "bInfo" : false,
            "lengthChange": false,
            "pageLength":6,
            searching: true,
            "serverSide": false,
            "ajax": "switch-ajax-table",
            "columns": [
                {data: 'id', name: 'id'},
                {data: 'table_location', name: 'name'},

            ],
            "language": {
                "paginate": {
                    "previous": "< Previous",
                    "next": "Next >"
                }
            }
        });
    }

    //New error event handling has been added in Datatables v1.10.5
    $.fn.dataTable.ext.errMode = function ( settings, helpPage, message ) {
        console.log(message);
        var table = $('#tbl-table').DataTable();
        table.ajax.reload();
    };

</script>
