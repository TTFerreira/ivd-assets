@extends('layouts.app')

@section('main-content')
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">{{$pageTitle}}</h3>
        </div>
        <div class="box-body">
          <p><a href="tickets/create"><button type="button" class="btn btn-default" name="create-new-ticket" data-toggle="tooltip" data-original-title="Create New Ticket"><span class='fa fa-plus' aria-hidden='true'></span> <b>Create New Ticket</b></button></a></p>
          <table id="table" class="table table-striped table-bordered table-hover">
            <thead>
              <tr>
                <th>Ticket Number</th>
                <th>Agent</th>
                <th>Location</th>
                <th>Status</th>
                <th>Priority</th>
                <th>Subject</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($tickets as $ticket)
                <tr>
                  <div>
                    <td>{{$ticket->id}}</td>
                    <td>{{$ticket->user->name}}</td>
                    <td>{{$ticket->location->location_name}}</td>
                    <td>
                      <div id="status{{$ticket->id}}">
                        @if($ticket->ticket_status->status == 'Open')
                          <span class="label label-success">
                        @elseif($ticket->ticket_status->status == 'Pending')
                          <span class="label label-info">
                        @elseif($ticket->ticket_status->status == 'Resolved')
                          <span class="label label-warning">
                        @elseif($ticket->ticket_status->status == 'Closed')
                          <span class="label label-danger">
                        @endif
                        {{$ticket->ticket_status->status}}</span>
                      </div>
                    </td>
                    <td>
                      <div id="priority{{$ticket->id}}"
                        @if($ticket->ticket_priority->priority == 'Low')
                          <span class="label label-success">
                        @elseif($ticket->ticket_priority->priority == 'Medium')
                          <span class="label label-warning">
                        @elseif($ticket->ticket_priority->priority == 'High')
                          <span class="label label-danger">
                        @endif
                        {{$ticket->ticket_priority->priority}}</span>
                      </div>
                    </td>
                    <td>{{$ticket->subject}}</td>
                    <td><a href="/tickets/{{ $ticket->id }}" class="btn btn-primary"><span class="fa fa-ticket" aria-hidden="true"></span> <b>View</b></a></td>
                  </div>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <script>
      $(document).ready(function() {
        var table = $('#table').DataTable( {
          columnDefs: [ {
            orderable: false, targets: 6
          } ],
          order: [[ 0, "desc" ]]
        } );
        // Get the status and priority columns' div IDs for each row.
        // If the status or priority is clicked on, then the datatable will filter that word.
        @foreach($tickets as $ticket)
          var status = (function() {
            var x = '#status' + {{$ticket->id}};
            return x;
          });
          $(status()).click(function () {
            table.search( "{{$ticket->ticket_status->status}}" ).draw();
          });

          var priority = (function() {
            var x = '#priority' + {{$ticket->id}};
            return x;
          });
          $(priority()).click(function () {
            table.search( "{{$ticket->ticket_priority->priority}}" ).draw();
          });
        @endforeach
      } );

    </script>
@endsection
