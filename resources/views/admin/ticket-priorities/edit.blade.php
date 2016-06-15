@extends('layouts.app')

@section('main-content')
  <div class="row">
    <div class="col-md-6">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">{{$pageTitle}}</h3>
        </div>
        <div class="box-body">
          <form method="POST" action="/admin/ticket-priorities/{{$ticketsPriority->id}}/update">
            {{method_field('PATCH')}}
            {{csrf_field()}}
            <div class="form-group">
              <label for="priority">Priority</label>
              <input type="text" name="priority" class="form-control" value="{{$ticketsPriority->priority}}">
            </div>

            <div class="form-group">
              <button type="submit" class="btn btn-primary"><b>Edit Ticket Priority</b></button>
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
    <div class="col-md-6">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Ticket Priorities</h3>
        </div>
        <div class="box-body">
          <ul>
            @foreach($ticketsPriorities as $priority)
              <li>{{$priority->priority}}</li>
            @endforeach
        </ul>
        </div>
      </div>
    </div>
  </div>
@endsection
