@extends('layouts.app')

@section('main-content')
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Asset Types</h3>
        </div>
        <div class="box-body">
          <p><a href="/asset-types/create"><button type="button" class="btn btn-default" name="create-new-asset-type" data-toggle="tooltip" data-original-title="Create New Asset Type"><span class='glyphicon glyphicon-plus' aria-hidden='true'></span> <b>Create New Asset Type</b></button></a></p>
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
                    <td><a href="/asset-types/{{ $asset_type->id }}/edit">Edit</a></td>
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
