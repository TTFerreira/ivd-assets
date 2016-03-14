@extends('layouts.app')

@section('content')
  <div class="row">
    <div class="col-md-6 col-md-offset-3">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Add a New Asset</h3>
        </div>
        <div class="panel-body">
          <form method="POST" action="{{ url('assets') }}">
            {{csrf_field()}}
            <div class="form-group">
              <label for="serial_number">Serial Number</label>
              <input type="text"  name="serial_number" class="form-control" value="{{old('serial_number')}}">
            </div>
            <div class="form-group">
              <label for="asset_model_id">Model</label>
              <select class="form-control asset_model_id" name="asset_model_id">
                <option value = ""></option>
                @foreach($asset_models as $asset_model)
                    <option value="{{$asset_model->id}}">{{$asset_model->manufacturer->name}} - {{$asset_model->asset_model}}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="division_id">Division</label>
              <select class="form-control division_id" name="division_id">
                <option value = ""></option>
                @foreach($divisions as $division)
                    <option value="{{$division->id}}">{{$division->name}}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="supplier_id">Supplier</label>
              <select class="form-control supplier_id" name="supplier_id">
                <option value = ""></option>
                @foreach($suppliers as $supplier)
                    <option value="{{$supplier->id}}">{{$supplier->name}}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="purchase_date">Purchase Date</label>
              <input type="date"  name="purchase_date" class="form-control" value="{{old('purchase_date')}}">
            </div>
            <div class="form-group">
              <label for="warranty_months">Warranty Months</label>
              <input type="number"  name="warranty_months" class="form-control" value="{{old('warranty_months')}}">
            </div>
            <div class="form-group">
              <label for="warranty_type">Warranty Type</label>
              <input type="text"  name="warranty_type" class="form-control" value="{{old('warranty_type')}}">
            </div>

            <div class="form-group">
              <button type="submit" class="btn btn-primary">Add New Asset</button>
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
      $(".asset_model_id").select2();
      $(".division_id").select2();
      $(".supplier_id").select2();
    });
  </script>
@endsection
