<!DOCTYPE html>
<html lang="{{ 'th' }}">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page -->
    <link rel="icon" href="{{ url('public/theme/images/icon/department.svg') }}">
    <title>{{ $title ?? env('APP_NAME') }}</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=K2D:ital,wght@0,100;0,300;0,400;0,500;1,200&display=swap"
        rel="stylesheet">
    <!-- Fontfaces CSS-->
    <link href="{{ asset('public/theme/css/font-face.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('public/theme/vendor/font-awesome-4.7/css/font-awesome.min.css') }}" rel="stylesheet"
        media="all">
    <link href="{{ asset('public/theme/vendor/font-awesome-5/css/fontawesome-all.min.css') }}" rel="stylesheet"
        media="all">
    <link href="{{ asset('public/theme/vendor/mdi-font/css/material-design-iconic-font.min.css') }}" rel="stylesheet"
        media="all">

    <!-- Bootstrap CSS-->
    <link href="{{ asset('public/theme/vendor/bootstrap-4.1/bootstrap.min.css') }}" rel="stylesheet" media="all">

    <!-- theme/Vendor CSS-->
    <link href="{{ asset('public/theme/vendor/animsition/animsition.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('public/theme/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css') }}"
        rel="stylesheet" media="all">
    <link href="{{ asset('public/theme/vendor/wow/animate.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('public/theme/vendor/css-hamburgers/hamburgers.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('public/theme/vendor/slick/slick.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('public/theme/vendor/select2/select2.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('public/theme/vendor/perfect-scrollbar/perfect-scrollbar.css') }}" rel="stylesheet"
        media="all">

    <!-- Main CSS-->
    <link href="{{ asset('public/theme/css/theme.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('public/css/app.css') }}" rel="stylesheet" media="all">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/DataTables/datatables.min.css') }}" />
    <style>
        * {
            font-family: "K2D"
        }
    </style>
</head>

<body class="animsition" style="animation-duration: 300ms; opacity: 1;)">
    <div id="app">
        <div class="page" style="background-image: url('{{ asset('public/images/bg.png') }}'; background-repeat: no-repeat;
            background-size: 100% 100%;">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            @yield('content')
        </div>

    </div>
    <script src="{{ asset('public/js/app.js') }}"></script>
    <script src="{{ asset('public/theme/vendor/slick/slick.min.js') }}">
    </script>
    <script src="{{ asset('public/theme/vendor/wow/wow.min.js') }}"></script>
    <script src="{{ asset('public/theme/vendor/animsition/animsition.min.js') }}"></script>
    <script src="{{ asset('public/theme/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js') }}">
    </script>
    <script src="{{ asset('public/theme/vendor/counter-up/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('public/theme/vendor/counter-up/jquery.counterup.min.js') }}">
    </script>
    <script src="{{ asset('public/theme/vendor/circle-progress/circle-progress.min.js') }}"></script>
    <script src="{{ asset('public/theme/vendor/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('public/theme/vendor/chartjs/Chart.bundle.min.js') }}"></script>
    <script src="{{ asset('public/theme/vendor/select2/select2.min.js') }}">
    </script>

    <!-- Main JS-->
    <script src="{{ asset('public/theme/js/main.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/DataTables/datatables.min.js') }}"></script>
    <script type="text/javascript">
        function logout() {
            if (confirm('are you sure to logout?')) {
                $('#logout-form').submit();
            }
        }

        $(document).ready(function() {
            $(".data-table").DataTable({
                dom: 'Bfrtip'
                , autoFill: true
                , buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
        });

    </script>
    @yield('scripts')
</body>

@yield('modal')

</html>
