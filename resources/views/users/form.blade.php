<div class="col-sm-12 form-horizontal">
    @include('components.errors')

    <div class="col-sm-12">
        <div class="form-group">
            <label class="control-label col-sm-2" for="profile[first_name]">First Name</label>
            <div class="col-sm-10">
                <input class="form-control" type="text" name="profile[first_name]" required
                       value='{{ isset( $user->profile['first_name'] ) ? $user->profile['first_name'] : "" }}'/>
            </div>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="form-group">
            <label class="control-label col-sm-2" for="profile[middle_name]">Middle Name</label>
            <div class="col-sm-10">
                <input class="form-control" type="text" name="profile[middle_name]" required
                       value='{{ isset( $user->profile['middle_name'] ) ? $user->profile['middle_name'] : "" }}'/>
            </div>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="form-group">
            <label class="control-label col-sm-2" for="profile[last_name]">Last Name</label>
            <div class="col-sm-10">
                <input class="form-control" type="text" name="profile[last_name]" required
                       value='{{ isset( $user->profile['last_name'] ) ? $user->profile['last_name'] : "" }}'/>
            </div>
        </div>
    </div>

    <div class="col-sm-12">
        <div class="form-group">
            <label class="control-label col-sm-2" for="email">E-mail Address</label>
            <div class="col-sm-10">
                <input class="form-control" type="email" name="email" placeholder="E-mail Address" required
                       value='{{ isset( $user->email ) ? $user->email : "" }}'/>
            </div>
        </div>
    </div>

    <div class="col-sm-12">
        <div class="form-group">
            <label class="control-label col-sm-2" for="profile[birthdate]">Birthdate</label>
            <div class="col-sm-10">
                <input class="form-control" type="date" name="profile[birthdate]" required
                       value='{{ isset( $user->profile['birthdate'] ) ? $user->profile['birthdate'] : "" }}'/>
            </div>
        </div>
    </div>

    <div class="col-sm-12">
        <div class="form-group">
            <label class="control-label col-sm-2" for="department_id">Department</label>
            <div class="col-sm-10">
                <select name="department_id" id="department_id">
                    @foreach($departments as $department)
                        <option value={{ $department->id }}>{{ $department->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div class="col-sm-12">
        <div class="form-group">
            <label class="control-label col-sm-2" for="user_role_id">User Role</label>
            <div class="col-sm-10">
                <select name="user_role_id" id="user_role_id">
                    @foreach($user_roles as $role)
                        <option value={{ $role->id }}>{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div class="col-sm-12">
        <div class="form-group">
            <label class="control-label col-sm-2" for="profile[gender]">Gender</label>
            <div class="col-sm-10">
                <select name="profile[gender]" id="gender">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
            </div>
        </div>
    </div>

    <div class="col-sm-12">
        <div class="form-group">
            <label class="control-label col-sm-2" for="profile[civil_status]">Civil Status</label>
            <div class="col-sm-10">
                <select name="profile[civil_status]" id="civil_status">
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