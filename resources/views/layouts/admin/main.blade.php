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
    <link rel="icon" href="{{ url('public/images/bp-logo.png') }}">
    <title>{{ $title ?? env('APP_NAME') }}</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=K2D:ital,wght@0,100;0,300;0,400;0,500;1,200&display=swap" rel="stylesheet">
    <!-- Fontfaces CSS-->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">

    <link href="{{ asset('public/theme/css/font-face.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('public/theme/vendor/font-awesome-4.7/css/font-awesome.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('public/theme/vendor/font-awesome-5/css/fontawesome-all.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('public/theme/vendor/mdi-font/css/material-design-iconic-font.min.css') }}" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="{{ asset('public/theme/vendor/bootstrap-4.1/bootstrap.min.css') }}" rel="stylesheet" media="all">

    <!-- theme/Vendor CSS-->
    <link href="{{ asset('public/theme/vendor/animsition/animsition.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('public/theme/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('public/theme/vendor/wow/animate.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('public/theme/vendor/css-hamburgers/hamburgers.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('public/theme/vendor/slick/slick.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('public/theme/vendor/select2/select2.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('public/theme/vendor/perfect-scrollbar/perfect-scrollbar.css') }}" rel="stylesheet" media="all">
    <link rel="stylesheet" href="https://earthchie.github.io/jquery.Thailand.js/jquery.Thailand.js/dist/jquery.Thailand.min.css">

    <!-- Main CSS-->
    <link href="{{ asset('public/theme/css/theme.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('public/css/app.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('public/css/custom.css') }}" rel="stylesheet" media="all">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/DataTables/datatables.min.css') }}" />
    <style>
        * {
            font-family: "K2D"
        }

        .modal-backdrop .fade .show {
            display: none !important;
        }

        #map {
            height: 60vh;
        }
.modal {
    -webkit-transform: translateX(0%) translateY(25%) !important;
    -moz-transform: translateX(0%) translateY(25%) !important;
    -ms-transform: translateX(0%) translateY(25%) !important;
    transform: translateX(0%) translateY(25%) !important;
}
.modal-backdrop {
     display: none !important;
}
.note-modal-backdrop{
	display:none !important;

}
    </style>
</head>

<body class="animsition" style="opacity: 1;">
    <div id="app">
        <div class="page">
            @include('layouts.admin.nav')
            @include('layouts.admin.sidebar')

            <div class="page-container">
                @include('layouts.admin.navdesk')
                <div class="main-content">
                    <div class="section__content section__content--p30">
                        <div class="container-fluid">
                            @if (\Session::has('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <strong>{{ \Session::get('success') }}</strong>
                            </div>
                            @endif
                            @if (\Session::has('flash_message'))
                            <div class="alert alert-info alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <strong>{{ \Session::get('flash_message') }}</strong>
                            </div>
                            @endif
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
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
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js">
    </script>
    <script src="{{ asset('public/js/custom.js') }}"></script>

    <!-- Main JS-->
    <script type="text/javascript" src="https://earthchie.github.io/jquery.Thailand.js/jquery.Thailand.js/dependencies/JQL.min.js"></script>
    <script type="text/javascript" src="https://earthchie.github.io/jquery.Thailand.js/jquery.Thailand.js/dependencies/typeahead.bundle.js"></script>
    <script type="text/javascript" src="https://earthchie.github.io/jquery.Thailand.js/jquery.Thailand.js/dist/jquery.Thailand.min.js"></script>
    <script src="{{ asset('public/theme/js/main.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/DataTables/datatables.min.js') }}"></script>

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
	<script type="text/javascript">
        function logout() {
            if (confirm('are you sure to logout?')) {
                $('#logout-form').submit();
            }
        }
        $.Thailand({
            $district: $('#district'), // input ของตำบล
            $amphoe: $('#amphoe'), // input ของอำเภอ
            $province: $('#province'), // input ของจังหวัด
            $zipcode: $('#zipcode'), // input ของรหัสไปรษณีย์
        });
        $(document).ready(function() {
            
            $('textarea').summernote({
                height: '300px'
            });
        });
    </script>
    @yield('scripts')
</body>

@yield('modal')

</html>