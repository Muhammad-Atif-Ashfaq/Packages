<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="initial-scale=1, maximum-scale=1">
      <title>Pluto - Responsive Bootstrap Admin Panel Templates</title>
      <meta name="keywords" content="">
      <meta name="description" content="">
      <meta name="author" content="">
      <link rel="icon" href="{{ asset('assets/images/fevicon.png') }}" type="image/png" />
      <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
      <link rel="stylesheet" href="{{ asset('assets/style.css') }}" />
      <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}" />
      <link rel="stylesheet" href="{{ asset('assets/css/colors.css') }}" />
      <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-select.css') }}" />
      <link rel="stylesheet" href="{{ asset('assets/css/perfect-scrollbar.css') }}" />
      <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}" />
      <!-- DataTables CSS -->
      <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">

      <!-- jQuery -->
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

      <!-- DataTables JS -->
      <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
      <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
      
      <!-- <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
      <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
      <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
      <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script> -->




   </head>
   <body class="dashboard dashboard_1">
      <div class="full_container">
         <div class="inner_container" >
            @include('backend.admin.partials.navbar')
            <div id="content" style="background-color:rgb(32, 32, 32);">
               @include('backend.admin.partials.topbar')
               <div class="midde_cont">
                 @yield('content')
               </div>
            </div>
         </div>
      </div>
      <script src="{{ asset('assets/js/popper.min.js') }}"></script>
      <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
      <script src="{{ asset('assets/js/animate.js') }}"></script>
      <script src="{{ asset('assets/js/bootstrap-select.js') }}"></script>
      <script src="{{ asset('assets/js/owl.carousel.js') }}"></script>
      <script src="{{ asset('assets/js/Chart.min.js') }}"></script>
      <script src="{{ asset('assets/js/Chart.bundle.min.js') }}"></script>
      <script src="{{ asset('assets/js/utils.js') }}"></script>
      <script src="{{ asset('assets/js/analyser.js') }}"></script>
      <script src="{{ asset('assets/js/perfect-scrollbar.min.js') }}"></script>
      <script>
         var ps = new PerfectScrollbar('#sidebar');
      </script>
      <script src="{{ asset('assets/js/custom.js') }}"></script>
      <script src="{{ asset('assets/js/chart_custom_style1.js') }}"></script>

      <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });

      </script>
   </body>
</html>
