<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        @if (! Auth::guest())
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{{asset('/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image" />
                </div>
                <div class="pull-left info">
                    <p>{{ Auth::user()->name }}</p>
                    <!-- Status -->
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>
        @endif

        <!-- search form (Optional) -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">Navigation</li>
            <!-- Optionally, you can add icons to the links -->
            <li><a href="{{ url('home') }}"><i class='fa fa-home'></i> <span>Home</span></a></li>
            <li class="treeview">
                <a href="#"><i class='fa fa-tags'></i> <span>Assets</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('/assets')}}">View Assets</a></li>
                    <li><a href="{{ url('/assets/create')}}">Create Asset</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class='fa fa-desktop'></i> <span>Models</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('/models')}}">View Models</a></li>
                    <li><a href="{{ url('/models/create')}}">Create Model</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class='fa fa-server'></i> <span>PC Specifications</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('/pcspecs')}}">View PC Specifications</a></li>
                    <li><a href="{{ url('/pcspecs/create')}}">Create PC Specification</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class='fa fa-copyright'></i> <span>Manufacturers</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('/manufacturers')}}">View Manufacturers</a></li>
                    <li><a href="{{ url('/manufacturers/create')}}">Create Manufacturer</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class='fa fa-shopping-cart'></i> <span>Suppliers</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('/suppliers')}}">View Suppliers</a></li>
                    <li><a href="{{ url('/suppliers/create')}}">Create Supplier</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class='fa fa-cubes'></i> <span>Asset Types</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('/asset-types')}}">View Asset Types</a></li>
                    <li><a href="{{ url('/asset-types/create')}}">Create Asset Type</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class='fa fa-building'></i> <span>Locations</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('/locations')}}">View Locations</a></li>
                    <li><a href="{{ url('/locations/create')}}">Create Location</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class='fa fa-group'></i> <span>Divisions</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('/divisions')}}">View Divisions</a></li>
                    <li><a href="{{ url('/divisions/create')}}">Create Division</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class='fa fa-check'></i> <span>Statuses</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('/statuses')}}">View Statuses</a></li>
                    <li><a href="{{ url('/statuses/create')}}">Create Status</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class='fa fa-usd'></i> <span>Invoices</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('/invoices')}}">View Invoices</a></li>
                    <li><a href="{{ url('/invoices/create')}}">Create Invoice</a></li>
                </ul>
            </li>
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
