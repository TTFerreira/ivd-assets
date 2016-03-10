@extends('layouts.app')

@section('content')
  <div class="row">
    <div class="col-md-6 col-md-offset-3">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Add a New Model</h3>
        </div>
        <div class="panel-body">
          <form method="POST" action="{{ url('models') }}">
            {{csrf_field()}}
            <div class="form-group">
              <label for="manufacturer_id">Manufacturer</label>
              <input type="text" name="manufacturer_id" class="form-control" value="{{old('manufacturer_id')}}">
            </div>
            <div class="form-group">
              <label for="asset_type_id">Asset Type</label>
              <input type="text"  name="asset_type_id" class="form-control" value="{{old('asset_type_id')}}">
            </div>
            <div class="form-group">
              <label for="pcspec_id">PC Specification</label>
              <input type="text"  name="pcspec_id" class="form-control" value="{{old('pcspec_id')}}">
            </div>
            <div class="form-group">
              <label for="asset_model">Model Name</label>
              <input type="text"  name="asset_model" class="form-control" value="{{old('asset_model')}}">
            </div>
            <div class="form-group">
              <label for="part_number">Part Number (Optional)</label>
              <input type="text"  name="part_number" class="form-control" value="{{old('part_number')}}">
            </div>

            <div class="form-group">
              <button type="submit" class="btn btn-primary">Add New Location</button>
            </div>
          </form>
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
  </div>
@endsection
