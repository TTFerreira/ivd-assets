@extends('layouts.app')

@section('main-content')
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Budgets</h3>
        </div>
        <div class="box-body">
          <p><a href="budgets/create"><button type="button" class="btn btn-default" name="create-new-budget" data-toggle="tooltip" data-original-title="Create New Budget"><span class='glyphicon glyphicon-plus' aria-hidden='true'></span> <b>Create New Budget</b></button></a></p>
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
                    <td><a href="/budgets/{{ $budget->id }}/edit">Edit</a></td>
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
                targets: [ 2 ],
                orderData: [ 2, 0 ]
            } ]
        } );
      } );
    </script>
@endsection
