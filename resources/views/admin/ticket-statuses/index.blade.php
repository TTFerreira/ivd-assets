@extends('layouts.app')

@section('main-content')
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">{{$pageTitle}}</h3>
        </div>
        <div class="box-body">
          <p><a href="/admin/ticket-statuses/create"><button type="button" class="btn btn-default" name="create-new-ticket-status" data-toggle="tooltip" data-original-title="Create New Ticket Status"><span class='fa fa-plus' aria-hidden='true'></span> <b>Create New Ticket Status</b></button></a></p>
          <table id="table" class="table table-striped table-bordered table-hover">
            <thead>
              <tr>
                <th>Ticket Status</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($ticketsStatuses as $ticketsStatus)
                <tr>
                  <div>
                    <td>{{$ticketsStatus->status}}</td>
                    <td><a href="/admin/ticket-statuses/{{ $ticketsStatus->id }}/edit" class="btn btn-primary"><span class='fa fa-pencil' aria-hidden='true'></span> <b>Edit</b></a></td>
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
            orderable: false, targets: 1
          } ]
        } );
      } );
    </script>
@endsection
