
<!doctype html>
<html lang="en">

    <head>
        
        <meta charset="utf-8" />
        <title>BUK | @yield('title')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- App favicon -->
        <link rel="shortcut icon" href="/assets/images/favicon.ico">

        <!-- Bootstrap Css -->
        <link href="/assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="/assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

    </head>

    <body class="bg-white">

        <div class="auth-page d-flex align-items-center min-vh-100">
            <div class="container-fluid p-0">
                <div class="row g-0">
                    <div class="col-xxl-3 col-lg-4 col-md-5">
                            <div class="d-flex flex-column h-100 py-5 px-4">
                                <div class="text-center text-muted mb-2">
                                    <div class="pb-3">
                                        <a href="/">
                                            <span class="logo-lg">
                                                <img src="/assets/images/logo.png" alt="" height="24"> <span class="logo-txt">BUK</span>
                                            </span>
                                        </a>
                                        <p class="text-muted font-size-15 w-75 mx-auto mt-3 mb-0">Student Project Supervisor Allocation System.</p>
                                    </div>
                                </div>
        
                                <div class="my-auto">
                                    <div class="p-3 text-center">
                                        <img src="/assets/images/auth-img.png" alt="" class="img-fluid">
                                    </div>
                                </div>
        
                                <div class="mt-4 mt-md-5 text-center">
                                        <p class="mb-0">© <script>document.write(new Date().getFullYear())</script> BUK. All rights reserved</p>
                                </div>
                            </div>
                        
                        <!-- end auth full page content -->
                    </div>
                    <!-- end col -->
    
                    <div class="col-xxl-9 col-lg-8 col-md-7">
                        <div class="auth-bg bg-light py-md-5 p-4 d-flex">
                            <div class="bg-overlay-gradient"></div>
                            <!-- end bubble effect -->
                            <div class="row justify-content-center g-0 align-items-center w-100">
                                <div class="{{ request()->routeIs('student.register') || request()->routeIs('staff.register') ? 'col-xl-6': 'col-xl-4' }} col-lg-8">
                                    <div class="card">
                                        <div class="card-body">
                                            @yield('content')
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container fluid -->
        </div>
        <!-- end authentication section -->

        <!-- JAVASCRIPT -->
        <script src="/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="/assets/libs/metismenujs/metismenujs.min.js"></script>
        <script src="/assets/libs/simplebar/simplebar.min.js"></script>
        <script src="/assets/libs/feather-icons/feather.min.js"></script>

        <script src="/assets/js/pages/pass-addon.init.js"></script>

    </body>
</html>
