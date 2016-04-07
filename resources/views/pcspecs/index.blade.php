@extends('layouts.app')

@section('main-content')
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">{{$pageTitle}}</h3>
        </div>
        <div class="box-body">
          <p><a href="pcspecs/create"><button type="button" class="btn btn-default" name="create-new-pcspec" data-toggle="tooltip" data-original-title="Create New PC Specification"><span class='glyphicon glyphicon-plus' aria-hidden='true'></span> <b>Create New PC Specification</b></button></a></p>
          <table id="table" class="table table-striped table-bordered table-hover">
            <thead>
              <tr>
                <th>CPU</th>
                <th>RAM</th>
                <th>HDD</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($pcspecs as $pcspec)
                <tr>
                  <div>
                    <td>{{$pcspec->cpu}}</td>
                    <td>{{$pcspec->ram}}</td>
                    <td>{{$pcspec->hdd}}</td>
                    <td><a href="/pcspecs/{{ $pcspec->id }}/edit">Edit</a></td>
                  </div>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <script>
      $(document).ready(function() {
        $('#table').DataTable( {
            columnDefs: [ {
                targets: [ 0 ],
                orderData: [ 0, 1 ]
            }, {
                targets: [ 1 ],
                orderData: [ 1, 0 ]
            }, {
                targets: [ 1 ],
                orderData: [ 1, 0 ]
            } ]
        } );
      } );
    </script>
@endsection
