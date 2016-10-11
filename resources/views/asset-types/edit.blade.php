@extends('layouts.app')

@section('main-content')
  <div class="row">
    <div class="col-md-6 col-md-offset-3">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">{{$pageTitle}}</h3>
        </div>
        <div class="box-body">
            <form method="POST" action="/asset-types/{{$asset_type->id}}">
              {{method_field('PATCH')}}
              {{csrf_field()}}
              <div class="form-group {{ hasErrorForClass($errors, 'type_name') }}">
                <label for="type_name">Asset Type Name</label>
                <input type="text" name="type_name" class="form-control" value="{{$asset_type->type_name}}">
                {{ hasErrorForField($errors, 'type_name') }}
              </div>
              <div class="form-group {{ hasErrorForClass($errors, 'abbreviation') }}">
                <label for="abbreviation">Abbreviation</label>
                <input type="text"  name="abbreviation" class="form-control" value="{{$asset_type->abbreviation}}">
                {{ hasErrorForField($errors, 'abbreviation') }}
              </div>
              <div class="form-group {{ hasErrorForClass($errors, 'spare') }}">
                <label for="spare">Track Spare Level</label>
                <select class="form-control spare" name="spare">
                  <option
                    @if($asset_type->spare == 0)
                      selected
                    @endif
                    value = 0>No
                  </option>
                  <option
                    @if($asset_type->spare == 1)
                      selected
                    @endif
                    value = 1>Yes
                  </option>
                </select>
                {{ hasErrorForField($errors, 'spare') }}
              </div>

              <div class="form-group">
                <button type="submit" class="btn btn-primary"><b>Edit Asset Type</b></button>
              </div>
            </form>
          </div>
        </div>
    </div>
  </div>
@endsection
