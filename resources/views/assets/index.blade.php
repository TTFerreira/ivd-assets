@extends('layouts.app')

@section('content')
    <div class="col-md-12">
      <div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Assets</h3>
				</div>
				<div class="panel-body">
          <p><a href="assets/create"><button type="button" class="btn btn-default" name="create-new-asset" data-toggle="tooltip" data-original-title="Create New Asset"><span class='glyphicon glyphicon-plus' aria-hidden='true'></span> <b>Create New Asset</b></button></a></p>
          <table class="table table-striped table-bordered table-hover">
            <tr>
              <th>Asset Tag</th>
              <th>Serial Number</th>
              <th>Model</th>
              <th>Location</th>
              <th>Division</th>
              <th>Status</th>
              <th>Actions</th>
            </tr>
            @foreach($assets as $asset)
              <tr>
                <div>
                  <td>{{$asset->asset_tag}}</td>
                  <td>{{$asset->serial_number or ''}}</td>
                  <td>{{$asset->model->manufacturer->name}} - {{$asset->model->asset_model}}</td>
                  <td>{{$asset->movement->location->location_name}}</td>
                  <td>{{$asset->division->name}}</td>
                  <td>{{$asset->movement->status->name}}</td>
                  <td><a href="/assets/{{ $asset->id }}/move">Move</a> | <a href="/movements/{{ $asset->id }}/history">History</a> | <a href="/assets/{{ $asset->id }}/edit">Edit</a></td>
                </div>
              </tr>
            @endforeach
          </table>
        </div>
      </div>
      <div class="text-center">{!! $assets->links() !!}</div>
    </div>
@endsection
