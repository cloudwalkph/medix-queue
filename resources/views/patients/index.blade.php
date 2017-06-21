@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="//cdn.datatables.net/v/bs/dt-1.10.15/sc-1.4.2/datatables.min.css">
@endsection

@section('scripts')
    <script src="//cdn.datatables.net/v/bs/dt-1.10.15/sc-1.4.2/datatables.min.js"></script>
    <script type="text/javascript">

        $(function() {

            var deleteId;

            var table = $('#patientTable').DataTable();

            var $that;

            $(document).on('click', '.deleteItem', function(e){
                deleteId = $(this).attr('data-item');
                $that = $(this);
            });

            $('.deleteBtn').on('click', function(e){
                console.log(deleteId);
                if (deleteId) {
                    var data = {
                        '_method': 'DELETE',
                        '_token': '{{ csrf_token() }}'
                    };

                    $.post('/patients/'+ deleteId, data, function(res){
                        console.log(res);
                        var rowSelected = $that.parent().parent();
                        table.row(rowSelected).remove().draw();
                    });
                }
            });
        });

    </script>
@endsection

@section('content')
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-6">
                        <h5>Patient</h5>
                    </div>
                    <div class="col-md-6 text-right">
                        <a href="/patients/create" class="btn btn-primary">
                            <i class="fa fa-plus" ></i> ADD NEW PATIENT
                        </a>
                    </div>
                </div>
            </div>

            <div class="panel-body">

                <table id="patientTable" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>Patient No</th>
                        <th>Name</th>
                        <th>Entry Date</th>
                        <th>Gender</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($patients as $patient)
                        <tr>
                            <td>{{ $patient->patient_no }}</td>
                            <td>{{  $patient->getFullNameAttribute() }}</td>
                            <td>{{ $patient->entry_date }}</td>
                            <td>{{ ucwords($patient->gender) }}</td>
                            <td>{{ $patient->created_at->toFormattedDateString() }}</td>
                            <td>
                                <a class="btn btn-default" href="/patients/update/{{$patient->id}}">
                                    <i class="fa fa-edit"></i> Edit
                                </a>
                                <button type="submit" id="delete" data-item="{{$patient->id}}"
                                        class="btn btn-danger deleteItem" data-toggle="modal" data-target="#deleteModal">
                                    <i class="fa fa-remove"></i> Delete
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Patient No</th>
                        <th>Name</th>
                        <th>Entry Date</th>
                        <th>Gender</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                    </tfoot>
                </table>

            </div>
        </div>
    </div>
    @include('patients.deleteModal')
@endsection