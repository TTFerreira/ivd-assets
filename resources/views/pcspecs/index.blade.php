@extends('layouts.app')

@section('content')
    <div class="col-md-12">
      <div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">PC Specifications</h3>
				</div>
				<div class="panel-body">
          <p><a href="pcspecs/create"><button type="button" class="btn btn-default" name="create-new-pcspec" data-toggle="tooltip" data-original-title="Create New PC Specification"><span class='glyphicon glyphicon-plus' aria-hidden='true'></span> <b>Create New PC Specification</b></button></a></p>
          <table class="table table-striped table-bordered table-hover">
            <tr>
              <th>CPU</th>
              <th>RAM</th>
              <th>HDD</th>
              <th>Actions</th>
            </tr>
            @foreach($pcspecs as $pcspec)
              <tr>
                <div>
                  <td>{{$pcspec->cpu}}</td>
                  <td>{{$pcspec->ram}}</td>
                  <td>{{$pcspec->hdd}}</td>
                  <td><a href="/pcspecs/{{ $pcspec->id }}/edit">Edit</a></td>
                </div>
              </tr>
            @endforeach
          </table>
        </div>
      </div>
      <div class="text-center">{!! $pcspecs->links() !!}</div>
    </div>
@endsection
