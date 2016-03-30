@extends('layouts.app')

@section('main-content')
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
              <th>Date</th>
            </tr>
            @foreach($movements as $movement)
              @if($movement->asset_id == $asset->id)
                <tr>
                  <div>
                    <td>{{$movement->location->location_name}}</td>
                    <td>{{$movement->status->name}}</td>
                    <td>{{$movement->created_at}}</td>
                  </div>
                </tr>
              @endif
            @endforeach
          </table>
          <div class="text-center"><a class="btn btn-primary" href="{{ URL::previous() }}">Back</a></div>
        </div>
      </div>
    </div>
@endsection
