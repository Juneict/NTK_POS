<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars" style="color: aliceblue !important"></i></a>
    </li>
  </ul>

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <!-- Navbar Search -->
    <li class="nav-item">
      <a href="{{route('cart')}}" class="btn btn-success">
        <i class="fas fa-cart-plus"></i>Open Cart
      </a>
    </li> 

    <!-- Messages Dropdown Menu -->
    <li class="nav-item dropdown">
      <a class="nav-link"  role="button"><b style="color: aliceblue !important">{{date('d-m-Y')}}</b></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-widget="fullscreen" href="#" role="button">
        <i class="fas fa-expand-arrows-alt" style="color: aliceblue !important"></i>
      </a>
    </li>
  </ul>
</nav>