@extends('layouts.app')

@section('main-content')
  <div class="row">
    <div class="col-md-6 col-md-offset-3">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">{{$pageTitle}}</h3>
        </div>
        <div class="box-body">
          <form method="POST" action="/budgets/{{$budget->id}}/update">
            {{method_field('PATCH')}}
            {{csrf_field()}}
            <div class="form-group">
              <label for="division_id">Division</label>
              <select class="form-control division_id" name="division_id">
                @foreach($divisions as $division)
                  <option
                    @if($budget->division_id == $division->id)
                      selected
                    @endif
                  value="{{$budget->id}}">{{$division->name}}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="year">Year</label>
              <input type="text"  name="year" class="form-control" value="{{$budget->year}}">
            </div>
            <div class="form-group">
              <label for="total">Budget Total</label>
              <div class="input-group">
                <div class="input-group-addon">R</div>
                <input type="text"  name="total" class="form-control" value="{{$budget->total}}">
              </div>
            </div>

            <div class="form-group">
              <button type="submit" class="btn btn-primary">Edit Budget</button>
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
@section('footer')
  <script type="text/javascript">
    $(document).ready(function() {
      $(".division_id").select2();
    });
  </script>
  <script>
    $(":input").keypress(function(event){
      if (event.which == '10' || event.which == '13') {
        event.preventDefault();
      }
    });
  </script>
@endsection
