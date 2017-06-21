@extends('layouts.app')

@section('content')

    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Update User
            </div>

            <div class="panel-body">

                <form action="/users/update/{{$user->id}}" method="POST">
                    {{ csrf_field() }}
                    @include('users.form')
                </form>

            </div>
        </div>
    </div>

@endsection