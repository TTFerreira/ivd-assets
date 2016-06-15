@extends('layouts.app')

@section('main-content')
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">{{$pageTitle}}</h3>
        </div>
        <div class="box-body">
          <p><a href="/admin/ticket-types/create"><button type="button" class="btn btn-default" name="create-new-ticket-type" data-toggle="tooltip" data-original-title="Create New Ticket Type"><span class='fa fa-plus' aria-hidden='true'></span> <b>Create New Ticket Type</b></button></a></p>
          <table id="table" class="table table-striped table-bordered table-hover">
            <thead>
              <tr>
                <th>Ticket Type</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($ticketsTypes as $ticketsType)
                <tr>
                  <div>
                    <td>{{$ticketsType->type}}</td>
                    <td><a href="/admin/ticket-types/{{ $ticketsType->id }}/edit" class="btn btn-primary"><span class='fa fa-pencil' aria-hidden='true'></span> <b>Edit</b></a></td>
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
