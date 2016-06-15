@extends('layouts.app')

@section('main-content')
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">{{$pageTitle}}</h3>
        </div>
        <div class="box-body">
          <p><a href="/admin/ticket-canned-fields/create"><button type="button" class="btn btn-default" name="create-new-ticket-canned-fields" data-toggle="tooltip" data-original-title="Create New Ticket Canned Fields"><span class='fa fa-plus' aria-hidden='true'></span> <b>Create New Ticket Canned Fields</b></button></a></p>
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
