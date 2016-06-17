@extends('layouts.app')

@section('main-content')
  <div class="row">
    <div class="col-md-6 col-md-offset-3">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">{{$pageTitle}}</h3>
        </div>
        <div class="box-body">
            <form method="POST" action="/invoices/{{$invoice->id}}/update" enctype="multipart/form-data">
              {{method_field('PATCH')}}
              {{csrf_field()}}
              <div class="form-group {{ hasErrorForClass($errors, 'invoice_number') }}">
                <label for="invoice_number">Invoice Number</label>
                <input type="text"  name="invoice_number" class="form-control" value="{{$invoice->invoice_number}}">
                {{ hasErrorForField($errors, 'invoice_number') }}
              </div>
              <div class="form-group {{ hasErrorForClass($errors, 'order_number') }}">
                <label for="order_number">Order Number</label>
                <input type="text"  name="order_number" class="form-control" value="{{$invoice->order_number}}">
                {{ hasErrorForField($errors, 'order_number') }}
              </div>
              <div class="form-group {{ hasErrorForClass($errors, 'invoiced_date') }}">
                <label for="invoiced_date">Invoiced Date</label>
                <input type="date"  name="invoiced_date" class="form-control" value="{{$invoice->invoiced_date}}">
                {{ hasErrorForField($errors, 'invoiced_date') }}
              </div>
              <div class="form-group {{ hasErrorForClass($errors, 'total') }}">
                <label for="total">Invoice Total (Incl. VAT)</label>
                <div class="input-group">
                  <div class="input-group-addon">R</div>
                  <input type="text"  name="total" class="form-control" value="{{$invoice->total}}">
                  {{ hasErrorForField($errors, 'total') }}
                </div>
              </div>
              <div class="form-group {{ hasErrorForClass($errors, 'division_id') }}">
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
                {{ hasErrorForField($errors, 'division_id') }}
              </div>
              <div class="form-group {{ hasErrorForClass($errors, 'supplier_id') }}">
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
                {{ hasErrorForField($errors, 'supplier_id') }}
              </div>
              <div class="form-group {{ hasErrorForClass($errors, 'file') }}">
                <label for="file">Upload Invoice (PDF Only)</label>
                <input type="file" name="file" class="form-control">
                {{ hasErrorForField($errors, 'file') }}
              </div>

              <div class="form-group">
                <button type="submit" class="btn btn-primary"><b>Edit Invoice</b></button>
              </div>
            </form>
            <div class="text-center"><a class="btn btn-primary" href="{{ URL::previous() }}">Back</a></div>
          </div>
        </div>
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
