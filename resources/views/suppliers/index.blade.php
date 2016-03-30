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
          <table class="table table-striped table-bordered table-hover">
            <tr>
              <th>Supplier</th>
              <th>Actions</th>
            </tr>
            @foreach($suppliers as $supplier)
              <tr>
                <div>
                  <td>{{$supplier->name}}</td>
                  <td><a href="/suppliers/{{ $supplier->id }}/edit">Edit</a></td>
                </div>
              </tr>
            @endforeach
          </table>
        </div>
      </div>
      <div class="text-center">{!! $suppliers->links() !!}</div>
    </div>
  </div>
@endsection
