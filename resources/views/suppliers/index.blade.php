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
    <div class="col-md-3">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Create New Supplier</h3>
        </div>
        <div class="box-body">
          <form method="POST" action="{{ url('suppliers') }}">
            {{csrf_field()}}
            <div class="form-group {{ hasErrorForClass($errors, 'name') }}">
              <label for="name">Supplier </label>
              <input type="text" name="name" class="form-control" value="{{old('name')}}">
              {{ hasErrorForField($errors, 'name') }}
            </div>

            <div class="form-group">
              <button type="submit" class="btn btn-primary">Add New Supplier</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <script>
    $(document).ready(function() {
      $('#table').DataTable( {
        columnDefs: [ {
          orderable: false, targets: 1
        } ],
        order: [[ 0, "asc" ]]
      } );
    } );
  </script>
@endsection
