@extends('layouts.app')

@section('main-content')
    <div class="col-md-12">
      <div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Locations</h3>
				</div>
				<div class="panel-body">
          <p><a href="locations/create"><button type="button" class="btn btn-default" name="create-new-location" data-toggle="tooltip" data-original-title="Create New Location"><span class='glyphicon glyphicon-plus' aria-hidden='true'></span> <b>Create New Location</b></button></a></p>
          <table class="table table-striped table-bordered table-hover">
            <tr>
              <th>Building</th>
              <th>Office</th>
              <th>Name</th>
              <th>Actions</th>
            </tr>
            @foreach($locations as $location)
              <tr>
                <div>
                  <td>{{$location->building}}</td>
                  <td>{{$location->office}}</td>
                  <td>{{$location->location_name}}</td>
                  <td><a href="/locations/{{ $location->id }}/edit">Edit</a></td>
                </div>
              </tr>
            @endforeach
          </table>
        </div>
      </div>
      <div class="text-center">{!! $locations->links() !!}</div>
    </div>
@endsection
