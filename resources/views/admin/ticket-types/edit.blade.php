@extends('layouts.app')

@section('main-content')
  <div class="row">
    <div class="col-md-6">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">{{$pageTitle}}</h3>
        </div>
        <div class="box-body">
          <form method="POST" action="/admin/ticket-types/{{$ticketsType->id}}/update">
            {{method_field('PATCH')}}
            {{csrf_field()}}
            <div class="form-group {{ hasErrorForClass($errors, 'type') }}">
              <label for="type">Type</label>
              <input type="text" name="type" class="form-control" value="{{$ticketsType->type}}">
              {{ hasErrorForField($errors, 'type') }}
            </div>

            <div class="form-group">
              <button type="submit" class="btn btn-primary"><b>Edit Ticket Type</b></button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Ticket Types</h3>
        </div>
        <div class="box-body">
          <ul>
            @foreach($ticketsTypes as $type)
              <li>{{$type->type}}</li>
            @endforeach
        </ul>
        </div>
      </div>
    </div>
  </div>
@endsection
