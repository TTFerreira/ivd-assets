@extends('layouts.app')

@section('htmlheader_title')
    Insufficient Permissions
@endsection

@section('contentheader_title')
    403 Error
@endsection

@section('$contentheader_description')
@endsection

@section('main-content')

<div class="error-page">
    <h2 class="headline text-yellow"> 403</h2>
    <div class="error-content">
        <h3><i class="fa fa-warning text-yellow"></i> Oops! Insufficient Permissions.</h3>
        <p>
            You do not have the required permission to view this page.
        </p
    </div><!-- /.error-content -->
</div><!-- /.error-page -->
@endsection
