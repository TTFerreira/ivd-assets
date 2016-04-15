@extends('layouts.app')

@section('main-content')
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">{{$pageTitle}}</h3>
        </div>
        <div class="box-body">
          <p><a href="tickets/create"><button type="button" class="btn btn-default" name="create-new-ticket" data-toggle="tooltip" data-original-title="Create New Ticket"><span class='glyphicon glyphicon-plus' aria-hidden='true'></span> <b>Create New Ticket</b></button></a></p>
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
                    <td>{{$ticket->ticket_status->status}}</td>
                    <td>{{$ticket->ticket_priority->priority}}</td>
                    <td>{{$ticket->subject}}</td>
                    <td><a href="/tickets/{{ $ticket->id }}">View</a> | <a href="/tickets/{{ $ticket->id }}/edit">Edit</a></td>
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
        $('#table').DataTable( {
            columnDefs: [ {
                targets: [ 0 ],
                orderData: [ 0, 1 ]
            }, {
                targets: [ 1 ],
                orderData: [ 1, 0 ]
            }, {
                targets: [ 2 ],
                orderData: [ 2, 0 ]
            } ]
        } );
      } );
    </script>
@endsection
