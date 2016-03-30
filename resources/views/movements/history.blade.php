@extends('layouts.app')

@section('main-content')
  <div class="row">
    <div class="col-md-6 col-md-offset-3">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Movement History</h3>
        </div>
        <div class="box-body">
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
          </table><br>
          <div class="text-center"><a class="btn btn-primary" href="{{ URL::previous() }}">Back</a></div>
        </div>
      </div>
    </div>
  </div>
@endsection
