@extends('layouts.app')

@section('main-content')
  <div class="row">
    <div class="col-md-9">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">{{$pageTitle}}</h3>
        </div>
        <div class="box-body">
          <p><a href="models/create"><button type="button" class="btn btn-default" name="create-new-model" data-toggle="tooltip" data-original-title="Create New Model"><span class='fa fa-plus' aria-hidden='true'></span> <b>Create New Model</b></button></a></p>
          <table id="table" class="table table-striped table-bordered table-hover">
            <thead>
              <tr>
                <th>Manufacturer</th>
                <th>Model Name</th>
                <th>Asset Type</th>
                <th>PC Specification</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($asset_models as $asset_model)
                <tr>
                  <div>
                    <td>{{$asset_model->manufacturer->name}}</td>
                    <td>{{$asset_model->asset_model}}</td>
                    <td>{{$asset_model->asset_type->type_name}}</td>
                    <td>{{$asset_model->pcspec->cpu or ''}} {{$asset_model->pcspec->ram or ''}} {{$asset_model->pcspec->hdd or ''}}</td>
                    <td><a href="/models/{{ $asset_model->id }}/edit" class="btn btn-primary"><span class='fa fa-pencil' aria-hidden='true'></span> <b>Edit</b></a></td>
                  </div>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Create New Model</h3>
        </div>
        <div class="box-body">
          <form method="POST" action="{{ url('models') }}">
            {{csrf_field()}}
            <div class="form-group {{ hasErrorForClass($errors, 'asset_type_id') }}">
              <label for="asset_type_id">Asset Type</label>
              <select class="form-control asset_type_id" name="asset_type_id">
                <option value = ""></option>
                @foreach($asset_types as $asset_type)
                    <option value="{{$asset_type->id}}">{{$asset_type->type_name}}</option>
                @endforeach
              </select>
              {{ hasErrorForField($errors, 'asset_type_id') }}
            </div>
            <div class="form-group {{ hasErrorForClass($errors, 'manufacturer_id') }}">
              <label for="manufacturer_id">Manufacturer</label>
              <select class="form-control manufacturer_id" name="manufacturer_id">
                <option value = ""></option>
                @foreach($manufacturers as $manufacturer)
                    <option value="{{$manufacturer->id}}">{{$manufacturer->name}}</option>
                @endforeach
              </select>
              {{ hasErrorForField($errors, 'manufacturer_id') }}
            </div>
            <div class="form-group {{ hasErrorForClass($errors, 'asset_model') }}">
              <label for="asset_model">Model Name</label>
              <input type="text"  name="asset_model" class="form-control" value="{{old('asset_model')}}">
              {{ hasErrorForField($errors, 'asset_model') }}
            </div>
            <div class="form-group {{ hasErrorForClass($errors, 'part_number') }}">
              <label for="part_number">Part Number (Optional)</label>
              <input type="text"  name="part_number" class="form-control" value="{{old('part_number')}}">
              {{ hasErrorForField($errors, 'part_number') }}
            </div>
            <div class="form-group {{ hasErrorForClass($errors, 'pcspec_id') }}">
              <label for="pcspec_id">PC Specification</label>
              <select class="form-control pcspec_id" name="pcspec_id">
                <option value = ""></option>
                @foreach($pcspecs as $pcspec)
                    <option value="{{$pcspec->id}}">{{$pcspec->cpu}}, {{$pcspec->ram}}, {{$pcspec->hdd}}</option>
                @endforeach
              </select>
              {{ hasErrorForField($errors, 'pcspec_id') }}
            </div>

            <div class="form-group">
              <button type="submit" class="btn btn-primary">Add New Model</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <script>
      $(document).ready(function() {
        $('#table').DataTable( {
          columnDefs: [ {
            orderable: false, targets: 4
          } ],
          order: [[ 0, "asc" ]]
        } );
      } );
    </script>
    @if(Session::has('status'))
      <script>
        $(document).ready(function() {
          Command: toastr["{{Session::get('status')}}"]("{{Session::get('message')}}", "{{Session::get('title')}}");
        });
      </script>
    @endif
@endsection
@section('footer')
  <script type="text/javascript">
    $(document).ready(function() {
      $(".manufacturer_id").select2();
      $(".asset_type_id").select2();
      $(".pcspec_id").select2();
    });
  </script>
  <script>
    $(":input").keypress(function(event){
      if (event.which == '10' || event.which == '13') {
        event.preventDefault();
      }
    });
  </script>
@endsection
