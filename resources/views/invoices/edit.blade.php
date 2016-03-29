@extends('layouts.app')

@section('content')
  <div class="row">
    <div class="col-md-6 col-md-offset-3">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Edit Invoice</h3>
        </div>
          <div class="panel-body">
            <form method="POST" action="/invoices/{{$invoice->id}}/update" enctype="multipart/form-data">
              {{method_field('PATCH')}}
              {{csrf_field()}}
              <div class="form-group">
                <label for="invoice_number">Invoice Number</label>
                <input type="text"  name="invoice_number" class="form-control" value="{{$invoice->invoice_number}}">
              </div>
              <div class="form-group">
                <label for="order_number">Order Number</label>
                <input type="text"  name="order_number" class="form-control" value="{{$invoice->order_number}}">
              </div>
              <div class="form-group">
                <label for="invoiced_date">Invoiced Date</label>
                <input type="date"  name="invoiced_date" class="form-control" value="{{$invoice->invoiced_date}}">
              </div>
              <div class="form-group">
                <label for="total">Invoice Total (Incl. VAT)</label>
                <div class="input-group">
                  <div class="input-group-addon">R</div>
                  <input type="text"  name="total" class="form-control" value="{{$invoice->total}}">
                </div>
              </div>
              <div class="form-group">
                <label for="asset_model_id">Division</label>
                <select class="form-control division_id" name="division_id">
                  @foreach($divisions as $division)
                    <option
                      @if($invoice->division_id == $division->id)
                        selected
                      @endif
                    value="{{$division->id}}">{{$division->name}}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="supplier_id">Supplier</label>
                <select class="form-control supplier_id" name="supplier_id">
                  @foreach($suppliers as $supplier)
                    <option
                      @if($invoice->supplier_id == $supplier->id)
                        selected
                      @endif
                    value="{{$supplier->id}}">{{$supplier->name}}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="file">Upload Invoice (PDF Only)</label>
                <input type="file" name="file" class="form-control">
              </div>

              <div class="form-group">
                <button type="submit" class="btn btn-primary">Edit Invoice</button>
              </div>
            </form>
            <div class="text-center"><a class="btn btn-primary" href="{{ URL::previous() }}">Back</a></div>
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
      $(".division_id").select2();
      $(".supplier_id").select2();
    });
  </script>
@endsection
