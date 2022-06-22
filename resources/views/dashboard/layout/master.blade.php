
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- <link rel="icon" href="http://localhost/projects/downloaded/permission-based-project-ci/assets/img/logo/peyush-logo-favicon.png" type="image/ico" /> --}}
    <title>@yield('title')</title>
    <meta name="theme-color" content="#2A3F54">
    <!-- Bootstrap -->
    <link href="{{asset('theme/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{asset('theme/vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{asset('theme/vendors//nprogress/nprogress.css')}}" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="{{asset('theme/vendors/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet">
    <!-- bootstrap-datetimepicker -->
    <link href="{{asset('theme/vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css')}}" rel="stylesheet">
    <!-- iCheck -->
    <link href="{{asset('theme/vendors/iCheck/skins/flat/green.css')}}" rel="stylesheet">
    <!-- bootstrap-progressbar -->
    <link href="{{asset('theme/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css')}}" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="{{asset('theme/vendors/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="{{asset('theme/vendors/build/css/custom.min.css')}}" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/chosen/1.1.0/chosen.min.css">
    <!-- Datatables -->
    <link rel="stylesheet" href="{{asset('theme/vendors/datatable/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
    <script src="{{asset('theme/vendors/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{asset('web/assets/validate-js/jquery.validate.min.js')}}"></script>
    <script src="{{asset('theme/vendors/sweetalert2/sweetalert2.all.min.js')}}"></script>
    <!-- select2 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="{{asset('theme/vendors/bootstrap-select/css/bootstrap-select.min.css')}}">
    <!-- Icon Font CSS -->
    <link rel="stylesheet" href="{{asset('web/assets/css/ionicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('web/assets/css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{asset('web/assets/css/linearicons.css')}}">
    <link rel="stylesheet" href="{{asset('web/assets/css/flaticon.css')}}">
    <link rel="stylesheet" href="{{asset('web/assets/css/simple-line-icons.css')}}">

    <link href="{{asset('assets/css/busy.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/custom.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/admin-profile.css')}}" rel="stylesheet">
    <script>
        let BASE_URL = {!! json_encode(url('/')) !!}+"/";
        var PROCESSING_IMG = "{{ asset('assets/images/loaders/ajax-loading.gif') }}";
    </script>
</head>
<body class="nav-md">
<div class="container body">
    @php
        $adminUser = Auth::user();
    @endphp
    <div class="main_container">
        <!--====== sidebar =====--->
        @include('dashboard.layout.sidebar')
        <!--====== ends sidebar =====--->

        <!-- ====== top navigation ===== -->
        @include('dashboard.layout.navigation')
        <!-- ====== ends navigation ===== -->

        <!-- ====== page content ===== -->
        <div class="right_col" role="main">
          @yield('page-content')
        </div>
        <!-- ====== ends page content ===== -->

        <!-- ====== busy loader ===== -->
         @include('dashboard.layout.busy')

        <!-- ====== ends busy loader ===== -->

        <!-- ====== footer content ===== -->
        <footer class="d-print-none">
            <div class="pull-right">
                {{ config('app.name') }}  Admin Panel | Powered by <a href="http://www.thevirtualbd.com/" target="_blank">VirtualBD</a>
            </div>
            <div class="clearfix"></div>
        </footer>
        <!-- ====== ends footer content ===== -->
    </div>
</div>
<!-- Bootstrap -->
<script src="{{asset('theme/vendors/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- DataTables -->
<script src="{{asset('theme/vendors/datatable/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('theme/vendors/datatable/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<!-- NProgress -->
<script src="{{asset('theme/vendors/nprogress/nprogress.js')}}"></script>
<!-- jQuery Smart Wizard -->
<script src="{{asset('theme/vendors/jQuery-Smart-Wizard/js/jquery.smartWizard.js')}}"></script>
<script src="{{asset('theme/vendors/fastclick/lib/fastclick.js')}}"></script>
<!-- bootstrap-progressbar -->
<script src="{{asset('theme/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js')}}"></script>
<!-- iCheck -->
<script src="{{asset('theme/vendors/iCheck/icheck.min.js')}}"></script>
<!-- bootstrap-daterangepicker -->
<script src="{{asset('theme/vendors/moment/min/moment.min.js')}}"></script>
<!-- bootstrap-datetimepicker -->
<script src="{{asset('theme/vendors/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
<script src="{{asset('theme/vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js')}}"></script>
<!-- Custom Theme Scripts -->
<script src="{{asset('theme/vendors/build/js/custom.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/admin/common-script.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/common.js')}}"></script>
<!-- Latest compiled and minified JavaScript -->
<script type="text/javascript" src="{{asset('theme/vendors/bootstrap-select/js/bootstrap-select.min.js')}}"></script>
@stack('footer-scripts')

    @yield('script')
</body>
</html>
