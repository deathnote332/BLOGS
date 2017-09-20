$(document).ready(function(){
    loadOrders()

    $('body').delegate('.btn-view','click',function(){
        window.location.href = "list_order/" + $(this).data('id');
    })
    function loadOrders(){
        $('#tbl-order').DataTable().destroy();
        $('#tbl-order').DataTable( {
            "bInfo" : false,
            "lengthChange": false,
            "pageLength":6,
            searching: true,
            "serverSide": false,
            "ajax": "switch-ajax-order",
            "columns": [
                {data: 'id', name: 'id'},
                {data: 'waiter', name: 'waiter'},
                {data: 'total', name: 'total'},
                {data: 'status', name: 'status'},
                {data: 'order_status', name: 'order_status'},
                {data: 'transaction_date', name: 'transaction_date'},
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
    var productout = $('#tbl-order').DataTable();
    productout.ajax.reload();
};