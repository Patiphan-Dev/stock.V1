<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ env('APP_NAME') }} | {{ $title }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('admin-lte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('admin-lte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-lte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <!-- Ionicons -->
    <link rel="icon" type="image/x-icon" href="{{ asset('/store.png') }}">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset('admin-lte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('admin-lte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('admin-lte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('admin-lte/plugins/daterangepicker/daterangepicker.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('admin-lte/plugins/summernote/summernote-bs4.min.css') }}">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('admin-lte/plugins/sweetalert2/sweetalert2.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('admin-lte/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-lte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <!-- Bootstrap4 Duallistbox -->
    <link rel="stylesheet"
        href="{{ asset('admin-lte/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}">
    <!-- BS Stepper -->
    <link rel="stylesheet" href="{{ asset('admin-lte/plugins/bs-stepper/css/bs-stepper.min.css') }}">
    <!-- dropzonejs -->
    <link rel="stylesheet" href="{{ asset('admin-lte/plugins/dropzone/min/dropzone.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('admin-lte/dist/css/adminlte.min.css') }}">
</head>
<style>
    label span {
        color: #ff0000;
    }
</style>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        @include('Partials.navbar')
        @include('Partials.left-sidebar')
        @include('Partials.loading')
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">{{ $title }}</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ url('/') }}">หน้าหลัก</a></li>
                                <li class="breadcrumb-item active">{{ $title }}</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            {{ $slot }}
        </div>

        @include('Partials.footer')
    </div>

    <!-- jQuery -->
    <script src="{{ asset('admin-lte/plugins/jquery/jquery.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('admin-lte/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>

    <script src="{{ asset('admin-lte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin-lte/plugins/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('admin-lte/plugins/sparklines/sparkline.js') }}"></script>
    <script src="{{ asset('admin-lte/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('admin-lte/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
    <script src="{{ asset('admin-lte/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
    <script src="{{ asset('admin-lte/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('admin-lte/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('admin-lte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <script src="{{ asset('admin-lte/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('admin-lte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <script src="{{ asset('admin-lte/dist/js/adminlte.js') }}"></script>
    <script src="{{ asset('admin-lte/dist/js/pages/dashboard.js') }}"></script>
    <script src="{{ asset('admin-lte/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('admin-lte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin-lte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('admin-lte/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('admin-lte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('admin-lte/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('admin-lte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('admin-lte/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('admin-lte/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('admin-lte/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('admin-lte/plugins/select2/js/select2.full.min.js') }}"></script>

    <script>
        $(function() {
            $("#tb_purchase").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["excel", "print"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

            $("#tb_sales").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["excel", "print"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

            $("#tb_product").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["excel", "print"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

            $('.select2').select2();
        });
    </script>
    <script>
        $(function() {
            // Summernote
            $('#summernote').summernote()

            // CodeMirror
            CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
                mode: "htmlmixed",
                theme: "monokai"
            });
        })
    </script>

</body>

</html>
