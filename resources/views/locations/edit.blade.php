@extends('layouts.app')

@section('main-content')
  <div class="row">
    <div class="col-md-6 col-md-offset-3">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">{{$pageTitle}}</h3>
        </div>
        <div class="box-body">
          <form method="POST" action="/locations/{{$location->id}}">
            {{method_field('PATCH')}}
            {{csrf_field()}}
            <div class="form-group {{ hasErrorForClass($errors, 'building') }}">
              <label for="building">Building</label>
              <input type="text" name="building" class="form-control" value="{{$location->building}}">
              {{ hasErrorForField($errors, 'building') }}
            </div>
            <div class="form-group {{ hasErrorForClass($errors, 'office') }}">
              <label for="office">Office</label>
              <input type="text"  name="office" class="form-control" value="{{$location->office}}">
              {{ hasErrorForField($errors, 'office') }}
            </div>
            <div class="form-group {{ hasErrorForClass($errors, 'location_name') }}">
              <label for="location_name">Location Name</label>
              <input type="text"  name="location_name" class="form-control" value="{{$location->location_name}}">
              {{ hasErrorForField($errors, 'location_name') }}
            </div>

            <div class="form-group">
              <button type="submit" class="btn btn-primary"><b>Edit Location</b></button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
