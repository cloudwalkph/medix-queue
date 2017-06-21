<div class="col-sm-12 form-horizontal">
    @include('components.errors')

    <div class="col-sm-12">
        <div class="form-group">
            <label class="control-label col-sm-2" for="first_name">First Name</label>
            <div class="col-sm-10">
                <input class="form-control" type="text" name="first_name" required
                       value='{{ isset( $patient->first_name ) ? $patient->first_name : "" }}'/>
            </div>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="form-group">
            <label class="control-label col-sm-2" for="middle_name">Middle Name</label>
            <div class="col-sm-10">
                <input class="form-control" type="text" name="middle_name"
                       value='{{ isset( $patient->middle_name ) ? $patient->middle_name : "" }}'/>
            </div>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="form-group">
            <label class="control-label col-sm-2" for="last_name">Last Name</label>
            <div class="col-sm-10">
                <input class="form-control" type="text" name="last_name" required
                       value='{{ isset( $patient->last_name ) ? $patient->last_name : "" }}'/>
            </div>
        </div>
    </div>

    <div class="col-sm-12">
        <div class="form-group">
            <label class="control-label col-sm-2" for="birthdate">Birthdate</label>
            <div class="col-sm-10">
                <input class="form-control" type="date" name="birthdate" required
                       value='{{ isset( $patient->birthdate ) ? $patient->birthdate : "" }}'/>
            </div>
        </div>
    </div>

    <div class="col-sm-12">
        <div class="form-group">
            <label class="control-label col-sm-2" for="gender">Gender</label>
            <div class="col-sm-10">
                <select name="gender" id="gender">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
            </div>
        </div>
    </div>

    <div class="col-sm-12">
        <div class="form-group">
            <label class="control-label col-sm-2" for="civil_status">Civil Status</label>
            <div class="col-sm-10">
                <select name="civil_status" id="civil_status">
                    <option value="single">Single</option>
                    <option value="married">Married</option>
                    <option value="divorced">Divorced</option>
                    <option value="widowed">Widowed</option>
                </select>
            </div>
        </div>
    </div>

    <div class="col-sm-12" style="text-align: right;">
        <a href="/users" class="btn btn-default">
            <i class="fa fa-arrow-left fa-lg"></i> Back
        </a>
        <button type="submit" class="btn btn-success">
            <i class="fa fa-check fa-lg"></i> Save
        </button>
    </div>

</div>



@section('scripts')
    <script>
        $(function() {
            $('#department_id').selectize({
                maxItems: 1,
                sortField: 'text'
            });
            $('#user_role_id').selectize({
                maxItems: 1,
                sortField: 'text'
            });
            $('#gender').selectize({
                maxItems: 1,
                sortField: 'text'
            });
            $('#civil_status').selectize({
                maxItems: 1,
                sortField: 'text'
            });
        });
    </script>
@endsection