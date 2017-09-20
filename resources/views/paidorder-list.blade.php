<style>
    .paid{
        margin-top: 20px;
    }
    .table-number{
        font-size: 18px;
        color: red;
    }
</style>
<ul>
    @foreach(App\Order::where('order_status',3)->where('status',1)->orderBy('created_at','asc')->get() as $trans)
        <li>
            <div class="box" data-id="{{$trans->id}}">
                @if(($trans->status === 0))
                    <div class="small-box">
                        Not Serve
                    </div>
                @else
                    <div class="small-box serve">
                        Serve
                    </div>
                @endif
                @if(($trans->order_status === 2))
                    <div class="small-box paid">
                        Not Paid
                    </div>
                @else
                    <div class="small-box serve paid">
                        Paid
                    </div>
                @endif

                <div class="large-box">
                    <p class="table-number">Table# {{$trans->table_number}}</p>
                    <span>P {{$trans->total}}</span>
                    <p>{{date('M d,Y h:i A',strtotime($trans->created_at))}}</p>

                </div>

            </div>
        </li>
    @endforeach
</ul>
<script>
    $('.box').on('click',function(){
        window.location.href = "transaction/" + $(this).data('id');
    })
</script>