<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">Navigation</li>
            <!-- Only Super Admins and Admins can see the following menu items -->
            @role(['super-admin', 'admin'])
              <li><a href="{{ url('home') }}"><i class='fa fa-home'></i> <span>Home</span></a></li>
              <li><a href="{{ url('/assets')}}"><i class='fa fa-tags'></i> <span>Assets</span></a></li>
            @endrole
            <li class="treeview">
                <a href="{{ url('/tickets')}}"><i class='fa fa-ticket'></i> <span>Tickets</span></a>
            </li>
            <!-- Only Super Admins can see the following menu items -->
            @role(['super-admin'])
              <li class="treeview">
                  <a href="#"><i class='fa fa-desktop'></i> <span>Models</span> <i class="fa fa-angle-left pull-right"></i></a>
                  <ul class="treeview-menu">
                      <li><a href="{{ url('/models')}}">Models</a></li>
                      <li class="divider"></li>
                      <li><a href="{{ url('/pcspecs')}}">PC Specifications</a></li>
                      <li><a href="{{ url('/manufacturers')}}">Manufacturers</a></li>
                      <li><a href="{{ url('/asset-types')}}">Asset Types</a></li>
                  </ul>
              </li>
              <li class="treeview">
                  <a href="{{ url('/suppliers')}}"><i class='fa fa-shopping-cart'></i> <span>Suppliers</span></a>
              </li>
              <li class="treeview">
                  <a href="{{ url('/locations')}}"><i class='fa fa-building'></i> <span>Locations</span></a>
              </li>
              <li class="treeview">
                  <a href="{{ url('/divisions')}}"><i class='fa fa-group'></i> <span>Divisions</span></a>
              </li>
              <li class="treeview">
                  <a href="#"><i class='fa fa-usd'></i> <span>Invoices and Budgets</span> <i class="fa fa-angle-left pull-right"></i></a>
                  <ul class="treeview-menu">
                      <li><a href="{{ url('/invoices')}}">Invoices</a></li>
                      <li><a href="{{ url('/budgets')}}">Budgets</a></li>
                  </ul>
              </li>
              <li><a href="{{ url('/admin')}}"><i class='fa fa-gear'></i> Admin</a></li>
            @endrole
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
