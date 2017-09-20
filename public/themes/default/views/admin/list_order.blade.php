{!! Theme::asset()->usePath()->add('list_order-css','/css/admin/list_order.css') !!}
{!! Theme::asset()->usePath()->add('list_order-js','/js/admin/list_order.js') !!}

<div class="col-md-12">
    <div class="content-box-large">
        <div class="panel-heading">
            <div class="panel-title">List of Orders</div>
        </div>
        <div class="panel-body">
            <table id="tbl-order" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th></th>
                    <th>Waiter</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Payment Status</th>
                    <th>Transaction Date</th>
                    <th>Action</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
</div>