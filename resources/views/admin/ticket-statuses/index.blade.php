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
                <th>Ticket Status</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($ticketsStatuses as $ticketsStatus)
                <tr>
                  <div>
                    <td>{{$ticketsStatus->status}}</td>
                    <td><a href="/admin/ticket-statuses/{{ $ticketsStatus->id }}/edit" class="btn btn-primary"><span class='fa fa-pencil' aria-hidden='true'></span> <b>Edit</b></a></td>
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
          <h3 class="box-title">Create Ticket Status</h3>
        </div>
        <div class="box-body">
          <form method="POST" action="{{ url('admin/ticket-statuses') }}">
            {{csrf_field()}}
            <div class="form-group {{ hasErrorForClass($errors, 'status') }}">
              <label for="status">Status</label>
              <input type="text"  name="status" class="form-control" value="{{old('status')}}">
              {{ hasErrorForField($errors, 'status') }}
            </div>

            <div class="form-group">
              <button type="submit" class="btn btn-primary"><b>Add New Ticket Status</b></button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <script>
      $(document).ready(function() {
        $('#table').DataTable( {
          columnDefs: [ {
            orderable: false, targets: 1
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
