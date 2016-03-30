<!-- Content Header (Page header) -->
<section class="content-header">
  @if(isset($pageTitle))
    <h1>
      @yield('contentheader_title', $pageTitle)
      <small>@yield('contentheader_description', 'Blah Blah')</small>
    </h1>
  @else
    <h1>@yield('contentheader_title', '&nbsp;')</h1>
  @endif
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
    <li class="active">Here</li>
  </ol>
</section>
