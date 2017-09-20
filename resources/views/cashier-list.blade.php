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
    <?php $count = App\Order::where('status',1)->where('order_status',2)->where('transaction_date',date('Y-m-d'))->count(); ?>
    @if($count == 0)
        <li>
            <div class="box text-center" style="padding-top: 30px;color:red;">
                NO ORDER SERVE
            </div>
        </li>
    @else
        @foreach(App\Order::where('status',1)->where('order_status',2)->where('transaction_date',date('Y-m-d'))->get() as $trans)
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
    @endif


</ul>
<script>
    $('.box').on('click',function(){
        window.location.href = "transaction/" + $(this).data('id');
    })
</script>