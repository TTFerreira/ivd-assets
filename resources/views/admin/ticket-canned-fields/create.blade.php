@extends('layouts.app')

@section('main-content')
  <div class="row">
    <div class="col-md-6 col-md-offset-3">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">{{$pageTitle}}</h3>
        </div>
        <div class="box-body">
          <form method="POST" action="{{ url('admin/ticket-canned-fields') }}">
            {{csrf_field()}}
            <div class="form-group">
              <label for="user_id">Agent</label>
              <select class="form-control user_id" name="user_id">
                <option value = ""></option>
                @foreach($users as $user)
                    <option value="{{$user->id}}">{{$user->name}}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="location_id">Location</label>
              <select class="form-control location_id" name="location_id">
                <option value = ""></option>
                @foreach($locations as $location)
                    <option value="{{$location->id}}">{{$location->location_name}}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="ticket_status_id">Status</label>
              <select class="form-control ticket_status_id" name="ticket_status_id">
                <option value = ""></option>
                @foreach($ticketsStatuses as $ticketStatus)
                    <option value="{{$ticketStatus->id}}">{{$ticketStatus->status}}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="ticket_type_id">Type</label>
              <select class="form-control ticket_type_id" name="ticket_type_id">
                <option value = ""></option>
                @foreach($ticketsTypes as $ticketType)
                    <option value="{{$ticketType->id}}">{{$ticketType->type}}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="ticket_priority_id">Priority</label>
              <select class="form-control ticket_priority_id" name="ticket_priority_id">
                <option value = ""></option>
                @foreach($ticketsPriorities as $ticketsPriority)
                    <option value="{{$ticketsPriority->id}}">{{$ticketsPriority->priority}}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="subject">Subject</label>
              <input type="text" class="form-control" name="subject" value="{{old('subject')}}">
            </div>
            <div class="form-group">
              <label for="description">Description</label>
              <textarea class="form-control" rows="5" name="description">{{old('description')}}</textarea>
            </div>

            <div class="form-group">
              <button type="submit" class="btn btn-primary">Add New Ticket Canned Fields</button>
            </div>
          </form>
        </div>
      </div>

      @if(count($errors))
        <ul>
          @foreach($errors->all() as $error)
            <li>{{$error}}</li>
          @endforeach
        </ul>
      @endif
    </div>
  </div>
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
