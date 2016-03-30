@extends('layouts.app')

@section('main-content')
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Edit Models</h3>
        </div>
        <div class="box-body">
          <p><a href="models/create"><button type="button" class="btn btn-default" name="create-new-model" data-toggle="tooltip" data-original-title="Create New Model"><span class='glyphicon glyphicon-plus' aria-hidden='true'></span> <b>Create New Model</b></button></a></p>
          <table class="table table-striped table-bordered table-hover">
            <tr>
              <th>Manufacturer</th>
              <th>Model Name</th>
              <th>Asset Type</th>
              <th>PC Specification</th>
              <th>Actions</th>
            </tr>
            @foreach($asset_models as $asset_model)
              <tr>
                <div>
                  <td>{{$asset_model->manufacturer->name}}</td>
                  <td>{{$asset_model->asset_model}}</td>
                  <td>{{$asset_model->asset_type->type_name}}</td>
                  <td>{{$asset_model->pcspec->cpu or ''}} {{$asset_model->pcspec->ram or ''}} {{$asset_model->pcspec->hdd or ''}}</td>
                  <td><a href="/models/{{ $asset_model->id }}/edit">Edit</a></td>
                </div>
              </tr>
            @endforeach
          </table>
        </div>
      </div>
      <div class="text-center">{!! $asset_models->links() !!}</div>
    </div>
@endsection
