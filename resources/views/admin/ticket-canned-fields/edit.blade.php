@extends('layouts.app')

@section('main-content')
  <div class="row">
    <div class="col-md-6 col-md-offset-3">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">{{$pageTitle}}</h3>
        </div>
        <div class="box-body">
          <form method="POST" action="/admin/ticket-canned-fields/{{$ticketsCannedField->id}}/update">
            {{method_field('PATCH')}}
            {{csrf_field()}}
            <div class="form-group {{ hasErrorForClass($errors, 'user_id') }}">
              <label for="user_id">Agent</label>
              <select class="form-control user_id" name="user_id">
                <option value = ""></option>
                @foreach($users as $user)
                  <option value="{{$user->id}}"
                    @if($user->id == $ticketsCannedField->user_id)
                      selected
                    @endif
                  >{{$user->name}}</option>
                @endforeach
              </select>
              {{ hasErrorForField($errors, 'user_id') }}
            </div>
            <div class="form-group {{ hasErrorForClass($errors, 'location_id') }}">
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
              {{ hasErrorForField($errors, 'location_id') }}
            </div>
            <div class="form-group {{ hasErrorForClass($errors, 'ticket_status_id') }}">
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
              {{ hasErrorForField($errors, 'ticket_status_id') }}
            </div>
            <div class="form-group {{ hasErrorForClass($errors, 'ticket_type_id') }}">
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
              {{ hasErrorForField($errors, 'ticket_type_id') }}
            </div>
            <div class="form-group {{ hasErrorForClass($errors, 'ticket_priority_id') }}">
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
              {{ hasErrorForField($errors, 'ticket_priority_id') }}
            </div>
            <div class="form-group {{ hasErrorForClass($errors, 'subject') }}">
              <label for="subject">Subject</label>
              <input type="text" class="form-control" name="subject" value="{{$ticketsCannedField->subject}}">
              {{ hasErrorForField($errors, 'subject') }}
            </div>
            <div class="form-group {{ hasErrorForClass($errors, 'description') }}">
              <label for="description">Description</label>
              <textarea class="form-control" rows="5" name="description">{{$ticketsCannedField->description}}</textarea>
              {{ hasErrorForField($errors, 'description') }}
            </div>

            <div class="form-group">
              <button type="submit" class="btn btn-primary"><b>Edit Ticket Canned Fields</b></button>
            </div>
          </form>
        </div>
      </div>
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
