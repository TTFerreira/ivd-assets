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
                <th>Asset Type Name</th>
                <th>Abbreviation</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($asset_types as $asset_type)
                <tr>
                  <div>
                    <td>{{$asset_type->type_name}}</td>
                    <td>{{$asset_type->abbreviation}}</td>
                    <td><a href="/asset-types/{{ $asset_type->id }}/edit" class="btn btn-primary"><span class='fa fa-pencil' aria-hidden='true'></span> <b>Edit</b></a></td>
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
          <h3 class="box-title">Create New Asset Type</h3>
        </div>
        <div class="box-body">
          <form method="POST" action="{{ url('asset-types') }}">
            {{csrf_field()}}
            <div class="form-group {{ hasErrorForClass($errors, 'type_name') }}">
              <label for="type_name">Asset Type Name</label>
              <input type="text" name="type_name" class="form-control" value="{{old('type_name')}}">
              {{ hasErrorForField($errors, 'type_name') }}
            </div>
            <div class="form-group {{ hasErrorForClass($errors, 'abbreviation') }}">
              <label for="abbreviation">Abbreviation</label>
              <input type="text"  name="abbreviation" class="form-control" value="{{old('abbreviation')}}">
              {{ hasErrorForField($errors, 'abbreviation') }}
            </div>

            <div class="form-group">
              <button type="submit" class="btn btn-primary"><b>Add New Asset Type</b></button>
            </div>
          </form>
        </div>
      </div>
  </div>
  <script>
    $(document).ready(function() {
      $('#table').DataTable( {
        columnDefs: [ {
          orderable: false, targets: 2
        } ],
        order: [[ 0, "asc" ]]
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
