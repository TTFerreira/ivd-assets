@extends('layouts.app')

@section('main-content')
  <div class="row">
    <div class="col-md-6 col-md-offset-3">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">{{$pageTitle}}</h3>
        </div>
        <div class="box-body">
          <form method="POST" action="{{ url('tickets') }}">
            {{csrf_field()}}
            <div class="form-group">
              <label for="user_id">Agent</label>
              <select class="form-control user_id" name="user_id">
                @foreach($users as $user)
                  <option value="{{$user->id}}"
                    @if($user->id == $ticketsCannedField->user_id)
                      selected
                    @endif
                  >{{$user->name}}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="location_id">Location</label>
              <select class="form-control location_id" name="location_id">
                @foreach($locations as $location)
                  <option value="{{$location->id}}"
                    @if($location->id == $ticketsCannedField->location_id)
                      selected
                    @endif
                  >{{$location->location_name}}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="ticket_status_id">Status</label>
              <select class="form-control ticket_status_id" name="ticket_status_id">
                @foreach($ticketsStatuses as $ticketStatus)
                  <option value="{{$ticketStatus->id}}"
                    @if($ticketStatus->id == $ticketsCannedField->ticket_status_id)
                      selected
                    @endif
                  >{{$ticketStatus->status}}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="ticket_type_id">Type</label>
              <select class="form-control ticket_type_id" name="ticket_type_id">
                @foreach($ticketsTypes as $ticketType)
                  <option value="{{$ticketType->id}}"
                    @if($ticketType->id == $ticketsCannedField->ticket_type_id)
                      selected
                    @endif
                  >{{$ticketType->type}}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="ticket_priority_id">Priority</label>
              <select class="form-control ticket_priority_id" name="ticket_priority_id">
                @foreach($ticketsPriorities as $ticketPriority)
                  <option value="{{$ticketPriority->id}}"
                    @if($ticketPriority->id == $ticketsCannedField->ticket_priority_id)
                      selected
                    @endif
                  >{{$ticketPriority->priority}}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="subject">Subject</label>
              <input type="text" class="form-control" name="subject" value="{{$ticketsCannedField->subject}}">
            </div>
            <div class="form-group">
              <label for="description">Description</label>
              <textarea class="form-control" rows="5" name="description">{{$ticketsCannedField->description}}</textarea>
            </div>

            <div class="form-group">
              <button type="submit" class="btn btn-primary">Add New Ticket</button>
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
      $(".subject").select2();
    });
  </script>
@endsection
