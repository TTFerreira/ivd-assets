@extends('layouts.app')

@section('main-content')
  <div class="row">
    <div class="col-md-6 col-md-offset-3">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">{{$pageTitle}}</h3>
        </div>
        <div class="box-body">
          <form method="POST" action="/pcspecs/{{$pcspec->id}}">
            {{method_field('PATCH')}}
            {{csrf_field()}}
            <div class="form-group {{ hasErrorForClass($errors, 'cpu') }}">
              <label for="cpu">CPU</label>
              <input type="text" name="cpu" class="form-control" value="{{$pcspec->cpu}}">
              {{ hasErrorForField($errors, 'cpu') }}
            </div>
            <div class="form-group {{ hasErrorForClass($errors, 'ram') }}">
              <label for="ram">RAM</label>
              <input type="text"  name="ram" class="form-control" value="{{$pcspec->ram}}">
              {{ hasErrorForField($errors, 'ram') }}
            </div>
            <div class="form-group {{ hasErrorForClass($errors, 'hdd') }}">
              <label for="hdd">HDD</label>
              <input type="text"  name="hdd" class="form-control" value="{{$pcspec->hdd}}">
              {{ hasErrorForField($errors, 'hdd') }}
            </div>

            <div class="form-group">
              <button type="submit" class="btn btn-primary"><b>Edit PC Specification</b></button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
