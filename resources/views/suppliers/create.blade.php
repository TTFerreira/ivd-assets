@extends('layouts.app')

@section('content')
  <div class="row">
    <div class="col-md-6 col-md-offset-3">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Add a New Supplier</h3>
        </div>
        <div class="panel-body">
          <form method="POST" action="{{ url('suppliers') }}">
            {{csrf_field()}}
            <div class="form-group">
              <label for="name">Supplier</label>
              <input type="text" name="name" class="form-control" value="{{old('name')}}">
            </div>

            <div class="form-group">
              <button type="submit" class="btn btn-primary">Add New Supplier</button>
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
