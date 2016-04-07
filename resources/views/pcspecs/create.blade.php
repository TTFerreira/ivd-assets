@extends('layouts.app')

@section('main-content')
  <div class="row">
    <div class="col-md-6 col-md-offset-3">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">{{$pageTitle}}</h3>
        </div>
        <div class="box-body">
          <form method="POST" action="{{ url('pcspecs') }}">
            {{csrf_field()}}
            <div class="form-group">
              <label for="cpu">CPU</label>
              <input type="text" name="cpu" class="form-control" value="{{old('cpu')}}">
            </div>
            <div class="form-group">
              <label for="ram">RAM</label>
              <input type="text"  name="ram" class="form-control" value="{{old('ram')}}">
            </div>
            <div class="form-group">
              <label for="hdd">HDD</label>
              <input type="text"  name="hdd" class="form-control" value="{{old('hdd')}}">
            </div>

            <div class="form-group">
              <button type="submit" class="btn btn-primary">Add New PC Specification</button>
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
