@extends('layouts.app')

@section('content')

    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Update Patient
            </div>

            <div class="panel-body">

                <form action="/patients/update/{{$patient->id}}" method="POST">
                    {{ csrf_field() }}
                    @include('patients.form')
                </form>

            </div>
        </div>
    </div>

@endsection