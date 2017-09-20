
<div class="content-box-large">
    <input type="hidden" id="transaction_id" value="{{$transaction->id}}"/>
    <input type="hidden" id="transaction_table" value="{{$transaction->table_number}}"/>
    <div class="panel-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                   <address>
                       #1 Sampaguita Street<br>
                       De Castro Subdivision <br>
                       Barangay Sta.Lucia Pasig, Philippines <br>
                   </address>
                </div>
                <div class="col-md-6">
                    <div class="pull-right" style="text-align: right;margin-top: 12px;">
                        <p><strong>Order Date: </strong><i>{{ $transaction->created_at}}</i></p>
                        <p><strong>Order Status: </strong><i>{{config('constant.order_stat_'.$transaction->status)}}</i></p>
                        <p><strong>Purchase Status: </strong><i>{{config('constant.order_stat_'.$transaction->order_status)}}</i></p>
                        <p><strong>Order ID: </strong><i>{{'#'.$transaction->id}}</i></p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>Quantity</th>
                        <th>Menu Name</th>
                        <th>Price</th>
                        <th>Total</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach( \App\OrderItem::where('order_id',$transaction->id)->get() as $order_item)

                    <tr>
                        <td>{{$order_item->quantity}}</td>
                        <td>{{' '.App\Menu::find($order_item->menu_id)->food_name}}</td>
                        <td>{{'P'.App\Menu::find($order_item->menu_id)->price}}</td>
                        <td>{{'P'.App\Menu::find($order_item->menu_id)->price*$order_item->quantity}}</td>
                    </tr>
                    @endforeach
                    </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">

                </div>
                <div class="col-md-6">
                    <div class="pull-right" style="text-align: right;">
                        <p><strong>Sub-total: </strong><i>{{'P'.$transaction->total}}</i></p>
                        <h3>{{'P'.$transaction->total}}</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6"></div>
                <div class="col-md-6">
                    <div class="pull-right">
                        @if($transaction->order_status == 2)
                            <button type="button" class="btn btn-success" id="btn-paid">Checkout</button>
                        @endif
                        <button type="submit" class="btn btn-secondary" id="print" data-id="{{$transaction->id}}">PRINT</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>

    $(document).ready(function () {
        var BASEURL = $('#baseURL').val();
        $('#btn-paid').on('click',function () {
            changeToPaid()
        })

        $('#print').on('click',function () {
            var data = $(this).data('id');
            location.href = BASEURL + "/cashier/transaction/print/"+data;
        })

    })



    function changeToPaid(){

        var BASEURL = $('#baseURL').val();
        swal({
            title: "Are you sure?",
            text: "You want to save as paid this transaction",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: 'Okay'
        }).then(function () {
            $.ajax({
                url:BASEURL+'/cashier/changeToPaid',
                type:'POST',
                data: {
                    _token: $('meta[name="csrf_token"]').attr('content'),
                    id: $('#transaction_id').val(),
                    table_number: $('#transaction_table').val()
                },
                success: function(data){

                    swal({
                        title: "",
                        text: "Transaction save successfully",
                        type:"success"
                    }).then(function () {
                        location.href=BASEURL+'/cashier/cashier';
                    });



                }
            });
        });

    }

</script>