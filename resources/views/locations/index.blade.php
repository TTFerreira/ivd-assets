@extends('layouts.app')

@section('main-content')
  <div class="row">
    <div class="col-md-9">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">{{$pageTitle}}</h3>
        </div>
        <div class="box-body">
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
    <div class="col-md-3">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Create New Location</h3>
        </div>
        <div class="box-body">
          <form method="POST" action="{{ url('locations') }}">
            {{csrf_field()}}
            <div class="form-group {{ hasErrorForClass($errors, 'building') }}">
              <label for="building">Building</label>
              <input type="text" name="building" class="form-control" value="{{old('building')}}">
              {{ hasErrorForField($errors, 'building') }}
            </div>
            <div class="form-group {{ hasErrorForClass($errors, 'office') }}">
              <label for="office">Office</label>
              <input type="text"  name="office" class="form-control" value="{{old('office')}}">
              {{ hasErrorForField($errors, 'office') }}
            </div>
            <div class="form-group {{ hasErrorForClass($errors, 'location_name') }}">
              <label for="location_name">Location Name</label>
              <input type="text"  name="location_name" class="form-control" value="{{old('location_name')}}">
              {{ hasErrorForField($errors, 'location_name') }}
            </div>

            <div class="form-group">
              <button type="submit" class="btn btn-primary">Add New Location</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <script>
    $(document).ready(function() {
      $('#table').DataTable( {
        columnDefs: [ {
          orderable: false, targets: 3
        } ],
        order: [[ 2, "asc" ]]
      } );
    } );
  </script>
@endsection
