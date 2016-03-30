@extends('layouts.app')

@section('main-content')
    <div class="col-md-12">
      <div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Statuses</h3>
				</div>
				<div class="panel-body">
          <p><a href="statuses/create"><button type="button" class="btn btn-default" name="create-new-status" data-toggle="tooltip" data-original-title="Create New Status"><span class='glyphicon glyphicon-plus' aria-hidden='true'></span> <b>Create New Status</b></button></a></p>
          <table class="table table-striped table-bordered table-hover">
            <tr>
              <th>Status</th>
              <th>Actions</th>
            </tr>
            @foreach($statuses as $status)
              <tr>
                <div>
                  <td>{{$status->name}}</td>
                  <td><a href="/statuses/{{ $status->id }}/edit">Edit</a></td>
                </div>
              </tr>
            @endforeach
          </table>
        </div>
      </div>
      <div class="text-center">{!! $statuses->links() !!}</div>
    </div>
@endsection
