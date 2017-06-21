@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="//cdn.datatables.net/v/bs/dt-1.10.15/sc-1.4.2/datatables.min.css">
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
        });
    </script>
@endsection

@section('content')
<div style="padding: 0 20px">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">QUEUE Today</div>

                <div class="panel-body">
                    <ul class="nav nav-pills" role="tablist" id="myTabs">
                        <li role="presentation" class="active"><a href="#all">All <span class="badge">42</span></a></li>
                        <li role="presentation"><a href="#consultations">Consultations <span class="badge">3</span></a></li>
                        <li role="presentation"><a href="#laboratories">Laboratories <span class="badge">3</span></a></li>
                        <li role="presentation"><a href="#xrays">X-Rays <span class="badge">3</span></a></li>
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
                                    <th>Arrival Time</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>

                                <tbody>
                                <tr>
                                    <td></td>
                                    <td>Consultation</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
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
                                    <th>Arrival Time</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>

                                <tbody>
                                <tr>
                                    <td></td>
                                    <td>Consultation</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
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
                                    <th>Arrival Time</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>

                                <tbody>
                                <tr>
                                    <td></td>
                                    <td>Laboratories</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
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
                                    <th>Arrival Time</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>

                                <tbody>
                                <tr>
                                    <td></td>
                                    <td>X-Ray</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
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
                    Appointments Today

                    <button class="btn btn-primary btn-sm pull-right"
                            data-toggle="modal" data-target="#createAppointmentModal">Add Appointment</button>
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
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>


        <!-- Create Appointment Modal -->
        <div class="modal fade" id="createAppointmentModal" tabindex="-1" role="dialog" aria-labelledby="createAppointmentModalLabel">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="createAppointmentModalLabel">Create Appointment</h4>
                    </div>
                    <div class="modal-body">
                        <form>
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
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="control-label" for="appointment_date">APPOINTMENT DATE</label>
                                        <input class="form-control" type="date" name="appointment_date" required />
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="control-label" for="appointment_time">APPOINTMENT TIME</label>
                                        <input class="form-control" type="time" name="appointment_time" required />
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="control-label" for="chief_complaint">CHIEF COMPLAINT</label>
                                        <textarea class="form-control" name="chief_complaint" cols="30" rows="10" style="resize: none;"></textarea>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection