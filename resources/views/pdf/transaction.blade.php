<title>BLOGS</title>
<div class="header">
    <div class="header-title">
        <i>#1 Sampaguita Street<br>
            De Castro Subdivision <br>
            Barangay Sta.Lucia Pasig, Philippines <br>
        </i>
    </div>
    <div class="header-right">
        <div class="row">
            <label class="question">Order Date:</label>
            <span class="answer"> {{ !empty($transac['created_at']) ? $transac['created_at'] : '-' }}</span>
        </div>
        <div class="row">
            <label class="question">Order Status:</label>
            <span class="answer"> {{ !empty($transac['status']) ?config('constant.order_stat_'.$transac['status']) : '-' }}</span>
        </div>
        <div class="row">
            <label class="question">Purchase Status:</label>
            <span class="answer"> {{ !empty($transac['order_status']) ?config('constant.order_stat_'.$transac['order_status']) : '-' }}</span>
        </div>
        <div class="row">
            <label class="question">Order ID:</label>
            <span class="answer"> {{ !empty($transac['id']) ? $transac['id'] : '-' }}</span>
        </div>
    </div>
</div>
<body>
<div class="form">
    <div class="row">
        <table id="example" class="table" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>Quantity</th>
                <th>Menu Name</th>
                <th>Price</th>
                <th>Total</th>
            </tr>
            </thead>
            <tbody>
            @foreach(App\OrderItem::where('order_id',$transac['id'])->get() as $order_item)
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
    <div class="row">
        <div class="header-title">
        </div>
        <div class="header-right" style="text-align: right;padding-top: 12px">
            <div class="row">
                <label class="question">Sub-total: </label>
                <span class="answer"> {{ !empty($transac['total']) ? "P".$transac['total'] : '-' }}</span>
            </div>
        </div>
    </div>
</div>

</body>


<style>
    .block {display: block;}
    .form-title{text-align: center; text-decoration: underline;}
    table{ width: 100%;font-size: 10px}
    table th,table td{text-align: left; text-transform: uppercase; }
    .header-right{display: inline-block; width: 49%;}
    .header-title{display: inline-block; width: 49%; font-size: 10px;}
    .form-group{padding-bottom: 10px;}
    .row{ clear: left;}
    .header{width: 100%; margin-top: 0; margin-bottom: 10px; padding-bottom: 10px; border-bottom: 1px solid #c3c3c3}
    .image-container{width: 200px;}
    .header img{width: 100%;}
    .form-group{margin: 10px 0 15px; width: 100%; }
    body{font-family: 'Helvetica'; font-size: 13px; margin-top: 0; }
    .question{font-weight: bold; font-size: 10px;}
    .answer{font-weight: normal; font-size: 10px; padding-left: 0; padding-left: 5px;}
    .answer.block{padding-top: 10px;}
    .col-12{ width: 100%;}
    .col-6{float: left; width: 50%;}
    .col-5{float: left; width: 41.66%;}
    .col-3{float: left; width: 25%;}
    .col-4{float: left; width: 33.33%;}
</style>