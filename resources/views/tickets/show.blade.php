@extends('layouts.app')

@section('main-content')
  <div class="row">
    <div class="col-md-9">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">{{$pageTitle}}</h3>
        </div>
          <div class="box-body no-padding">
            <div class="mailbox-read-info">
              <h3>{{$ticket->subject}}</h3>
              <h5>{{$ticket->user->name}}
                <?php $createdDate = \Carbon\Carbon::parse($ticket->created_at); ?>
                <span class="mailbox-read-time pull-right">Ticket logged on {{$createdDate->format('l, j F Y, H:i')}}</span></h5>
            </div>
            <div class="mailbox-read-message">
              {!! nl2br($ticket->description) !!}
            </div>
            <!-- /.mailbox-read-message -->
            <hr>
          <ul class="timeline">
            @foreach($ticketEntries as $ticketEntry)
							<?php $createdDate = \Carbon\Carbon::parse($ticketEntry->created_at); ?>
					    <!-- timeline item -->
					    <li>
				        <!-- timeline icon -->
				        <i class="fa fa-user bg-blue"></i>
				        <div class="timeline-item">
			            <span class="time">{{$createdDate->format('l, j F Y, H:i')}}</span>

			            <h3 class="timeline-header">{{$ticketEntry->user->name}}</h3>

			            <div class="timeline-body">
										<dl class="dl-horizontal">
				              <dt>Note:</dt><dd>{{$ticketEntry->note}}</dd>
										</dl>
			            </div>
			            <div class="timeline-footer">
			            </div>
				        </div>
				    	</li>
					    <!-- END timeline item -->
            @endforeach
					</ul>
          <div class="box-footer">
            <button type="button" class="btn btn-default" id='note'><i class="fa fa-pencil"></i> Add Note</button>
            <div id='new-note' style='display: none'>
              <form method="POST" action="/tickets/{{$ticket->id}}">
                {{csrf_field()}}
                <div class="form-group">
                  <label for="note">New Note</label>
                  <textarea name="note" class="form-control" rows="5">{{old('note')}}</textarea>
                </div>

                <div class="form-group">
                  <button type="submit" class="btn btn-primary">Add New Note</button>
                </div>
              </form>
            </div>
          </div>
          <div class="text-center"><a class="btn btn-primary" href="{{ URL::previous() }}">Back</a></div><br>
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
    <div class="col-md-3">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Ticket Details</h3>
        </div>
        <div class="box-body">
          <form method="POST" action="/tickets/{{$ticket->id}}/update">
            {{method_field('PATCH')}}
            {{csrf_field()}}
            <div class="form-group">
              <label for="user_id">Agent</label>
              <select class="form-control user_id" name="user_id">
                @foreach($users as $user)
                  <option
                    @if($ticket->user_id == $user->id)
                      selected
                    @endif
                  value="{{$user->id}}">{{$user->name}}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="location_id">Location</label>
              <select class="form-control location_id" name="location_id">
                <option value = ""></option>
                @foreach($locations as $location)
                  <option
                    @if($ticket->location_id == $location->id)
                      selected
                    @endif
                  value="{{$location->id}}">{{$location->location_name}}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="ticket_status_id">Status</label>
              <select class="form-control ticket_status_id" name="ticket_status_id">
                <option value = ""></option>
                @foreach($ticketsStatuses as $ticketStatus)
                  <option
                    @if($ticket->ticket_status_id == $ticketStatus->id)
                      selected
                    @endif
                  value="{{$ticketStatus->id}}">{{$ticketStatus->status}}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="ticket_type_id">Type</label>
              <select class="form-control ticket_type_id" name="ticket_type_id">
                <option value = ""></option>
                @foreach($ticketsTypes as $ticketType)
                  <option
                    @if($ticket->ticket_type_id == $ticketType->id)
                      selected
                    @endif
                  value="{{$ticketType->id}}">{{$ticketType->type}}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="ticket_priority_id">Priority</label>
              <select class="form-control ticket_priority_id" name="ticket_priority_id">
                <option value = ""></option>
                @foreach($ticketsPriorities as $ticketPriority)
                  <option
                    @if($ticket->ticket_priority_id == $ticketPriority->id)
                      selected
                    @endif
                  value="{{$ticketPriority->id}}">{{$ticketPriority->priority}}</option>
                @endforeach
              </select>
            </div>

            <div class="form-group">
              <button type="submit" class="btn btn-primary">Update Ticket</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <script>
  $("#note").click(function() {
    $("#new-note").toggle('1500');
  });
</script>
@endsection
