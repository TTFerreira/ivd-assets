@extends('layouts.app')

@section('main-content')
  <div class="row">
    <div class="col-md-6">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">{{$pageTitle}}</h3>
        </div>
        <div class="box-body">
          <form method="POST" action="/admin/ticket-statuses/{{$ticketsStatus->id}}/update">
            {{method_field('PATCH')}}
            {{csrf_field()}}
            <div class="form-group {{ hasErrorForClass($errors, 'status') }}">
              <label for="status">Status</label>
              <input type="text" name="status" class="form-control" value="{{$ticketsStatus->status}}">
              {{ hasErrorForField($errors, 'status') }}
            </div>

            <div class="form-group">
              <button type="submit" class="btn btn-primary"><b>Edit Ticket Status</b></button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Ticket Statuses</h3>
        </div>
        <div class="box-body">
          <ul>
            @foreach($ticketsStatuses as $status)
              <li>{{$status->status}}</li>
            @endforeach
        </ul>
        </div>
      </div>
    </div>
  </div>
@endsection
