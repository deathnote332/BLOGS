{!! Theme::asset()->usePath()->add('graph-css','/css/admin/graph.css') !!}
{!! Theme::asset()->usePath()->add('graph-js','/js/admin/graph.js') !!}
<style>
    .total-sale,.order-serve span{
        font-size: 16px;
        font-weight: 700;
        color: #ff8495;
    }
    .order-serve{
        color: #000;
        font-size: 16px;
        font-weight: 700;
    }
</style>
<div class="content-box-large">
    <div class="panel-heading">
        <div class="panel-title">Sales Today</div>
    </div>
    <div class="panel-body">

        <div class="row">
            <div class="col-md-6">
                <div class="total-sale">
                    {{ 'P '. number_format( \App\Order::where('transaction_date',date('Y-m-d'))->select(DB::raw('sum(total) as total'))->first()->total,2) }}
                </div>

            </div>
            <div class="col-md-6">
                <div class="order-serve">
                    Order Serve Today: <span> {{ \App\Order::where('transaction_date',date('Y-m-d'))->count() }} </span>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="content-box-large">
    <div class="panel-heading">
        <div class="panel-title">Graph of Sales</div>
    </div>
    <div class="panel-body">

        <div class="row">
            <div class="col-md-4">
                <div class="form-group row">
                    <label for="example-text-input" class="col-2 col-form-label">Date from:</label>
                    <div class="col-10">
                        <input class="form-control datepicker" type="text" id="date_from">
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group row">
                    <label for="example-text-input" class="col-2 col-form-label">Date to:</label>
                    <div class="col-10">
                        <input class="form-control datepicker" type="text" id="date_to">
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <button class="btn btn-primary" id="graph-filter">Filter</button>
            </div>
        </div>
        <div class="chart-container" style="position: relative; height:20vh; width:60vw;margin: auto;">
            <canvas id="myChart"></canvas>
        </div>
    </div>
</div>
<div class="content-box-large">
    <div class="panel-heading">
        <div class="panel-title">Graph of Best Seller</div>
    </div>
    <div class="panel-body">

        <div class="row">
            <div class="col-md-4">
                <div class="form-group row">
                    <label for="example-text-input" class="col-2 col-form-label">Date from:</label>
                    <div class="col-10">
                        <input class="form-control datepicker" type="text" id="date_from_new">
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group row">
                    <label for="example-text-input" class="col-2 col-form-label">Date to:</label>
                    <div class="col-10">
                        <input class="form-control datepicker" type="text" id="date_to_new">
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <button class="btn btn-primary" id="graph-filter_new">Filter</button>
            </div>
        </div>
        <div class="chart-container" style="position: relative; height:20vh; width:60vw;margin: auto;">
            <canvas id="myChart_new"></canvas>
        </div>
    </div>
</div>



