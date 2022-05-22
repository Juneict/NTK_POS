<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('dashboard')}}" class="brand-link">
      <img src="/dist/img/logo.png" alt="isys Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
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
          <a href="{{route('dashboard')}}" class="d-block">Admin</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('dashboard')}}" class="nav-link {{ Request::segment(1) == 'dashboard' ? 'active' : ''}}">
                  <i class="fas fa-tachometer-alt nav-icon"></i>
                  <p >Dashboard</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/users" class="nav-link {{ Request::segment(1) == 'users' ? 'active' : ''}}">
                  <i class="fas fa-users nav-icon"></i>
                  <p>Users Management</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/products" class="nav-link {{ Request::segment(1) == 'products' ? 'active' : ''}}">
                  <i class="fas fa-th-large nav-icon"></i>
                  <p>Products</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('cart')}}" class="nav-link {{ Request::segment(1) == 'cart' ? 'active' : ''}}">
                  <i class="fas fa-cart-plus nav-icon"></i>
                  <p>Open POS</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/orders" class="nav-link {{ Request::segment(1) == 'orders' ? 'active' : ''}}">
                  <i class="fas fa-cart-plus nav-icon"></i>
                  <p>Orders</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/customers" class="nav-link {{ Request::segment(1) == 'customers' ? 'active' : ''}}">
                  <i class="fas fa-users nav-icon"></i>
                  <p>Customers</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('logout')}}" method="post" class="nav-link">
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
