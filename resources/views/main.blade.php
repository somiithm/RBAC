@extends('layout')
@section('page-content')
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Url</th>
                <th>Link</th>
            </tr>

        </thead>
        <tbody>
        @foreach($routes as $route)
            <tr>
            <td>{{$route->uri()}}</td>
            <td><a href="{{$route->uri()}}">click</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection