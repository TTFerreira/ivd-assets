@extends('layouts.app')

@section('main-content')
  <div class="row">
    <div class="col-md-3">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Ticket Configurations</h3>
        </div>
        <div class="box-body">
          <a href="/admin/ticket-canned-fields" class="btn btn-app">
            <i class="fa fa-bolt"></i> Canned Fields
          </a>
          <a href="/admin/ticket-statuses" class="btn btn-app">
            <i class="fa fa-check"></i> Statuses
          </a>
          <a href="/admin/ticket-types" class="btn btn-app">
            <i class="fa fa-sliders"></i> Types
          </a>
          <a href="/admin/ticket-priorities" class="btn btn-app">
            <i class="fa fa-clock-o"></i> Priorities
          </a>
        </div>
      </div>
    </div>
    <div class="col-md-2">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Assets Statuses</h3>
        </div>
        <div class="box-body">
          <a href="/admin/assets-statuses" class="btn btn-app">
            <i class="fa fa-check"></i> Assets Statuses
          </a>
        </div>
      </div>
    </div>
    <div class="col-md-2">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Storeroom</h3>
        </div>
        <div class="box-body">
          <a href="/admin/storeroom" class="btn btn-app">
            <i class="fa fa-bank"></i> Set Storeroom
          </a>
        </div>
      </div>
    </div>
    <div class="col-md-2">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Emails</h3>
        </div>
        <div class="box-body">
          <a href="/admin/emails-tickets" class="btn btn-app">
            <i class="fa fa-ticket"></i> Tickets
          </a>
        </div>
      </div>
    </div>
  </div>
@endsection
