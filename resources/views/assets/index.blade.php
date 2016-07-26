@extends('layouts.app')

@section('main-content')
  <div class="row">
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-purple"><i class="fa fa-tags"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Total Assets</span>
          <span class="info-box-number">{{$totalAssets}}</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-aqua"><i class="fa fa-check-circle"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Deployed</span>
          <span class="info-box-number">{{$deployed}}</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-green"><i class="fa fa-plus-circle"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Ready to Deploy</span>
          <span class="info-box-number">{{$readyToDeploy}}</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-yellow"><i class="fa fa-times-circle"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Repairs</span>
          <span class="info-box-number">{{$repairs}}</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
  </div>
  <div class="row">
    <div class="col-md-12 col-xs-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Assets</h3>
        </div>
        <div class="box-body">
          <p class="pull-right"><a href="assets/create"><button type="button" class="btn btn-default" name="create-new-asset" data-toggle="tooltip" data-original-title="Create New Asset"><span class='fa fa-plus' aria-hidden='true'></span> <b>Create New Asset</b></button></a></p>
          <table id="table" class="table table-striped table-bordered table-hover">
            <thead>
              <tr>
                <th>Tag</th>
                <th>Asset Type</th>
                <th>S/N</th>
                <th>Model</th>
                <th>Location</th>
                <th>Division</th>
                <th>Status</th>
                <th>Actions</th>
                <th>Supplier</th>
                <th>Purchase Date</th>
                <th>Warranty Months</th>
                <th>Warranty Type</th>
              </tr>
            </thead>
            <tbody>
              <?php $now = new \Carbon\Carbon(); ?>
              @foreach($assets as $asset)
                @if($asset->purchase_date != '0000-00-00')
                  <?php $purchasedDate = \Carbon\Carbon::parse($asset->purchase_date);
                  $age = $purchasedDate->diffInMonths($now); ?>
                @endif
                <tr
                  @if(isset($age))
                    @if($age > 59)
                      class="danger"
                    @elseif($age > 47 && $age < 60)
                      class="warning"
                    @endif
                  @endif
                >
                  <div>
                    <td>{{$asset->asset_tag}}</td>
                    <td>{{$asset->model->asset_type->type_name}}</td>
                    <td>{{$asset->serial_number or ''}}</td>
                    <td>
                      <div id="model{{$asset->id}}" class="hover-pointer">
                        {{$asset->model->manufacturer->name}} - {{$asset->model->asset_model}}
                      </div>
                    </td>
                    <td>
                      <div id="location{{$asset->id}}" class="hover-pointer">
                        {{$asset->movement->location->location_name}}
                      </div>
                    </td>
                    <td>
                      <div id="division{{$asset->id}}" class="hover-pointer">
                        {{$asset->division->name}}
                      </div>
                    </td>
                    <td>
                      <div id="status{{$asset->id}}" class="hover-pointer">
                        @if($asset->movement->status->id == 1)
                          <span class="label label-success">
                        @elseif($asset->movement->status->id == 2)
                          <span class="label label-info">
                        @elseif($asset->movement->status->id == 3 || $asset->movement->status->id == 4)
                          <span class="label label-warning">
                        @elseif($asset->movement->status->id == 5 || $asset->movement->status->id == 6)
                          <span class="label label-danger">
                        @endif
                        {{$asset->movement->status->name}}</span>
                      </div>
                    </td>
                    <td>
                      <div class="btn-group">
                        <a href="/assets/{{ $asset->id }}/move" class="btn btn-primary"><span class="fa fa-send" aria-hidden="true"></span> <b>Move</b></a>
                        <a href="/assets/{{ $asset->id }}/history" class="btn btn-primary"><span class="fa fa-calendar" aria-hidden="true"></span> <b>History</b></a>
                        <a href="/assets/{{ $asset->id }}/edit" class="btn btn-primary"><span class="fa fa-pencil" aria-hidden="true"></span> <b>Edit</b></a>
                      </div>
                    </td>
                    <td>{{$asset->supplier->name}}</td>
                    <td>{{$asset->purchase_date}}</td>
                    <td>{{$asset->warranty_months}}</td>
                    <td>{{$asset->warranty_type->name}}</td>
                  </div>
                </tr>
                <?php $age = null; ?>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <script>
  $(document).ready(function() {
    var table = $('#table').DataTable( {
        responsive: true,
        dom: 'l<"clear">Bfrtip',
        buttons: [
            {
              extend: 'excel',
              exportOptions: {
                columns: [0, 1, 2, 3, 4, 5, 6, 8, 9, 10, 11]
              }
            },
            {
              extend: 'csv',
              exportOptions: {
                columns: [0, 1, 2, 3, 4, 5, 6, 8, 9, 10, 11]
              }
            },
            {
              extend: 'copy',
              exportOptions: {
                columns: [0, 1, 2, 3, 4, 5, 6, 8, 9, 10, 11]
              }
            }
        ],
        columns: [
          null,
          { "visible": false },
          null,
          null,
          null,
          null,
          null,
          null,
          { "visible": false },
          { "visible": false },
          { "visible": false },
          { "visible": false }
        ], columnDefs: [{
          orderable: false, targets: 7
        }]
    } );
    // Get the model, location, division and status columns' div IDs for each row.
    // If it is clicked on, then the datatable will filter that.
    @foreach($assets as $asset)
      // Model
      var model = (function() {
        var x = '#model' + {{$asset->id}};
        return x;
      });
      $(model()).click(function () {
        table.search( "{{$asset->model->manufacturer->name}} - {{$asset->model->asset_model}}" ).draw();
      });

      // Location
      var location = (function() {
        var x = '#location' + {{$asset->id}};
        return x;
      });
      $(location()).click(function () {
        table.search( "{{$asset->movement->location->location_name}}" ).draw();
      });

      // Division
      var division = (function() {
        var x = '#division' + {{$asset->id}};
        return x;
      });
      $(division()).click(function () {
        table.search( "{{$asset->division->name}}" ).draw();
      });

      // Status
      var status = (function() {
        var x = '#status' + {{$asset->id}};
        return x;
      });
      $(status()).click(function () {
        table.search( "{{$asset->movement->status->name}}" ).draw();
      });
    @endforeach
  } );
  </script>
@endsection
