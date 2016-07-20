@extends('layouts.app')

@section('main-content')
  <div class="row">
    <div class="col-md-6 col-md-offset-3">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">{{$pageTitle}}</h3>
        </div>
        <div class="box-body">
          <form method="POST" action="/manufacturers/{{$manufacturer->id}}">
            {{method_field('PATCH')}}
            {{csrf_field()}}
            <div class="form-group {{ hasErrorForClass($errors, 'name') }}">
              <label for="name">Manufacturer Name</label>
              <input type="text" name="name" class="form-control" value="{{$manufacturer->name}}">
              {{ hasErrorForField($errors, 'name') }}
            </div>

            <div class="form-group">
              <button type="submit" class="btn btn-primary"><b>Edit Manufacturer</b></button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
