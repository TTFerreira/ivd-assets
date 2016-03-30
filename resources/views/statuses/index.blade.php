@extends('layouts.app')

@section('main-content')
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Statuses</h3>
        </div>
        <div class="box-body">
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
  </div>
@endsection
