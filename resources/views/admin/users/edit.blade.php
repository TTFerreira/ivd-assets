@extends('layouts.app')

@section('main-content')
  <div class="row">
    <div class="col-md-6 col-md-offset-3">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">{{$pageTitle}}</h3>
        </div>
        <div class="box-body">
          <form method="POST" action="/admin/users/{{$user->id}}">
            {{method_field('PATCH')}}
            {{csrf_field()}}
            <div class="form-group {{ hasErrorForClass($errors, 'name') }}">
              <label for="name">Name</label>
              <input type="text" name="name" class="form-control" value="{{$user->name}}">
              {{ hasErrorForField($errors, 'name') }}
            </div>
            <div class="form-group {{ hasErrorForClass($errors, 'email') }}">
              <label for="email">Email</label>
              <input type="text" name="email" class="form-control" value="{{$user->email}}">
              {{ hasErrorForField($errors, 'email') }}
            </div>
            <div class="form-group {{ hasErrorForClass($errors, 'password') }}">
              <label for="password">Password</label>
              <input type="password" name="password" class="form-control">
              {{ hasErrorForField($errors, 'password') }}
            </div>
            <div class="form-group {{ hasErrorForClass($errors, 'password_confirmation') }}">
              <label for="password_confirmation">Password</label>
              <input type="password" name="password_confirmation" class="form-control">
              {{ hasErrorForField($errors, 'password_confirmation') }}
            </div>

            @permission('change-role')
              <div class="form-group {{ hasErrorForClass($errors, 'role_id') }}">
                <label for="role_id">User's Role</label>
                <select class="form-control role_id" name="role_id">
                  @foreach($usersRoles as $usersRole)
                    @if($user->id == $usersRole->user_id)
                      @foreach($roles as $role)
                        <option
                          @if($role->id == $usersRole->role_id)
                            selected
                          @endif
                          value="{{$role->id}}">{{$role->display_name}}</option>
                      @endforeach
                    @endif
                  @endforeach
                </select>
                {{ hasErrorForField($errors, 'role_id') }}
              </div>
            @endpermission

            <div class="form-group">
              <button type="submit" class="btn btn-primary"><span class='fa fa-pencil' aria-hidden='true'></span> <b>Edit User</b></button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  @if(Session::has('status'))
    <script>
      $(document).ready(function() {
        Command: toastr["{{Session::get('status')}}"]("{{Session::get('message')}}", "{{Session::get('title')}}");
      });
    </script>
  @endif
@endsection
@section('footer')
  <script type="text/javascript">
    $(document).ready(function() {
      $(".role_id").select2();
    });
  </script>
@endsection
