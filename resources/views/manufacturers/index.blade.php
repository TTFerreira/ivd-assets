@extends('layouts.app')

@section('content')
    <div class="col-md-12">
      <div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Manufacturers</h3>
				</div>
				<div class="panel-body">
          <p><a href="manufacturers/create"><button type="button" class="btn btn-default" name="create-new-manufacturer" data-toggle="tooltip" data-original-title="Create New Manufacturer"><span class='glyphicon glyphicon-plus' aria-hidden='true'></span> <b>Create New Manufacturer</b></button></a></p>
          <table class="table table-striped table-bordered table-hover">
            <tr>
              <th>Manufacturer</th>
              <th>Actions</th>
            </tr>
            @foreach($manufacturers as $manufacturer)
              <tr>
                <div>
                  <td>{{$manufacturer->name}}</td>
                  <td><a href="/manufacturers/{{ $manufacturer->id }}/edit">Edit</a></td>
                </div>
              </tr>
            @endforeach
          </table>
        </div>
      </div>
      <div class="text-center">{!! $manufacturers->links() !!}</div>
    </div>
@endsection
