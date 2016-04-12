@extends('layouts.app')

@section('main-content')
  <div class="row">
    <div class="col-md-9">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">{{$pageTitle}}</h3>
        </div>
        <div class="box-body">
          <ul class="timeline">
				    <!-- timeline time label -->
							<?php $createdDate = \Carbon\Carbon::parse($ticket->created_at); ?>
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

			            <h3 class="timeline-header">{{$ticket->user->name}}</h3>

			            <div class="timeline-body">
										<dl class="dl-horizontal">
                      <dt>Subject:</dt><dd>{{$ticket->subject}}</dd>
				              <dt>Description:</dt><dd>{{$ticket->description}}</dd>
										</dl>
			            </div>
			            <div class="timeline-footer">
			            </div>
				        </div>
				    	</li>
					    <!-- END timeline item -->
					</ul>
          <div class="text-center"><a class="btn btn-primary" href="{{ URL::previous() }}">Back</a></div>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">{{$pageTitle}}</h3>
        </div>
        <div class="box-body">
          <ul>
            <li>Assigned to: {{$ticket->user->name}}</li>
            <li>Location: {{$ticket->location->location_name}}</li>
            <li>Status: {{$ticket->ticket_status->status}}</li>
            <li>Type: {{$ticket->ticket_type->type}}</li>
            <li>Priority: {{$ticket->ticket_priority->priority}}</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
@endsection
