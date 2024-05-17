<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" href="resources/assets/images/favicon.png">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- favicon -->
    <link rel="icon" type="image/png" href="assets/images/favicon.png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/vendors/bootstrap/css/bootstrap.min.css" media="all">
    <!-- Fonts Awesome CSS -->
    <link rel="stylesheet" type="text/css" href="assets/vendors/fontawesome/css/all.min.css">
    <!-- Elmentkit Icon CSS -->
    <link rel="stylesheet" type="text/css" href="assets/vendors/elementskit-icon-pack/assets/css/ekiticons.css">
    <!-- Fonts Awesome CSS -->
    <link rel="stylesheet" type="text/css" href="assets/vendors/progressbar-fill-visible/css/progressBar.css">
    <!-- jquery-ui css -->
    <link rel="stylesheet" type="text/css" href="assets/vendors/jquery-ui/jquery-ui.min.css">
    <!-- modal video css -->
    <link rel="stylesheet" type="text/css" href="assets/vendors/modal-video/modal-video.min.css">
    <!-- light box css -->
    <link rel="stylesheet" type="text/css" href="assets/vendors/fancybox/dist/jquery.fancybox.min.css">
    <!-- slick slider css -->
    <link rel="stylesheet" type="text/css" href="assets/vendors/slick/slick.css">
    <link rel="stylesheet" type="text/css" href="assets/vendors/slick/slick-theme.css">

    <!-- google fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400&family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,400&display=swap"
        rel="stylesheet">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/assets/sass/style.scss', 'resources/assets/js/custom.js'])

</head>

<body class="home">
    {{-- <div id="siteLoader" class="site-loader">
        <div class="preloader-content">
            <img src="assets/images/loader1.gif" alt="">
        </div>
    </div> --}}

    <div id="app" class="full-page">
        <header-component></header-component>
        

        <main id="content" class="site-main">
            @yield('content')
        </main>

        <footer id="colophon" class="site-footer footer-primary">
            <div class="top-footer">
                <div class="container">
                    <div class="top-footer">
                        <div class="row align-items-center">
                            <div class="col-lg-8">
                                <div class="footer-newsletter">
                                    <aside class="widget widget_text">
                                        <div class="footer-logo">
                                            <img src="assets/images/site-logo1.png"
                                                    alt="">
                                        </div>
                                        <div class="textwidget widget-text">
                                            Vitae, cupiditate repudiandae, erat beatae voluptate vulputate quis tempora
                                            deserunt,
                                            nobis, montes. Illo eleifend, nihil lorem venenat.
                                        </div>
                                    </aside>
                                </div>
                            </div>
                            {{-- Component de email --}}
                            <email-component></email-component>
                            
                        </div>

                    </div>
                </div>
            </div>
            <div class="bottom-footer">
                <div class="container">
                    <div class="copy-right text-center">Copyright &copy; 2024 Nature Carbon Coin. All rights reserved.
                    </div>
                </div>
            </div>
        </footer>
        <a id="backTotop" href="#" class="to-top-icon">
            <i class="fas fa-chevron-up"></i>
        </a>
        <!-- custom search field html -->

        <!-- header html end -->
    </div>

    </div>

    <script src="assets/vendors/jquery/jquery.js"></script>
    <script src="assets/vendors/waypoint/jquery.waypoints.min.js"></script>
    <script src="assets/vendors/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/vendors/progressbar-fill-visible/js/progressBar.min.js"></script>
    <script src="assets/vendors/jquery-ui/jquery-ui.min.js"></script>
    <script src="assets/vendors/countdown-date-loop-counter/loopcounter.js"></script>
    <script src="assets/vendors/counterup/jquery.counterup.js"></script>
    <script src="assets/vendors/modal-video/jquery-modal-video.min.js"></script>
    <script src="assets/vendors/masonry/masonry.pkgd.min.js"></script>
    <script src="assets/vendors/fancybox/dist/jquery.fancybox.min.js"></script>

    <script src="assets/vendors/slick/slick.min.js"></script>
    <script src="assets/vendors/slick-nav/jquery.slicknav.js"></script>

    <script src="assets/js/contato.js"></script>
</body>

</html>
