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
              <label for="asset_type_id">Asset Type</label>
              <select class="form-control asset_type_id" name="asset_type_id">
                <option value = ""></option>
                @foreach($asset_types as $asset_type)
                    <option value="{{$asset_type->id}}">{{$asset_type->type_name}}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="manufacturer_id">Manufacturer</label>
              {{-- <input type="text" name="manufacturer_id" class="form-control" value="{{old('manufacturer_id')}}"> --}}
              <select class="form-control manufacturer_id" name="manufacturer_id">
                <option value = ""></option>
                @foreach($manufacturers as $manufacturer)
                    <option value="{{$manufacturer->id}}">{{$manufacturer->name}}</option>
                @endforeach
              </select>
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
              <label for="pcspec_id">PC Specification</label>
              <select class="form-control pcspec_id" name="pcspec_id">
                <option value = ""></option>
                @foreach($pcspecs as $pcspec)
                    <option value="{{$pcspec->id}}">{{$pcspec->cpu}}, {{$pcspec->ram}}, {{$pcspec->hdd}}</option>
                @endforeach
              </select>
            </div>

            <div class="form-group">
              <button type="submit" class="btn btn-primary">Add New Model</button>
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

@section('footer')
  <script type="text/javascript">
    $(document).ready(function() {
      $(".manufacturer_id").select2();
      $(".asset_type_id").select2();
      $(".pcspec_id").select2();
    });
  </script>
@endsection
