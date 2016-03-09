@extends('layouts.app')

@section('content')
  <div class="row">
    <div class="col-md-6 col-md-offset-3">
      <h1>{{$location->location_name}}</h1>

      <ul class="list-group">
        <li class="list-group-item">
          {{ $location->building }}
        </li>
        <li class="list-group-item">
          {{ $location->office }}
        </li>
        <li class="list-group-item">
          {{ $location->location_name }}
        </li>
      </ul>
      <hr>

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
