@extends('layouts.app')

@section('main-content')
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Invoices</h3>
        </div>
        <div class="box-body">
          <p><a href="/invoices/create"><button type="button" class="btn btn-default" name="create-new-invoice" data-toggle="tooltip" data-original-title="Create New Invoice"><span class='glyphicon glyphicon-plus' aria-hidden='true'></span> <b>Create New Invoice</b></button></a></p>
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
                    <td><a href="/invoices/{{ $invoice->id }}" target="_blank">View</a> | <a href="/invoices/{{ $invoice->id }}/edit">Edit</a></td>
                  </div>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <script>
    $(document).ready(function() {
      $('#table').DataTable( {
          columnDefs: [ {
              targets: [ 0 ],
              orderData: [ 0, 1 ]
          }, {
              targets: [ 1 ],
              orderData: [ 1, 0 ]
          }, {
              targets: [ 2 ],
              orderData: [ 2, 0 ]
          } ]
      } );
    } );
  </script>
@endsection
