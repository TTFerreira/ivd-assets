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
                <th>Division</th>
                <th>Year</th>
                <th>Budget Total</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($budgets as $budget)
                <tr>
                  <div>
                    <td>{{$budget->division->name}}</td>
                    <td>{{$budget->year}}</td>
                    <td>R{{number_format($budget->total,2)}}</td>
                    <td><a href="/budgets/{{ $budget->id }}/edit" class="btn btn-primary"><span class='fa fa-pencil' aria-hidden='true'></span> <b>Edit</b></a></td>
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
          <h3 class="box-title">Create Budget</h3>
        </div>
        <div class="box-body">
          <form method="POST" action="{{ url('budgets') }}">
            {{csrf_field()}}
            <div class="form-group {{ hasErrorForClass($errors, 'division_id') }}">
              <label for="division_id">Division</label>
              <select class="form-control division_id" name="division_id">
                <option value = ""></option>
                @foreach($divisions as $division)
                    <option value="{{$division->id}}">{{$division->name}}</option>
                @endforeach
              </select>
              {{ hasErrorForField($errors, 'division_id') }}
            </div>
            <div class="form-group {{ hasErrorForClass($errors, 'year') }}">
              <label for="year">Year</label>
              <input type="text"  name="year" class="form-control" value="{{old('year')}}">
              {{ hasErrorForField($errors, 'year') }}
            </div>
            <div class="form-group {{ hasErrorForClass($errors, 'total') }}">
              <label for="total">Budget Total</label>
              <div class="input-group">
                <div class="input-group-addon">R</div>
                <input type="text"  name="total" class="form-control" value="{{old('total')}}">
                {{ hasErrorForField($errors, 'total') }}
              </div>
            </div>

            <div class="form-group">
              <button type="submit" class="btn btn-primary"><b>Add New Budget</b></button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <script>
    $(document).ready(function() {
      $('#table').DataTable( {
        columnDefs: [ {
          orderable: false, targets: 3
        } ],
        order: [[ 1, "desc" ]]
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
@section('footer')
  <script type="text/javascript">
    $(document).ready(function() {
      $(".division_id").select2();
    });
  </script>
@endsection
