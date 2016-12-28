@extends('layout')
@section('page-content')
    <form class="form-horizontal" role="form" method="POST" action="{{ url('login') }}">

        <div class="form-group">
            <label class="col-md-4 control-label">Username</label>
            <div class="col-md-6">
                <input class="form-control" name="username">
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-4 control-label">Password</label>
            <div class="col-md-6">
                <input type="password" class="form-control" name="password">
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-btn fa-sign-in"></i>Login
                </button>
            </div>
        </div>
    </form>

    @if($error)
        <div class="alert-danger" style="text-align: center">
            {{$error}}
        </div>
    @else
    @endif
@endsection