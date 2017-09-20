<!DOCTYPE html>
<html>
    <head>
        <title>{!! Theme::get('title') !!}</title>
        <meta charset="utf-8">
        <meta name="keywords" content="{!! Theme::get('keywords') !!}">
        <meta name="csrf_token" content="{{ csrf_token() }}">
        <meta name="description" content="{!! Theme::get('description') !!}">
        {!! Theme::asset()->styles() !!}
        {!! Theme::asset()->scripts() !!}
    </head>
    <body>
        <input type="hidden" id="baseURL" value="{{ url('') }}" >
        <div class="header">
            <div class="container">
                <div class="row">
                    <div class="col-md-5">
                        <!-- Logo -->
                    </div>
                    <div class="col-md-5"></div>
                    <div class="col-md-2">
                        <div class="navbar navbar-inverse" role="banner">
                            <nav class="collapse navbar-collapse bs-navbar-collapse navbar-right" role="navigation">

                                <ul class="nav navbar-nav">
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{Auth::user()->first_name.' '.Auth::user()->last_name}}<b class="caret"></b></a>
                                        <ul class="dropdown-menu animated fadeInUp">
                                            <li><a href="/logout">Logout</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="page-content">
            <div class="row">
                <div class="col-md-3">
                    <div class="sidebar content-box" style="display: block;">
                        <div class="logo">
                            <img src="{{url('images/logo.png')}}" width="100%" height="100%">
                        </div>
                        <ul class="nav">
                            <!-- Main menu -->
                            @if(Auth::user()->user_type == 1)
                                <li class="{{ (Request::is('admin/list_order')) ? 'current' : '' }}"><a href="{{url('admin/list_order')}}"><i class="fa fa-cart-plus fa-lg"></i>Orders</a></li>
                                <li class="{{ (Request::is('admin/menus')) ? 'current' : '' }}"><a href="{{url('admin/menus')}}"><i class="fa fa-list fa-lg"></i>Menus</a></li>
                                <li class="{{ (Request::is('admin/ingredients')) ? 'current' : '' }}"><a href="{{url('admin/ingredients')}}"><i class="fa fa-cart-arrow-down fa-lg"></i>Ingredients</a></li>
                                <li class="{{ (Request::is('admin/recipies')) ? 'current' : '' }}"><a href="{{url('admin/recipies')}}"><i class="fa fa-folder"></i>Recipies</a></li>
                                <li class="{{ (Request::is('admin/graphs')) ? 'current' : '' }}"><a href="{{url('admin/graphs')}}"><i class="fa fa-bar-chart fa-lg"></i>Graph</a></li>
                                <li class="{{ (Request::is('admin/users')) ? 'current' : '' }}"><a href="{{url('admin/users')}}"><i class="fa fa-user-plus"></i>Users</a></li>
                                <li class="{{ (Request::is('admin/tables')) ? 'current' : '' }}"><a href="{{url('admin/tables')}}"><i class="fa fa-plus"></i>Manage Table</a></li>
                            @endif

                            @if(Auth::user()->user_type == 2)
                                <li class="{{ (Request::is('kitchen/orders')) ? 'current' : '' }}"><a href="{{url('kitchen/orders')}}"><i class="fa fa-cart-plus fa-lg"></i>Orders</a></li>
                                <li class="{{ (Request::is('kitchen/menus')) ? 'current' : '' }}"><a href="{{url('kitchen/menus')}}"><i class="fa fa-list fa-lg"></i>Menus</a></li>
                                <li class="{{ (Request::is('kitchen/ingredients')) ? 'current' : '' }}"><a href="{{url('kitchen/ingredients')}}"><i class="fa fa-folder"></i>Ingredients</a></li>
                            @endif


                            @if(Auth::user()->user_type == 3)
                                <li class="{{ (Request::is('cashier/cashier')) ? 'current' : '' }}"><a href="{{url('cashier/cashier')}}"><i class="fa fa-cart-plus fa-lg"></i>Serve Orders</a></li>
                                <li class="{{ (Request::is('cashier/paidorders')) ? 'current' : '' }}"><a href="{{url('cashier/paidorders')}}"><i class="fa fa-cart-plus fa-lg"></i>Paid Orders</a></li>
                            @endif
                    </div>
                </div>
                <div class="col-md-9">
                    {!! Theme::content() !!}
                </div>
            </div>
        </div>

        {!! Theme::asset()->container('footer')->scripts() !!}
    </body>
</html>
