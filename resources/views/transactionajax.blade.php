<style>
.table-number{
		font-size: 18px;
		color: red;
	}
</style>

@foreach(App\Order::where('status',0)->where('transaction_date',date('Y-m-d'))->get() as $trans)
<div class="container-box">
    <div class="box" data-id="{{$trans->id}}">
        <div class="small-box">
            {{config('constant.order_stat_'.$trans->status)}}
        </div>
        <div class="small-box1">
            {{config('constant.order_stat_'.$trans->order_status)}}
        </div>
        <div class="large-box">
             <p class="table-number">Table# {{$trans->table_number}}</p>
            <span>P {{$trans->total}}</span>
            <p>{{$trans->created_at}}</p>

        </div>
    </div>
    <div class="content-box" style="background: #FFFBA9;border-radius: 0;height: 260px;overflow: auto;">
        <div class="container-dot"></div>
        @foreach(App\OrderItem::where('order_id',$trans->id)->get() as $order_item)
        <div class="list">
            <div class="col-md-12">
                <div class="checkbox">
                    <input id="{{'box'.$order_item->id}}" class="css-checkbox" type="checkbox"/>
                    <label for="{{'box'.$order_item->id}}" class="strikethrough"><b>{{$order_item->quantity}}</b>{{' '.App\Menu::find($order_item->menu_id)->food_name}}</label>
                </div>
            </div>
        </div>
        @endforeach
        <span class="note">
            -{{$trans->notes}}
        </span>
    </div>
</div>
@endforeach

<script>
    $(document).ready(function(){

        var BASEURL = $("#baseURL").val();


    })
</script>