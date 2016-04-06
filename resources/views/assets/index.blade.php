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
        <span class="info-box-icon bg-aqua"><i class="fa fa-home"></i></span>

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
        <span class="info-box-icon bg-green"><i class="fa fa-check"></i></span>

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
        <span class="info-box-icon bg-yellow"><i class="fa fa-wrench"></i></span>

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
          <p><a href="assets/create"><button type="button" class="btn btn-default" name="create-new-asset" data-toggle="tooltip" data-original-title="Create New Asset"><span class='glyphicon glyphicon-plus' aria-hidden='true'></span> <b>Create New Asset</b></button></a></p>
          <table id="table" class="table table-striped table-bordered table-hover">
            <thead>
              <tr>
                <th>Asset Tag</th>
                <th>Serial Number</th>
                <th>Model</th>
                <th>Location</th>
                <th>Division</th>
                <th>Status</th>
                <th>Actions</th>
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
                    <td>{{$asset->serial_number or ''}}</td>
                    <td>{{$asset->model->manufacturer->name}} - {{$asset->model->asset_model}}</td>
                    <td>{{$asset->movement->location->location_name}}</td>
                    <td>{{$asset->division->name}}</td>
                    <td>
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
                    </td>
                    <td><a href="/assets/{{ $asset->id }}/move">Move</a> | <a href="/movements/{{ $asset->id }}/history">History</a> | <a href="/assets/{{ $asset->id }}/edit">Edit</a></td>
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
      $('#table').DataTable( {
          columnDefs: [ {
              targets: [ 0 ],
              orderData: [ 0, 1 ]
          }, {
              targets: [ 1 ],
              orderData: [ 1, 0 ]
          }, {
              targets: [ 4 ],
              orderData: [ 4, 0 ]
          } ]
      } );
    } );
  </script>
@endsection
