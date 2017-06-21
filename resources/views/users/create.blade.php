@extends('layouts.app')

@section('content')
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Create Users
            </div>

            <div class="panel-body">

                <form action="/users/create" method="POST">
                    {{ csrf_field() }}
                    @include('users.form')
                </form>

            </div>
        </div>
    </div>
@endsection