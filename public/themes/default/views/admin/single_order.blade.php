<div class="content-box-large">

    <div class="panel-body">
        <div class="container-fluid">
            <h2>Transaction # {{$data->id}}</h2>
            <form class="form-update-ingredient" id="form-order">

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="formGroupExampleInput">Waiter</label>
                            <input type="text" class="form-control" id="name1" name="name1" required="" value="{{\App\User::find($data->user_id)->first_name.' '. \App\User::find($data->user_id)->last_name}}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="formGroupExampleInput">Total</label>
                            <input type="text" class="form-control" id="name2" name="name2" required="" value="{{$data->total}}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="formGroupExampleInput">Status</label>
                            <input type="text" class="form-control" id="name2" name="name2" required="" value="{{config('constant.order_stat_'.$data->status)}}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="formGroupExampleInput">Purchase Order</label>
                            <input type="text" class="form-control" id="name2" name="name2" required="" value="{{config('constant.order_stat_'.$data->order_status)}}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="formGroupExampleInput">Transaction Date</label>
                            <input type="text" class="form-control" id="name2" name="name2" required="" value="{{$data->transaction_date}}">
                        </div>
                    </div>
                </div>

                    <h2>List  of Orders</h2>
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Quantity</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach(App\OrderItem::where('order_id',$data->id)->get() as $list)
                        <tr>
                            <td>{{App\Menu::find($list->menu_id)->food_name}}</td>
                            <td>{{App\Category::find(App\Menu::find($list->menu_id)->category_id)->name}}</td>
                            <td>{{$list->quantity}}</td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
            </form>
        </div>
    </div>
</div>