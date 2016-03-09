@extends('layouts.app')

@section('content')
  <div class="row">
    <div class="col-md-6 col-md-offset-3">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Edit Manufacturer</h3>
        </div>
          <div class="panel-body">
            <form method="POST" action="/manufacturers/{{$manufacturer->id}}/update">
              {{method_field('PATCH')}}
              {{csrf_field()}}
              <div class="form-group">
                <label for="name">Manufacturer Name</label>
                <input type="text" name="name" class="form-control" value="{{$manufacturer->name}}">
              </div>

              <div class="form-group">
                <button type="submit" class="btn btn-primary">Edit Manufacturer</button>
              </div>
            </form>
          </div>
        </div>

      @if(count($errors))
        <ul>
          @foreach($errors->all() as $error)
            <li>{{$error}}</li>
          @endforeach
        </ul>
      @endif
    </div>
  </div>
@endsection
