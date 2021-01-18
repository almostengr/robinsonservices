<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta property="og:locale" content="en_US" />
    <meta property="og:site_name" content="Robinson Handy and Tech Services LLC" />
    <meta name="twitter:card" content="summary" />
    <meta name="description" content="Providing handyman and technology services for the Montgomery, Alabama area.">
    <meta property="og:description" content="Providing handyman and technology services for the Montgomery, Alabama area." />
    <meta name="twitter:description" content="Providing handyman and technology services for the Montgomery, Alabama area." />
    <meta name="author" content="Robinson Handy and Technology Services LLC">
    <title>Request Services / Contact Us | Robinson Handy and Tech Services LLC</title>
    <meta property="og:title" content="Request Services / Contact Us" />
    <meta name="twitter:title" content="Request Services / Contact Us" />
    <meta property="og:type" content="website" />
    <meta name="robots" content="index, follow" />
    <link rel="canonical" href="https://rhtservices.net/contact/">
    <meta property="og:url" content="https://rhtservices.net/contact/" />
    <meta property="twitter:url" content="https://rhtservices.net/contact/" />
    <link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="/css/style.min.css" rel="stylesheet">
</head>

<body class="bg-black">
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a class="navbar-brand" href="/">RHT Services LLC</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link text-white" href="/about">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="/services">Services</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="/contact">Contact</a>
                </li>
            </ul>
            <form class="form-inline mt-2 mt-md-0 mr-1" action="/contact" method="GET">
                <button class="btn btn-warning my-2 my-sm-0" type="submit">Request Service</button>
            </form>
        </div>
    </nav>
    <main role="main" class="bg-light">
        <div class="container pt-3">
            <h1 class="pt-3">Request Services / Contact Us</h1>
        </div>
        <?php
        $env_vars = "../../phpenv.rs.php";
        require_once($env_vars);
        if (isset($_POST['emailaddress'])) {
            date_default_timezone_set('America/Chicago');
            // unset($_POST['captcha']);
            $new_line = "\r\n";
            $current_time = date("Y-m-d H:i:s");
            $message = print_r($_POST, true);
            $message .= "Submitted " . $current_time . $new_line;
            $message .= "IP Address " . $_SERVER['REMOTE_ADDR'];
            $subject = $_POST['servicetype'] . " " . $current_time;
            $headers = array('From' => $_POST['emailaddress']);
            $mail_result = mail($HELPDESK_EMAIL, $subject, $message, $headers);
            if ($mail_result) {
        ?>
                <div class="bg-success text-light container py-2 my-5" id="successmessage">
                    Your request has been submitted successfully!
                </div>
            <?php
            } else {
                // echo "Unexpected error occurred";
            ?>
                <div class="bg-danger text-light container py-2 my-5" id="failuremessage">
                    An error occurred when attempting to process your request.
                </div>
        <?php
            }
        } else {
            header('Location: https://rhtservices.net/contact');
        }
        ?>
    </main>
    <section class="bg-dark text-white subfooter">
        <div class="container text-center py-3">
            <div class="row">
                <div class="col-sm-12 col-md-4">
                    <h4 class="subfooterheader text-warning">About RHTS</h4>
                    <p>
                        <i class="fas fa-phone"></i>
                        <a href="tel:(334) 595-9690" class="text-white">
                            (334) 595-9690</a>
                    </p>
                    <p>
                        <i class="fas fa-globe-africa"></i>
                        <a href="https://rhtservices.net" class="text-white">
                            rhtservices.net</a>
                    </p>
                    <p>
                        <i class="fas fa-clock"></i>
                        Sun-Fri Hours: By Appointment
                    </p>
                    <p>
                        <i class="fas fa-clock"></i>
                        Sat Hours: 8AM-7PM
                    </p>
                </div>
                <div class="col-sm-12 col-md-4">
                    <h4 class="subfooterheader text-warning">Service Areas</h4>
                    <p>
                        Montgomery, Alabama
                    </p>
                    <p>
                        Pike Road, Alabama
                    </p>
                    <p>
                        Autauga County, Alabama
                    </p>
                    <p>
                        Elmore County, Alabama
                    </p>
                    <p>
                        Montgomery County, Alabama
                    </p>
                </div>
                <div class="col-sm-12 col-md-4">
                    <h4 class="subfooterheader text-warning">Other Links</h4>
                    <p>
                        <i class="far fa-money-bill-alt"></i>
                        <a href="/payment" class="text-white">
                            Make A Payment</a>
                    </p>
                    <p>
                        <i class="fas fa-tasks"></i>
                        <a href="/projects" class="text-white">
                            Projects</a>
                    </p>
                    <p>
                        <i class="fas fa-tools"></i>
                        <a href="/uses" class="text-white">
                            Uses</a>
                    </p>
                    <p>
                        <i class="fas fa-question"></i>
                        <a href="/faq" class="text-white">
                            Frequently Asked Questions (FAQ)</a>
                    </p>
                    <p>
                        <i class="fas fa-user-secret"></i>
                        <a href="/privacy" class="text-white">
                            Privacy Policy</a>
                    </p>
                    <p>
                        <i class="fas fa-sitemap"></i>
                        <a href="/sitemap.xml" class="text-white">
                            Sitemap</a>
                    </p>
                </div>
            </div>
        </div>
    </section>
    <footer class="bg-black text-warning">
        <div class="container text-center py-3">
            <div class="col-sm-12">
                &copy; Copyright 2021 Robinson Handy and Technology (RHT) Services LLC
                <br />
                Website developed by <a href="https://rhtservices.net" target='_blank'>Robinson Handy and Technology Services LLC</a>
            </div>
            <div class="col-sm-12 pt-2">
                Cookies are used on this website to track your visits, provide advertisements specific to you, and preferences
                by a third-party. By continuing to use this site, you agree to the use of cookies unless you have disabled them.
                More information this is available in the Privacy Policy.
            </div>
            <!-- Last updated: 2021-01-18 15:24:44.916689+00:00 -->
        </div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" async integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <!-- <script>window.jQuery || document.write('<script src="../assets/js/vendor/jquery.slim.min.js"><\/script>')</script> -->
    <script async src="/js/bootstrap.bundle.min.js"></script>
    <script async src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script async src="/js/javascript.min.js"></script>
</body>

</html>