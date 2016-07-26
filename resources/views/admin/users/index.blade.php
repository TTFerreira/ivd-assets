@extends('layouts.app')

@section('main-content')
  <div class="row">
    <div class="col-md-9">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">{{$pageTitle}}</h3>
        </div>
        <div class="box-body">
          <table id="table" class="table table-striped table-bordered table-hover">
            <thead>
              <tr>
                <th>Name</th>
                <th>User's Role</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($users as $user)
                <tr>
                  <td>{{$user->name}}</td>
                  <td>
                    @foreach($usersRoles as $usersRole)
                      @if($user->id == $usersRole->user_id)
                        @foreach($roles as $role)
                          @if($role->id == $usersRole->role_id)
                            {{$role->display_name}}
                          @endif
                        @endforeach
                      @endif
                    @endforeach
                  </td>
                  <td><a href="/admin/users/{{ $user->id }}/edit" class="btn btn-primary"><span class='fa fa-edit' aria-hidden='true'></span> <b>Edit</b></a></td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Create New User</h3>
        </div>
        <div class="box-body">
          <form method="POST" action="{{ url('admin/users') }}">
            {{csrf_field()}}
            <div class="form-group {{ hasErrorForClass($errors, 'name') }}">
              <label for="name">Name</label>
              <input type="text" name="name" class="form-control" value="{{old('name')}}">
              {{ hasErrorForField($errors, 'name') }}
            </div>
            <div class="form-group {{ hasErrorForClass($errors, 'email') }}">
              <label for="email">Email</label>
              <input type="email" name="email" class="form-control" value="{{old('email')}}">
              {{ hasErrorForField($errors, 'email') }}
            </div>
            <div class="form-group {{ hasErrorForClass($errors, 'password') }}">
              <label for="password">Password</label>
              <input type="password" name="password" class="form-control">
              {{ hasErrorForField($errors, 'password') }}
            </div>

            <div class="form-group">
              <button type="submit" class="btn btn-primary"><span class='fa fa-user-plus' aria-hidden='true'></span> <b>Add New User</b></button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <script>
    $(document).ready(function() {
      $('#table').DataTable( {
        columnDefs: [ {
          orderable: false, targets: 1
        } ],
        order: [[ 0, "asc" ]]
      } );
    } );
  </script>
  @if(Session::has('status'))
    <script>
      $(document).ready(function() {
        Command: toastr["{{Session::get('status')}}"]("{{Session::get('message')}}", "{{Session::get('title')}}");
      });
    </script>
  @endif
@endsection
