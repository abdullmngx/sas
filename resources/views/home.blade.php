
<!doctype html>
<html lang="en">

    <head>
        
        <meta charset="utf-8" />
        <title>BUK | Home</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- App favicon -->
        <link rel="shortcut icon" href="/assets/images/logo.png">

        <!-- Bootstrap Css -->
        <link href="/assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="/assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

    </head>

    <body>
        <div class="auth-bg-basic d-flex align-items-center min-vh-100" style="background: url('/bg.jpg'); background-size: cover; background-repeat:no-repeat">
            <div class="bg-overlay bg-light"></div>
            <div class="container">
                <div class="d-flex flex-column min-vh-100 py-5 px-3">
                    <div class="row justify-content-center my-auto">
                        <div class="col-xl-12">
                            <div class="text-center">
                                <a href="index.html">
                                    <span class="logo-lg">
                                        <img src="/assets/images/logo.png" alt="" height="24"> <span class="logo-txt"></span>
                                    </span>
                                </a>

                                <div class="row mt-5 pt-3 justify-content-center">
                                   <div class="col-md-6">
                                      <h1>Bayero University, Kano</h1>
                                   </div>
                                </div>

                                <h2 class="mt-5 pt-4">Faculty of Computing</h2>
                                <h3>Department of Software Engineering</h3>

                                <div class="row mt-4">
                                    <div class="col-md-12">
                                        <div class="text-center">
                                            <a href="{{ route('student.login') }}" class="btn btn-primary">Student Login</a>
                                            <a href="{{ route('staff.login') }}" class="btn btn-success">Staff Login</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- end row -->
                </div>
            </div>
            <!-- end container fluid -->
        </div>
        <!-- end authentication section -->

        <!-- JAVASCRIPT -->
        <script src="/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="/assets/libs/metismenujs/metismenujs.min.js"></script>
        <script src="/assets/libs/simplebar/simplebar.min.js"></script>
        <script src="/assets/libs/feather-icons/feather.min.js"></script>

        <script src="/assets/js/app.js"></script>

    </body>
</html>
