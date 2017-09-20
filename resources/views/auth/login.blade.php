@extends('layouts.app')

@section('content')
<div id="wrapper-login">
    <div class="panel-body">
        <div class="container-login">
            <div class="logo-container">
                <img src="{{url('../../../../../images/logo.png')}}" height="100%" width="100%">
            </div>
            <div class="form-container">
                <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email" autofocus>

                            @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif

                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">


                            <input id="password" type="password" class="form-control" name="password" placeholder="Password" required>

                            @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif

                    </div>

                    <div class="form-group">
                        <div class="button-container">
                            <button type="submit" class="btn btn-login">
                                Login
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <ul id="notes"></ul>
    </div>
</div>

@endsection


