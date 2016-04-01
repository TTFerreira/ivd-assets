@extends('layouts.app')

@section('main-content')
	<div class="row">
		<div class="col-md-4 col-xs-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Movement History - 5 Latest</h3>
        </div>
        <div class="box-body">
					<ul class="timeline">
				    <!-- timeline time label -->
						@foreach($movements as $movement)
							<?php $createdDate = \Carbon\Carbon::parse($movement->created_at);
							$asset = App\Asset::find($movement->asset_id); ?>
							<li class="time-label">
				        <span class="bg-aqua">
			            {{$createdDate->format('l, j F Y')}}
				        </span>
					    </li>
					    <!-- /.timeline-label -->

					    <!-- timeline item -->
					    <li>
				        <!-- timeline icon -->
				        <i class="fa fa-user bg-blue"></i>
				        <div class="timeline-item">
			            <span class="time"><i class="fa fa-clock-o"></i> {{$createdDate->format('H:i')}}</span>

			            <h3 class="timeline-header">{{$movement->user->name}}</h3>

			            <div class="timeline-body">
										<dl class="dl-horizontal">
				              <dt>Asset:</dt><dd>{{$asset->asset_tag}}</dd>
				              <dt>Model:</dt><dd>{{$asset->model->manufacturer->name}} {{$asset->model->asset_model}}</dd>
				              <dt>Location:</dt><dd>{{$movement->location->location_name}}</dd>
				              <dt>Status Applied:</dt><dd>{{$movement->status->name}}</dd>
										</dl>
			            </div>
			            <div class="timeline-footer">
			            </div>
				        </div>
				    	</li>
					    <!-- END timeline item -->
						@endforeach
					</ul>
				</div>
			</div>
		</div>
	</div>
@endsection
