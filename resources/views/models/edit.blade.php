@extends('layouts.app')

@section('main-content')
  <div class="row">
    <div class="col-md-6 col-md-offset-3">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">{{$pageTitle}}</h3>
        </div>
        <div class="box-body">
          <form method="POST" action="/models/{{$asset_model->id}}">
            {{method_field('PATCH')}}
            {{csrf_field()}}
            <div class="form-group {{ hasErrorForClass($errors, 'asset_type_id') }}">
              <label for="asset_type_id">Asset Type</label>
              <select class="form-control asset_type_id" name="asset_type_id">
                @foreach($asset_types as $asset_type)
                  <option
                    @if($asset_model->asset_type_id == $asset_type->id)
                      selected
                    @endif
                  value="{{$asset_type->id}}">{{$asset_type->type_name}}</option>
                @endforeach
              </select>
              {{ hasErrorForField($errors, 'asset_type_id') }}
            </div>
            <div class="form-group {{ hasErrorForClass($errors, 'manufacturer_id') }}">
              <label for="manufacturer_id">Manufacturer</label>
              <select class="form-control manufacturer_id" name="manufacturer_id">
                @foreach($manufacturers as $manufacturer)
                  <option
                    @if($asset_model->manufacturer_id == $manufacturer->id)
                      selected
                    @endif
                  value="{{$manufacturer->id}}">{{$manufacturer->name}}</option>
                @endforeach
              </select>
              {{ hasErrorForField($errors, 'manufacturer_id') }}
            </div>
            <div class="form-group {{ hasErrorForClass($errors, 'asset_model') }}">
              <label for="asset_model">Model Name</label>
              <input type="text"  name="asset_model" class="form-control" value="{{$asset_model->asset_model}}">
              {{ hasErrorForField($errors, 'asset_model') }}
            </div>
            <div class="form-group {{ hasErrorForClass($errors, 'part_number') }}">
              <label for="part_number">Part Number (Optional)</label>
              <input type="text"  name="part_number" class="form-control" value="{{$asset_model->part_number}}">
              {{ hasErrorForField($errors, 'part_number') }}
            </div>
            <div class="form-group {{ hasErrorForClass($errors, 'pcspec_id') }}">
              <label for="pcspec_id">PC Specification</label>
              <select class="form-control pcspec_id" name="pcspec_id">
                <option value=""></option>
                @foreach($pcspecs as $pcspec)
                  <option
                    @if($asset_model->pcspec_id == $pcspec->id)
                      selected
                    @endif
                  value="{{$pcspec->id}}">{{$pcspec->cpu}}, {{$pcspec->ram}}, {{$pcspec->hdd}}</option>
                @endforeach
              </select>
              {{ hasErrorForField($errors, 'pcspec_id') }}
            </div>

            <div class="form-group">
              <button type="submit" class="btn btn-primary"><b>Edit Model</b></button>
            </div>
          </form>
        </div>
      </div>
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
  <script>
    $(":input").keypress(function(event){
      if (event.which == '10' || event.which == '13') {
        event.preventDefault();
      }
    });
  </script>
@endsection
