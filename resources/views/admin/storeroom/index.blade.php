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
              <div class="form-group">
                <label for="store">Default Storeroom</label>
                <select class="form-control store" name="store">
                  <option value = ""></option>
                  @foreach($locations as $location)
                      <option value="{{$location->id}}">{{$location->building}} - {{$location->location_name}}</option>
                  @endforeach
                </select>
              </div>

              <div class="form-group">
                <button type="submit" class="btn btn-primary">Set as Default Storeroom</button>
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

    <script>
      $(document).ready(function() {
        $('#table').DataTable( {
          columnDefs: [ {
            orderable: false, targets: 1
          } ]
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
