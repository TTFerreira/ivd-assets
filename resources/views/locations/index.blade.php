@extends('layouts.app')

@section('main-content')
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Locations</h3>
        </div>
        <div class="box-body">
          <p><a href="locations/create"><button type="button" class="btn btn-default" name="create-new-location" data-toggle="tooltip" data-original-title="Create New Location"><span class='glyphicon glyphicon-plus' aria-hidden='true'></span> <b>Create New Location</b></button></a></p>
          <table id="table" class="table table-striped table-bordered table-hover">
            <thead>
              <tr>
                <th>Building</th>
                <th>Office</th>
                <th>Name</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($locations as $location)
                <tr>
                  <div>
                    <td>{{$location->building}}</td>
                    <td>{{$location->office}}</td>
                    <td>{{$location->location_name}}</td>
                    <td><a href="/locations/{{ $location->id }}/edit">Edit</a></td>
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
