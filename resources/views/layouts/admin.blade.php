<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>i-SYS POS</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/dist/css/adminlte.min.css">
  <!-- datatable -->
  <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <!--Select2-->
  <link rel="stylesheet" href="../../plugins/select2/css/select2.min.css">
  <style>
    .main-sidebar { background-color: #313140 !important }
    .main-header{background-color: #3C3C4E !important}
    .card-title{color: #313140!important}
    .card-body{color:#556474 !important}
   
    /* .nav-link{color:aliceblue !important}; */
  </style>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  @include('layouts.partials.navbar')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('layouts.partials.sidebar')

  <!-- Content Wrapper. Contains page content -->
  @yield('content')
  <!-- /.content-wrapper -->


  <!-- Main Footer -->
  @include('layouts.partials.footer')
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->

<script src="/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="/dist/js/adminlte.min.js"></script>
<!-- Datatable -->
<script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="/plugins/select2/js/select2.full.min.js"></script>
<script>

  console.log(document.querySelectorAll(".nav-item"));
  // const cart_nav = document.querySelector('.nav-cart');
  // cart_nav.addEventListener('click', function(e){
  //   e.preventDefault();
    
  //   cart_nav.href = 'http://127.0.0.1:8000/cart';

  // })
    // $('.nav-item').click(function (event) {
    //     // Avoid the link click from loading a new page
    //     event.preventDefault();

    //     // Load the content from the link's href attribute
    //     $('.content').load($(this).attr('href'));
    // });

    
</script>

</body>
</html>

