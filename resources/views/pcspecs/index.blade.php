@extends('layouts.app')

@section('main-content')
  <div class="row">
    <div class="col-md-9">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">{{$pageTitle}}</h3>
        </div>
        <div class="box-body">
          <table id="table" class="table table-striped table-bordered table-hover">
            <thead>
              <tr>
                <th>CPU</th>
                <th>RAM</th>
                <th>HDD</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($pcspecs as $pcspec)
                <tr>
                  <div>
                    <td>{{$pcspec->cpu}}</td>
                    <td>{{$pcspec->ram}}</td>
                    <td>{{$pcspec->hdd}}</td>
                    <td><a href="/pcspecs/{{ $pcspec->id }}/edit" class="btn btn-primary"><span class='fa fa-pencil' aria-hidden='true'></span> <b>Edit</b></a></td>
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
          <h3 class="box-title">Create New PC Specification</h3>
        </div>
        <div class="box-body">
          <form method="POST" action="{{ url('pcspecs') }}">
            {{csrf_field()}}
            <div class="form-group {{ hasErrorForClass($errors, 'cpu') }}">
              <label for="cpu">CPU</label>
              <input type="text" name="cpu" class="form-control" value="{{old('cpu')}}">
              {{ hasErrorForField($errors, 'cpu') }}
            </div>
            <div class="form-group {{ hasErrorForClass($errors, 'ram') }}">
              <label for="ram">RAM</label>
              <input type="text"  name="ram" class="form-control" value="{{old('ram')}}">
              {{ hasErrorForField($errors, 'ram') }}
            </div>
            <div class="form-group {{ hasErrorForClass($errors, 'hdd') }}">
              <label for="hdd">HDD</label>
              <input type="text"  name="hdd" class="form-control" value="{{old('hdd')}}">
              {{ hasErrorForField($errors, 'hdd') }}
            </div>

            <div class="form-group">
              <button type="submit" class="btn btn-primary"><b>Add New PC Specification</b></button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <script>
    $(document).ready(function() {
      $('#table').DataTable( {
        columnDefs: [ {
          orderable: false, targets: 3
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
