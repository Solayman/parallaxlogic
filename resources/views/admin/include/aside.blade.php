@php
$prefix = Request::route()->getPrefix();
$route = Route::current()->getName();
@endphp
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="{{url('admin/dashboard')}}" class="brand-link">
    <img src="{{asset('assets/admin_asset/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">Parallaxlogic</span>
  </a>
  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{(!empty(Auth::user()->photo))?url('upload/adminimage/'.Auth::user()->photo):url('upload/userimage.png')}}" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="{{ route('admin.view.profile') }}" class="d-block">{{ Auth::user()->name }}</a>
      </div>
    </div>
    <!-- SidebarSearch Form -->
    {{--     <div class="form-inline">
      <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-sidebar">
          <i class="fas fa-search fa-fw"></i>
          </button>
        </div>
      </div>
    </div> --}}
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
        with font-awesome or any other icon font library -->
        <li class="nav-item">
          <a href="{{url('admin/dashboard')}}" class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
              <!-- <span class="right badge badge-danger">New</span> -->
            </p>
          </a>
        </li>
        <li class="nav-item {{ request()->is(['admin/staff','admin/sub/staff']) ? 'menu-open' : '' }}">
          <a href="#" class="nav-link ">
            <i class="nav-icon fas fa-user"></i>
            <p>
              Admin Section
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{asset('admin/staff')}}" class="nav-link {{ request()->is('admin/staff') ? 'active' : '' }}" style="{{ request()->is('admin/staff') ? 'background-color:yellow' : '' }};">
                <i class="far fa-circle nav-icon mr-2 "></i>
                <p>Admin List</p>
              </a>
            </li>
            
          </ul>
        </li>

         <li class="nav-item {{ request()->is(['admin/staff','admin/sub/staff']) ? 'menu-open' : '' }}">
          <a href="#" class="nav-link ">
            <i class="nav-icon fas fa-user"></i>
            <p>
              Product Section
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{asset('admin/product_list')}}" class="nav-link {{ request()->is('admin/product_list') ? 'active' : '' }}" style="{{ request()->is('admin/product_list') ? 'background-color:yellow' : '' }};">
                <i class="far fa-circle nav-icon mr-2 "></i>
                <p>Manage Product</p>
              </a>
            </li>


             <li class="nav-item">
              <a href="{{asset('admin/add_product')}}" class="nav-link {{ request()->is('admin/add_product') ? 'active' : '' }}" style="{{ request()->is('admin/add_product') ? 'background-color:yellow' : '' }};">
                <i class="far fa-circle nav-icon mr-2 "></i>
                <p>Add Product</p>
              </a>
            </li>
            
          </ul>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>