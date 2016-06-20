@extends('layouts.app')

@section('main-content')
  <div class="row">
    <div class="col-md-6">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">{{$pageTitle}}</h3>
        </div>
        <div class="box-body">
          <table id="table" class="table table-striped table-bordered table-hover">
            <thead>
              <tr>
                <th>Subject</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($ticketsCannedFields as $ticketCannedField)
                <tr>
                  <div>
                    <td>{{$ticketCannedField->subject}}</td>
                    <td><a href="/admin/ticket-canned-fields/{{ $ticketCannedField->id }}/edit" class="btn btn-primary"><span class='fa fa-pencil' aria-hidden='true'></span> <b>Edit</b></a></td>
                  </div>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Create Canned Ticket Fields</h3>
        </div>
        <div class="box-body">
          <form method="POST" action="{{ url('admin/ticket-canned-fields') }}">
            {{csrf_field()}}
            <div class="form-group {{ hasErrorForClass($errors, 'user_id') }}">
              <label for="user_id">Agent</label>
              <select class="form-control user_id" name="user_id">
                <option value = ""></option>
                @foreach($users as $user)
                    <option value="{{$user->id}}">{{$user->name}}</option>
                @endforeach
              </select>
              {{ hasErrorForField($errors, 'user_id') }}
            </div>
            <div class="form-group {{ hasErrorForClass($errors, 'location_id') }}">
              <label for="location_id">Location</label>
              <select class="form-control location_id" name="location_id">
                <option value = ""></option>
                @foreach($locations as $location)
                    <option value="{{$location->id}}">{{$location->location_name}}</option>
                @endforeach
              </select>
              {{ hasErrorForField($errors, 'location_id') }}
            </div>
            <div class="form-group {{ hasErrorForClass($errors, 'ticket_status_id') }}">
              <label for="ticket_status_id">Status</label>
              <select class="form-control ticket_status_id" name="ticket_status_id">
                <option value = ""></option>
                @foreach($ticketsStatuses as $ticketStatus)
                    <option value="{{$ticketStatus->id}}">{{$ticketStatus->status}}</option>
                @endforeach
              </select>
              {{ hasErrorForField($errors, 'ticket_status_id') }}
            </div>
            <div class="form-group {{ hasErrorForClass($errors, 'ticket_type_id') }}">
              <label for="ticket_type_id">Type</label>
              <select class="form-control ticket_type_id" name="ticket_type_id">
                <option value = ""></option>
                @foreach($ticketsTypes as $ticketType)
                    <option value="{{$ticketType->id}}">{{$ticketType->type}}</option>
                @endforeach
              </select>
              {{ hasErrorForField($errors, 'ticket_type_id') }}
            </div>
            <div class="form-group {{ hasErrorForClass($errors, 'ticket_priority_id') }}">
              <label for="ticket_priority_id">Priority</label>
              <select class="form-control ticket_priority_id" name="ticket_priority_id">
                <option value = ""></option>
                @foreach($ticketsPriorities as $ticketsPriority)
                    <option value="{{$ticketsPriority->id}}">{{$ticketsPriority->priority}}</option>
                @endforeach
              </select>
              {{ hasErrorForField($errors, 'ticket_priority_id') }}
            </div>
            <div class="form-group {{ hasErrorForClass($errors, 'subject') }}">
              <label for="subject">Subject</label>
              <input type="text" class="form-control" name="subject" value="{{old('subject')}}">
              {{ hasErrorForField($errors, 'subject') }}
            </div>
            <div class="form-group {{ hasErrorForClass($errors, 'description') }}">
              <label for="description">Description</label>
              <textarea class="form-control" rows="5" name="description">{{old('description')}}</textarea>
              {{ hasErrorForField($errors, 'description') }}
            </div>

            <div class="form-group">
              <button type="submit" class="btn btn-primary"><b>Add New Ticket Canned Fields</b></button>
            </div>
          </form>
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
@section('footer')
  <script type="text/javascript">
    $(document).ready(function() {
      $(".user_id").select2();
      $(".location_id").select2();
      $(".ticket_status_id").select2();
      $(".ticket_type_id").select2();
      $(".ticket_priority_id").select2();
    });
  </script>
@endsection
