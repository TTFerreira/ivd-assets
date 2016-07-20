@extends('layouts.app')

@section('main-content')
  <div class="row">
    <div class="col-md-6 col-md-offset-3">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">{{$pageTitle}}</h3>
        </div>
        <div class="box-body">
          <form method="POST" action="/budgets/{{$budget->id}}">
            {{method_field('PATCH')}}
            {{csrf_field()}}
            <div class="form-group {{ hasErrorForClass($errors, 'division_id') }}">
              <label for="division_id">Division</label>
              <select class="form-control division_id" name="division_id">
                @foreach($divisions as $division)
                  <option
                    @if($budget->division_id == $division->id)
                      selected
                    @endif
                  value="{{$division->id}}">{{$division->name}}</option>
                @endforeach
              </select>
              {{ hasErrorForField($errors, 'division_id') }}
            </div>
            <div class="form-group {{ hasErrorForClass($errors, 'year') }}">
              <label for="year">Year</label>
              <input type="text"  name="year" class="form-control" value="{{$budget->year}}">
              {{ hasErrorForField($errors, 'year') }}
            </div>
            <div class="form-group {{ hasErrorForClass($errors, 'total') }}">
              <label for="total">Budget Total</label>
              <div class="input-group">
                <div class="input-group-addon">R</div>
                <input type="text"  name="total" class="form-control" value="{{$budget->total}}">
                {{ hasErrorForField($errors, 'total') }}
              </div>
            </div>

            <div class="form-group">
              <button type="submit" class="btn btn-primary"><b>Edit Budget</b></button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
@section('footer')
  <script type="text/javascript">
    $(document).ready(function() {
      $(".division_id").select2();
    });
  </script>
@endsection
