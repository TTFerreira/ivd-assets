@extends('layouts.app')

@section('content')
    <div class="col-md-12">
      <div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Divisions</h3>
				</div>
				<div class="panel-body">
          <p><a href="divisions/create"><button type="button" class="btn btn-default" name="create-new-division" data-toggle="tooltip" data-original-title="Create New Division"><span class='glyphicon glyphicon-plus' aria-hidden='true'></span> <b>Create New Division</b></button></a></p>
          <table class="table table-striped table-bordered table-hover">
            <tr>
              <th>Division</th>
              <th>Actions</th>
            </tr>
            @foreach($divisions as $division)
              <tr>
                <div>
                  <td>{{$division->name}}</td>
                  <td><a href="/divisions/{{ $division->id }}/edit">Edit</a></td>
                </div>
              </tr>
            @endforeach
          </table>
        </div>
      </div>
      <div class="text-center">{!! $divisions->links() !!}</div>
    </div>
@endsection
