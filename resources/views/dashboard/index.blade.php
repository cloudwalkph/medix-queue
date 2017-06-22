@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="//cdn.datatables.net/v/bs/dt-1.10.15/sc-1.4.2/datatables.min.css">
    <style>
        #patientName {
            font-weight: 600;
        }
    </style>
@endsection

@section('scripts')
    <script src="//cdn.datatables.net/v/bs/dt-1.10.15/sc-1.4.2/datatables.min.js"></script>
    <script>
        $(function() {
            $('.table').DataTable();

            $('#myTabs a').click(function (e) {
                e.preventDefault()
                $(this).tab('show')
            })

            $('#users').selectize({
                maxItems: 1,
                sortField: 'text'
            });

            $('.add-to-queue').on('click', function() {
                let patientName = $(this).data('patient');
                let appointmentId = $(this).data('appointment');

                $('#patientName').html(patientName);
                $('#appointmentId').val(appointmentId);

                console.log(appointmentId);
            });

            $('.btn-call-queue').on('click', function() {
                $('.btn').prop('disabled', true);

                let queueId = $(this).data('queue');
                $('.queue-id').val(queueId);
                $('#callForm').submit();
            });

            $('.btn-arrived-queue').on('click', function() {
                $('.btn').prop('disabled', true);

                let queueId = $(this).data('queue');
                $('.queue-id').val(queueId);
                $('#arrivedForm').submit();
            });

            $('.btn-complete-queue').on('click', function() {
                $('.btn').prop('disabled', true);

                let queueId = $(this).data('queue');
                $('.queue-id').val(queueId);
                $('#completedForm').submit();
            });
        });
    </script>
@endsection

@section('content')
<div style="padding: 0 20px">
    <div class="row">

        @if (Auth::user()->role->slug === 'admin')
            <div class="col-md-12">

            @include('components.success')

            <div class="panel panel-default">
                <div class="panel-heading"><h5>QUEUE Today</h5></div>

                <div class="panel-body">
                    <ul class="nav nav-pills" role="tablist" id="myTabs">
                        <li role="presentation" class="active"><a href="#all">All <span class="badge">{{ $queues->count() }}</span></a></li>
                        <li role="presentation"><a href="#consultations">Consultations <span class="badge">{{ $queues->where('facility', 'consultation')->count() }}</span></a></li>
                        <li role="presentation"><a href="#laboratories">Laboratories <span class="badge">{{ $queues->where('facility', 'laboratory')->count() }}</span></a></li>
                        <li role="presentation"><a href="#xrays">X-Rays <span class="badge">{{ $queues->where('facility', 'xray')->count() }}</span></a></li>
                    </ul>

                    <br>

                    <div class="tab-content">
                        <div class="tab-pane active" role="tabpanel" id="all">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>Queue #</th>
                                    <th>Facility</th>
                                    <th>Patient Name</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>

                                <tbody>
                                    @foreach($queues as $queue)
                                        <tr>
                                            <td>{{ $queue->queue_number }}</td>
                                            <td>{{ ucwords($queue->facility) }}</td>
                                            <td>{{ $queue->appointment->patient->full_name }}</td>
                                            <td>{{ $queue->status }}</td>
                                            <td></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="tab-pane" role="tabpanel" id="consultations">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>Queue #</th>
                                    <th>Facility</th>
                                    <th>Patient Name</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($queues as $queue)
                                    @if ($queue->facility === 'consultation')
                                        <tr>
                                            <td>{{ $queue->queue_number }}</td>
                                            <td>{{ ucwords($queue->facility) }}</td>
                                            <td>{{ $queue->appointment->patient->full_name }}</td>
                                            <td>{{ $queue->status }}</td>
                                            <td></td>
                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="tab-pane" role="tabpanel" id="laboratories">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>Queue #</th>
                                    <th>Facility</th>
                                    <th>Patient Name</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($queues as $queue)
                                    @if ($queue->facility === 'laboratory')
                                        <tr>
                                            <td>{{ $queue->queue_number }}</td>
                                            <td>{{ ucwords($queue->facility) }}</td>
                                            <td>{{ $queue->appointment->patient->full_name }}</td>
                                            <td>{{ $queue->status }}</td>
                                            <td></td>
                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="tab-pane" role="tabpanel" id="xrays">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>Queue #</th>
                                    <th>Facility</th>
                                    <th>Patient Name</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($queues as $queue)
                                    @if ($queue->facility === 'xray')
                                        <tr>
                                            <td>{{ $queue->queue_number }}</td>
                                            <td>{{ ucwords($queue->facility) }}</td>
                                            <td>{{ $queue->appointment->patient->full_name }}</td>
                                            <td>{{ $queue->status }}</td>
                                            <td></td>
                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6">
                                <h5>Appointments Today</h5>
                            </div>
                            <div class="col-md-6 text-right">
                                <button class="btn btn-primary"
                                        data-toggle="modal" data-target="#createAppointmentModal"><i class="fa fa-plus" ></i> Add Appointment</button>
                            </div>
                        </div>
                    </div>

                    <div class="panel-body">

                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Patient Name</th>
                                <th>Encoded By</th>
                                <th>Appointment Date/Time</th>
                                <th>Chief Complaint</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach ($appointments as $appointment)
                                <tr>
                                    <td>{{ $appointment->patient->full_name }}</td>
                                    <td>{{ $appointment->user->profile->full_name }}</td>
                                    <td>{{ \Carbon\Carbon::createFromTimestamp(strtotime($appointment->appointment_date . ' ' . $appointment->appointment_time))->format('F d, Y - h:i A') }}</td>
                                    <td>{{ $appointment->chief_complaint }}</td>
                                    <td>{{ $appointment->status }}</td>
                                    <td>
                                        @if ($appointment->status === 'pending')
                                            <button class="btn btn-block btn-warning add-to-queue"
                                                    data-toggle="modal" data-target="#addPatientToQueueModal"
                                                    data-patient="{{ $appointment->patient->full_name }}"
                                                    data-appointment="{{ $appointment->id }}">
                                                Add to queue
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>

        @else
            <div class="col-md-12">

                @include('components.success')

                <div class="panel panel-default">
                    <div class="panel-heading"><h5>QUEUE Today</h5></div>

                    <div class="panel-body">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Queue #</th>
                                <th>Facility</th>
                                <th>Patient Name</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($queues as $queue)
                                @if ($queue->facility === Auth::user()->department->slug)
                                <tr>
                                    <td>{{ $queue->queue_number }}</td>
                                    <td>{{ ucwords($queue->facility) }}</td>
                                    <td>{{ $queue->appointment->patient->full_name }}</td>
                                    <td>{{ $queue->status }}</td>
                                    <td>
                                        @if ($queue->status === 'available')
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <button class="btn btn-block btn-warning btn-call-queue"
                                                        type="button"
                                                        data-queue="{{ $queue->id }}">
                                                        Notify
                                                    </button>
                                                </div>

                                                <div class="col-md-6">
                                                    <button class="btn btn-block btn-primary btn-arrived-queue"
                                                        type="button"
                                                        data-queue="{{ $queue->id }}">
                                                        Arrived
                                                    </button>
                                                </div>
                                            </div>
                                        @elseif ($queue->status === 'on-going')
                                            <button class="btn btn-block btn-success btn-complete-queue"
                                                    type="button"
                                                    data-queue="{{ $queue->id }}">
                                                Complete
                                            </button>
                                        @else
                                            LOCK
                                        @endif
                                    </td>
                                </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <form action="/queues/call" method="POST" id="callForm">
                    {{ csrf_field() }}
                    <input type="hidden" name="queue_id" class="queue-id">
                </form>

                <form action="/queues/arrived" method="POST" id="arrivedForm">
                    {{ csrf_field() }}
                    <input type="hidden" name="queue_id" class="queue-id">
                </form>

                <form action="/queues/completed" method="POST" id="completedForm">
                    {{ csrf_field() }}
                    <input type="hidden" name="queue_id" class="queue-id">
                </form>
            </div>
        @endif

        <!-- Create Appointment Modal -->
        <div class="modal fade" id="createAppointmentModal" tabindex="-1" role="dialog" aria-labelledby="createAppointmentModalLabel">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="createAppointmentModalLabel">Create Appointment</h4>
                    </div>
                    <form method="POST" action="">
                        <div class="modal-body">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="control-label" for="patient_id">PATIENT NAME</label>
                                        <select name="patient_id" id="users">
                                            @foreach($patients as $patient)
                                                <option value="{{ $patient->id }}">{{ $patient->getFullNameAttribute() }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                {{--<div class="col-sm-6">--}}
                                    {{--<div class="form-group">--}}
                                        {{--<label class="control-label" for="appointment_date">APPOINTMENT DATE</label>--}}
                                        {{--<input class="form-control" type="date" name="appointment_date" required />--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="col-sm-6">--}}
                                    {{--<div class="form-group">--}}
                                        {{--<label class="control-label" for="appointment_time">APPOINTMENT TIME</label>--}}
                                        {{--<input class="form-control" type="time" name="appointment_time" required />--}}
                                    {{--</div>--}}
                                {{--</div>--}}

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="control-label" for="chief_complaint">CHIEF COMPLAINT</label>
                                        <textarea class="form-control" name="chief_complaint" cols="30" rows="10" style="resize: none;"></textarea>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label><input type="checkbox" name="addToQueue" value="1"> Add to queue</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Create Appointment</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Add patient to queue Modal -->
        <div class="modal fade" id="addPatientToQueueModal" tabindex="-1" role="dialog" aria-labelledby="addPatientToQueueModalLabel">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="addPatientToQueueModalLabel">Add to Queue</h4>
                    </div>
                    <form method="POST" action="/queues">
                        <div class="modal-body">
                            {{ csrf_field() }}
                            <h4>Are you sure to add <span id="patientName"></span> into the queue?</h4>
                            <input type="hidden" name="appointment_id" id="appointmentId">
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Confirm</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection