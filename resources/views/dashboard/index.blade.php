@extends('layouts.app')

@section('scripts')
    <script>
        $(function() {
            $('#myTabs a').click(function (e) {
                e.preventDefault()
                $(this).tab('show')
            })
        });
    </script>
@endsection

@section('content')
<div>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
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


        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Appointments Today</div>

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
    </div>
</div>
@endsection
