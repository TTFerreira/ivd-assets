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
          <table class="table table-striped table-bordered table-hover">
            <tr>
              <th>Asset Type Name</th>
              <th>Abbreviation</th>
              <th>Actions</th>
            </tr>
            @foreach($asset_types as $asset_type)
              <tr>
                <div>
                  <td>{{$asset_type->type_name}}</td>
                  <td>{{$asset_type->abbreviation}}</td>
                  <td><a href="/asset-types/{{ $asset_type->id }}/edit">Edit</a></td>
                </div>
              </tr>
            @endforeach
          </table>
        </div>
      </div>
      <div class="text-center">{!! $asset_types->links() !!}</div>
    </div>
  </div>
@endsection
