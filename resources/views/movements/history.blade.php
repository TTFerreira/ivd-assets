@extends('layouts.app')

@section('content')
    <div class="col-md-6 col-md-offset-3">
      <div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Movement History</h3>
				</div>
				<div class="panel-body">
          <table class="table table-striped table-bordered table-hover">
            <tr>
              <th>Location</th>
              <th>Status</th>
            </tr>
            @foreach($movements as $movement)
              <tr>
                <div>
                  <td>{{$movement->location->location_name}}</td>
                  <td>{{$movement->status->name}}</td>
                </div>
              </tr>
            @endforeach
          </table>
        </div>
      </div>
    </div>
@endsection
