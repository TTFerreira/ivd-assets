@extends('layouts.app')

@section('main-content')
  <div class="row">
    <div class="col-md-12 col-xs-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Spares</h3>
        </div>
        <div class="box-body">
          <table id="table" class="table table-striped table-bordered table-hover">
            <thead>
              <tr>
                <th>Asset Type</th>
                <th>Division</th>
                <th>Quantity</th>
              </tr>
            </thead>
            <tbody>
              @foreach($assetTypes as $assetType)
                @foreach ($divisions as $division)
                  <?php $quantity = $assetType->sparesCount($assetType->id, $division->id); ?>
                  @if ($quantity >= 1)
                    <tr>
                      <div>
                        <td>{{$assetType->type_name}}</td>
                        <td>{{$division->name}}</td>
                        <td>{{$quantity}}</td>
                      </div>
                    </tr>
                  @endif
                @endforeach
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  @if(Session::has('status'))
    <script>
      $(document).ready(function() {
        Command: toastr["{{Session::get('status')}}"]("{{Session::get('message')}}", "{{Session::get('title')}}");
      });
    </script>
  @endif
@endsection
