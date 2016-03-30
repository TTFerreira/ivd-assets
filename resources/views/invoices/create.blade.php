@extends('layouts.app')

@section('main-content')
  <div class="row">
    <div class="col-md-6 col-md-offset-3">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Add a Invoice</h3>
        </div>
        <div class="panel-body">
          <form method="POST" action="{{ url('invoices') }}" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="form-group">
              <div class="form-group">
                <label for="invoice_number">Invoice Number</label>
                <input type="text"  name="invoice_number" class="form-control" value="{{old('invoice_number')}}">
              </div>
              <div class="form-group">
                <label for="order_number">Order Number</label>
                <input type="text"  name="order_number" class="form-control" value="{{old('order_number')}}">
              </div>
              <div class="form-group">
                <label for="invoiced_date">Invoiced Date</label>
                <input type="date"  name="invoiced_date" class="form-control" value="{{old('invoiced_date')}}">
              </div>
              <div class="form-group">
                <label for="total">Invoice Total (Incl. VAT)</label>
                <div class="input-group">
                  <div class="input-group-addon">R</div>
                  <input type="text"  name="total" class="form-control" value="{{old('total')}}">
                </div>
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
                <label for="file">Upload Invoice (PDF Only)</label>
                <input type="file"  name="file" class="form-control">
              </div>
            </div>

            <div class="form-group">
              <button type="submit" class="btn btn-primary">Add New Invoice</button>
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
      $(".supplier_id").select2();
      $(".division_id").select2();
    });
  </script>
@endsection
