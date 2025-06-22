<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>San Roque Savings and Credit Cooperative</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" type="image/x-icon" href="/img/logo/SRSCC-LOGO.png">
	<meta name="csrf-token" content="{{	csrf_token() }}">

    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/owl.carousel.css">
    <link rel="stylesheet" href="/css/owl.theme.css">
    <link rel="stylesheet" href="/css/owl.transitions.css">
    <link rel="stylesheet" href="/css/animate.css">
    <link rel="stylesheet" href="/css/normalize.css">
    <link rel="stylesheet" href="/css/meanmenu.min.css">
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/educate-custon-icon.css">
    <link rel="stylesheet" href="/css/scrollbar/jquery.mCustomScrollbar.min.css">
    <link rel="stylesheet" href="/css/metisMenu/metisMenu.min.css">
    <link rel="stylesheet" href="/css/metisMenu/metisMenu-vertical.css">
    <link rel="stylesheet" href="/css/calendar/fullcalendar.min.css">
    <link rel="stylesheet" href="/css/calendar/fullcalendar.print.min.css">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/responsive.css">
    
    <link rel="stylesheet" href="/css/modals.css">
    <script src="/js/vendor/modernizr-2.8.3.min.js"></script>
    
    @yield('style')
</head>

<body>

	@include('admin.body.sidebar')

    <!-- End Left menu area -->
    <!-- Start Welcome area -->
    <div class="all-content-wrapper">

        @include('admin.body.header')

        <div class="content">
            @yield('content')
        </div>

        <div class="footer-copyright-area">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="footer-copy-right">
                            <p>Copyright © {{date('Y')}}. All rights reserved.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="loadingModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content modal-sm">
                    <div class="modal-body">
                        <div>Processing...</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="/js/vendor/jquery-1.12.4.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/wow.min.js"></script>
    <script src="/js/jquery-price-slider.js"></script>
    <script src="/js/jquery.meanmenu.js"></script>
    <script src="/js/owl.carousel.min.js"></script>
    <script src="/js/jquery.sticky.js"></script>
    <script src="/js/jquery.scrollUp.min.js"></script>
    <script src="/js/counterup/jquery.counterup.min.js"></script>
    <script src="/js/counterup/waypoints.min.js"></script>
    <script src="/js/counterup/counterup-active.js"></script>
    <script src="/js/scrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="/js/scrollbar/mCustomScrollbar-active.js"></script>
    <script src="/js/metisMenu/metisMenu.min.js"></script>
    <script src="/js/metisMenu/metisMenu-active.js"></script>
    <script src="/js/sparkline/jquery.sparkline.min.js"></script>
    <script src="/js/sparkline/jquery.charts-sparkline.js"></script>
    <script src="/js/sparkline/sparkline-active.js"></script>
    <script src="/js/calendar/moment.min.js"></script>
    <script src="/js/calendar/fullcalendar.min.js"></script>
    <script src="/js/calendar/fullcalendar-active.js"></script>
    <script src="/js/plugins.js"></script>
    <script src="/js/main.js"></script>
    <script src="/js/custom/functions.js"></script>
    
    @yield('script')
</body>

</html>