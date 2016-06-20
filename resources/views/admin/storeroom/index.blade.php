@extends('layouts.app')

@section('main-content')
  <div class="row">
    <div class="col-md-5">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">{{$pageTitle}}</h3>
        </div>
        <div class="box-body">
          <h4><b>Current Storeroom:</b>
            @if(isset($storeroom))
              {{$storeroom->location_name}}
            @else
              No Default Set. Please select the Default Storeroom
            @endif </h4>
            <form method="POST" action="/admin/storeroom/update">
              {{method_field('PATCH')}}
              {{csrf_field()}}
              <div class="form-group {{ hasErrorForClass($errors, 'store') }}">
                <label for="store">Default Storeroom</label>
                <select class="form-control store" name="store">
                  <option value = ""></option>
                  @foreach($locations as $location)
                      <option value="{{$location->id}}">{{$location->building}} - {{$location->location_name}}</option>
                  @endforeach
                </select>
                {{ hasErrorForField($errors, 'store') }}
              </div>

              <div class="form-group">
                <button type="submit" class="btn btn-primary"><b>Set as Default Storeroom</b></button>
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
          orderable: false, targets: 1
        } ],
        order: [[ 0, "asc" ]]
      } );
    } );
  </script>
  @if(Session::has('status'))
    <script>
      $(document).ready(function() {
        Command: toastr["{{Session::get('status')}}"]("{{Session::get('message')}}", "{{Session::get('title')}}")
      });
    </script>
  @endif
@endsection

@section('footer')
  <script type="text/javascript">
    $(document).ready(function() {
      $(".store").select2();
    });
  </script>
@endsection
