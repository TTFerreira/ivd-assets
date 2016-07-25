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
                <th>Invoice Number</th>
                <th>Order Number</th>
                <th>Total</th>
                <th>Division</th>
                <th>Supplier</th>
                <th>Invoiced Date</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($invoices as $invoice)
                <tr>
                  <div>
                    <td>{{$invoice->invoice_number}}</td>
                    <td>{{$invoice->order_number}}</td>
                    <td>R{{$invoice->total}}</td>
                    <td>{{$invoice->division->name}}</td>
                    <td>{{$invoice->supplier->name}}</td>
                    <td>{{$invoice->invoiced_date}}</td>
                    <td><a href="/invoices/{{ $invoice->id }}" target="_blank">View</a> | <a href="/invoices/{{ $invoice->id }}/edit" class="btn btn-primary"><span class='fa fa-pencil' aria-hidden='true'></span> <b>Edit</b></a></td>
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
          <h3 class="box-title">Create New Invoice</h3>
        </div>
        <div class="box-body">
          <form method="POST" action="{{ url('invoices') }}" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="form-group {{ hasErrorForClass($errors, 'invoice_number') }}">
              <label for="invoice_number">Invoice Number</label>
              <input type="text"  name="invoice_number" class="form-control" value="{{old('invoice_number')}}">
              {{ hasErrorForField($errors, 'invoice_number') }}
            </div>
            <div class="form-group {{ hasErrorForClass($errors, 'order_number') }}">
              <label for="order_number">Order Number</label>
              <input type="text"  name="order_number" class="form-control" value="{{old('order_number')}}">
              {{ hasErrorForField($errors, 'order_number') }}
            </div>
            <div class="form-group {{ hasErrorForClass($errors, 'invoiced_date') }}">
              <label for="invoiced_date">Invoiced Date</label>
              <input type="date"  name="invoiced_date" class="form-control" value="{{old('invoiced_date')}}">
              {{ hasErrorForField($errors, 'invoiced_date') }}
            </div>
            <div class="form-group {{ hasErrorForClass($errors, 'total') }}">
              <label for="total">Invoice Total (Incl. VAT)</label>
              <div class="input-group">
                <div class="input-group-addon">R</div>
                <input type="text"  name="total" class="form-control" value="{{old('total')}}">
              </div>
              {{ hasErrorForField($errors, 'total') }}
            </div>
            <div class="form-group {{ hasErrorForClass($errors, 'division_id') }}">
              <label for="division_id">Division</label>
              <select class="form-control division_id" name="division_id">
                <option value = ""></option>
                @foreach($divisions as $division)
                    <option value="{{$division->id}}">{{$division->name}}</option>
                @endforeach
              </select>
              {{ hasErrorForField($errors, 'division_id') }}
            </div>
            <div class="form-group {{ hasErrorForClass($errors, 'supplier_id') }}">
              <label for="supplier_id">Supplier</label>
              <select class="form-control supplier_id" name="supplier_id">
                <option value = ""></option>
                @foreach($suppliers as $supplier)
                    <option value="{{$supplier->id}}">{{$supplier->name}}</option>
                @endforeach
              </select>
              {{ hasErrorForField($errors, 'supplier_id') }}
            </div>
            <div class="form-group {{ hasErrorForClass($errors, 'file') }}">
              <label for="file">Upload Invoice (PDF Only)</label>
              <input type="file"  name="file" class="form-control">
              {{ hasErrorForField($errors, 'file') }}
            </div>

            <div class="form-group">
              <button type="submit" class="btn btn-primary"><b>Add New Invoice</b></button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <script>
  $(document).ready(function() {
    $('#table').DataTable( {
        dom: 'B<"clear">lfrtip',
        buttons: [
            'copyHtml5',
            'csvHtml5',
            'excelHtml5'
        ],
        columnDefs: [ {
          orderable: false, targets: 6
        } ],
        order: [[ 5, "asc" ]]
    } );
  } );
  </script>
  @if(Session::has('status'))
    <script>
      $(document).ready(function() {
        Command: toastr["{{Session::get('status')}}"]("{{Session::get('message')}}", "{{Session::get('title')}}");
      });
    </script>
  @endif
@endsection
