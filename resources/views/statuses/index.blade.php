@extends('layouts.app')

@section('main-content')
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">{{$pageTitle}}</h3>
        </div>
        <div class="box-body">
          <p><a href="statuses/create"><button type="button" class="btn btn-default" name="create-new-status" data-toggle="tooltip" data-original-title="Create New Status"><span class='fa fa-plus' aria-hidden='true'></span> <b>Create New Status</b></button></a></p>
          <table id="table" class="table table-striped table-bordered table-hover">
            <thead>
              <tr>
                <th>Status</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($statuses as $status)
                <tr>
                  <div>
                    <td>{{$status->name}}</td>
                    <td><a href="/statuses/{{ $status->id }}/edit" class="btn btn-primary"><span class='fa fa-pencil' aria-hidden='true'></span> <b>Edit</b></a></td>
                  </div>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
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
              targets: [ 1 ],
              orderData: [ 1, 0 ]
          } ]
      } );
    } );
  </script>
@endsection
