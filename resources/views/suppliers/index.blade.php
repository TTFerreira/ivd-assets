@extends('layouts.app')

@section('main-content')
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Suppliers</h3>
        </div>
        <div class="box-body">
          <p><a href="suppliers/create"><button type="button" class="btn btn-default" name="create-new-supplier" data-toggle="tooltip" data-original-title="Create New Supplier"><span class='glyphicon glyphicon-plus' aria-hidden='true'></span> <b>Create New Supplier</b></button></a></p>
          <table id="table" class="table table-striped table-bordered table-hover">
            <thead>
              <tr>
                <th>Supplier</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($suppliers as $supplier)
                <tr>
                  <div>
                    <td>{{$supplier->name}}</td>
                    <td><a href="/suppliers/{{ $supplier->id }}/edit">Edit</a></td>
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
              targets: [ 1 ],
              orderData: [ 1, 0 ]
          } ]
      } );
    } );
  </script>
@endsection
