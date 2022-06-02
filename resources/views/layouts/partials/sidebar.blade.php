<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('dashboard')}}" class="brand-link">
      <img src="/dist/img/logo.PNG" alt="isys Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light"><b>i-SYS POS</b> </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="/dist/img/account.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="{{route('dashboard')}}" class="d-block">{{ auth()->user()->name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <ul class="nav nav-treeview">

              @can('user_management')
              <li class="nav-item">
                <a href="{{route('dashboard')}}" class="nav-link {{ Request::segment(1) == 'dashboard' ? 'active' : ''}}">
                  <i class="fas fa-tachometer-alt nav-icon"></i>
                  <p >Dashboard</p>
                </a>
              </li>
              @endcan

              @can('user_management')

              <li class="nav-item">
                <a href="{{route('users.index')}}" class="nav-link {{ Request::segment(1) == 'users' ? 'active' : ''}}">
                  <i class="fas fa-users nav-icon"></i>
                  <p>Users Management</p>
                </a>
              </li>

              @endcan

              <li class="nav-item menu-is-opening menu-open">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-warehouse"></i>
                  <p>
                    Inventory
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview" style="display: block;">
                  <li class="nav-item" style="margin-left: 15px">
                    <a href="{{route('brands.index')}}" class="nav-link {{ Request::segment(1) == 'brands' ? 'active' : ''}}">
                      <i class="fas fa-star nav-icon"></i>
                      <p>Brands</p>
                    </a>
                  </li>
                  <li class="nav-item" style="margin-left: 15px">
                    <a href="{{route('categories.index')}}" class="nav-link {{ Request::segment(1) == 'categories' ? 'active' : ''}}">
                      <i class="fas fa-list nav-icon"></i>
                      <p>Categories</p>
                    </a>
                  </li>
                  <li class="nav-item" style="margin-left: 15px">
                    <a href="{{route('products.index')}}" class="nav-link {{ Request::segment(1) == 'products' ? 'active' : ''}}">
                      <i class="fas fa-box-open nav-icon"></i>
                      <p>Products</p>
                    </a>
                  </li>
                </ul>
              </li>

              <li class="nav-item">
                <a href="{{route('cart')}}" class="nav-link {{ Request::segment(1) == 'cart' ? 'active' : ''}}">
                  <i class="fas fa-cart-plus nav-icon"></i>
                  <p>Cart</p>
                </a>
              </li>
              <li class="nav-item" >
                <a href="{{route('orders.index')}}" class="nav-link {{ Request::segment(1) == 'orders' ? 'active' : ''}}">
                  <i class="fas fa-calendar-check nav-icon"></i>
                  <p>Orders</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('credits.index')}}" class="nav-link {{ Request::segment(1) == 'credits' ? 'active' : ''}}">
                  <i class="fas fa-credit-card nav-icon"></i>
                  <p>Credit List</p>
                </a>
              </li>
              <li class="nav-item" >
                <a href="{{route('customers.index')}}" class="nav-link {{ Request::segment(1) == 'customers' ? 'active' : ''}}">
                  <i class="fas fa-users nav-icon"></i>
                  <p>Customers</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('user.logout')}}" method="post" class="nav-link">
                  <i class=" fas fa-sign-out-alt nav-icon"></i>
                  <p>Logout</p>
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
