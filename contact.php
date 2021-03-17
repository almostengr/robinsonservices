<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/../phpenv.rs.php");
?>
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
  

  
  <title>Robinson Handy and Tech Services LLC</title>
  <meta property="og:title" content="Robinson Handy and Tech Services LLC" />
  <meta name="twitter:title" content="Robinson Handy and Tech Services LLC" />
  

  

  

  
  <meta property="og:type" content="website" />
  

  
  <meta name="robots" content="index, follow" />
  

  

  

  

  <link href="/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.min.css">

  

  <!-- Custom styles for this template -->
  <link href="/css/style.min.css" rel="stylesheet">
</head>

<body class="bg-black">
  <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <a class="navbar-brand" href="/">
      
      <img src="/images/logo.ico">
      
      RHT Services LLC
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
      aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
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
          <a class="nav-link text-white" href="/contact.php">Contact</a>
        </li>
        
        
        
        
      </ul>
      
      
      
      
      
      
      
      
      <a href="/request">
        <button class="btn btn-warning my-2 my-sm-0">Request Services</button>
      </a>
      
      
    </div>
  </nav>

  <main role="main" class="bg-light">

    

    

    <div class="bg-success text-light container py-2 d-none" id="successmessage">
      Your request has been submitted successfully!
    </div>

    <div class="bg-danger text-light container py-2 d-none" id="failuremessage">
      An error occurred when attempting to process your request.
    </div>

    <div class="container py-2" id="pagebody">
<h1 id="request-services-contact">Contact Us</h1>
<?php

function doesAppearToBeSpam($firstName, $lastName, $jobDescription, $email, $phoneNumber)
{
    $jobDescription = trim(strtolower($jobDescription));
    $email = trim(strtolower($email));
    $firstName = trim(strtolower($firstName));
    $lastName = trim(strtolower($lastName));
    $phoneNumber = trim($phoneNumber);

    // validate first and last name aren't the same
    if ($firstName == $lastName) {
        return true;
    }

    // check the description for spam phrases
    $descriptionKeyphrases = array(
        "http", "https", "www.", ".com", ".net", ".org",
        "robinson handy and tech", "rht services"
    );
    foreach ($descriptionKeyphrases as $phrase) {
        if (str_contains($jobDescription, $phrase)) {
            return true;
        }
    }

    // TODO check phone number for spam submissions
    $phonePhrases = array("111", "211", "311", "411", "511", "611", "711", "811", "911", "555", "000");
    $phoneNumber = filter_var($phoneNumber, FILTER_SANITIZE_NUMBER_INT);
    $phoneNumber = str_replace([' ', '.', '-', '(', ')'], '', $phoneNumber);

    foreach ($phonePhrases as $phone) {
        if (
            str_contains(substr($phoneNumber, 0, 3), $phone) ||
            str_contains(substr($phoneNumber, 3, 3), $phone)
        ) {
            return true;
        }
    }

    // TODO check email for spam submissions
    $emailPhrases = array("rhtservices.net", "example.com");
    foreach ($emailPhrases as $phrase) {
        if (str_contains($email, $phrase)) {
            return true;
        }
    }

    return false;
}

if (isset($_POST['emailaddress']) && isset($HELPDESK_EMAIL)) {
    date_default_timezone_set('America/Chicago');
    // unset($_POST['captcha']);
    $new_line = "\r\n";
    $current_time = date("Y-m-d H:i:s");
    $message = print_r($_POST, true);
    $message .= "Submitted " . $current_time . $new_line;
    $message .= "IP Address " . $_SERVER['REMOTE_ADDR'];
    $subject = "Request " . $current_time;
    $headers = array('From' => $_POST['emailaddress']);

    $appearSpam = doesAppearToBeSpam(
        $_POST['customerfirst'],
        $_POST['customerlast'],
        $_POST['jobdescription'],
        $_POST['emailaddress'],
        $_POST['phonenumber']
    );

    if ($appearSpam) {
        $subject = "[SPAM] " . $subject;
        $mail_result == false;
    }

    if ($_POST['emailaddress'] == "tester@thealmostengineer.com") {
        $mail_result = true;
    } else if ($appearSpam == false) {
        $mail_result = mail($HELPDESK_EMAIL, $subject, $message, $headers);
    }

    // display messages to user

    if ($appearSpam) {
?>
        <div class="bg-danger text-light container py-2 my-5" id="failuremessage">
            Invalid submission. It appears that your submission is spam and was not submitted.
        </div>
    <?php
    }

    if ($mail_result) {
    ?>
        <div class="bg-success text-light container py-2 my-5" id="successmessage">
            Your request has been submitted successfully!
        </div>
    <?php
    } else {
    ?>
        <div class="bg-danger text-light container py-2 my-5" id="failuremessage">
            An error occurred when attempting to process your request.
        </div>
    <?php
    }
} else {
    ?>
    <p>
        If you are interested in setting up service for your home or business or would just like to talk with our
        staff, please call or fill out the form below. Be sure and give a detailed description of your project and or
        ask any questions you may have in the message box. You will be contacted within 2 business days.
    </p>
    <h2>Phone</h2>
    <p>Call <a href="tel:3345959690">334-595-9690</a></p>
    <h2>Email</h2>
    <p>Please allow up to 2 business days to get back to you.</p>
    <form method="POST" action="/contact.php" id="contactForm">
        <p>
            <label for="customerfirst" class="required">First Name</label>
            <input class="form-control" name="customerfirst" type="text" placeholder="First Name" minlength="3" required="required">
        </p>
        <p>
            <label for="customerlast" class="required">Last Name</label>
            <input class="form-control" name="customerlast" type="text" placeholder="Last Name" minlength="3" required="required">
        </p>
        <p>
            <label for="emailaddress" class="required">Email Address</label>
            <input class="form-control" name="emailaddress" type="email" placeholder="Email Address" minlength="10" required="required">
        </p>
        <p>
            <label for="phonenumber" class="required">Phone Number</label>
            <input class="form-control" type="tel" placeholder="Phone Number" minlength="10" name="phonenumber" maxlength="12" required="required" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}">
            <div class="text-small text-muted font-italic">Enter number in 555-555-5555 format.</div>
        </p>
        <p>
            <label for="textmessage" class="required">Does this number receive text messages?</label>
            <select name="textmessage" class="form-control">
                <option>-Select-</option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
            </select>
        </p>
        <p>
            <label for="jobdescription" class="required">Job Description</label>
            <textarea class="form-control" rows="4" id="jobdescription" placeholder="How can we help you?" name="jobdescription" minlength="100"></textarea>
            <div class="text-small text-muted font-italic">Minimum 100 characters. The more details, the better</div>
        </p>
        <p>
            <label class="required">Are You Human?</label>
            <div class="g-recaptcha" data-sitekey="6LfYSYIaAAAAAMYtAq6ND9mMb0CyaTiMld1CtZW4"></div>
        </p>
        <p>
            <input type="submit" class="form-control btn btn-dark-gray" value="Submit">
        </p>
    </form>
<?php
}
?>

    </div>

    
  </main>

  
  <section class="bg-warning text-dark py-4 promotions">
    <div class="container">
      <div class="row">
        <div class="col-sm-12 col-md-6 pb-2 text-center">
          <h4>Save 5% on your first service!</h4>
          <p>Mention that you saw this message on our website and you will get 5% off your first service!</p>
        </div>
        <div class="col-sm-12 col-md-6 pb-2 text-center">
          <form method="GET" action="/request">
            <input type="submit" class="btn btn-lg btn-dark-gray" value="Request Services">
          </form>
        </div>
      </div>
    </div>
  </section>
  

  
  <section class="bg-dark text-white subfooter">
    <div class="container text-center py-3">
      <div class="row">
        
        <div class="col-sm-12 col-md-4">
          <h4 class="subfooterheader text-warning">About RHTS</h4>
          
          <p>
            
            <i class="bi bi-telephone"></i>
            
            
            <a href="tel:(334) 595-9690" class="text-white">
              (334) 595-9690</a>
            
          </p>
          
          <p>
            
            <i class="bi bi-globe"></i>
            
            
            <a href="https://rhtservices.net" class="text-white">
              rhtservices.net</a>
            
          </p>
          
          <p>
            
            <i class="bi bi-facebook"></i>
            
            
            <a href="https://facebook.com/rhtservicesllc" class="text-white">
              RHT Services on Facebook</a>
            
          </p>
          
          <p>
            
            <i class="bi bi-clock-fill"></i>
            
            
            Sun-Fri Hours: By Appointment
            
          </p>
          
          <p>
            
            <i class="bi bi-clock-fill"></i>
            
            
            Sat Hours: 8 AM (0800) - 8 PM (2000)
            
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
            
            <i class="bi bi-cash"></i>
            
            
            <a href="/payment" class="text-white">
              Make A Payment</a>
            
          </p>
          
          <p>
            
            <i class="bi bi-kanban"></i>
            
            
            <a href="/projects" class="text-white">
              Projects</a>
            
          </p>
          
          <p>
            
            <i class="bi bi-tools"></i>
            
            
            <a href="/uses" class="text-white">
              Uses</a>
            
          </p>
          
          <p>
            
            <i class="bi bi-patch-question"></i>
            
            
            <a href="/faq" class="text-white">
              Frequently Asked Questions (FAQ)</a>
            
          </p>
          
          <p>
            
            <i class="bi bi-key"></i>
            
            
            <a href="/privacy" class="text-white">
              Privacy Policy</a>
            
          </p>
          
          <p>
            
            <i class="bi bi-diagram-3"></i>
            
            
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
        Website developed by <a href="https://rhtservices.net" target='_blank'>Robinson Handy and Technology Services
          LLC</a>
      </div>
      <div class="col-sm-12 pt-2">
        Cookies are used on this website to track your visits, provide advertisements specific to you, and preferences
        by a third-party. By continuing to use this site, you agree to the use of cookies unless you have disabled them.
        More information this is available in the Privacy Policy.
      </div>
      <!-- Last updated: 2021-03-17 01:50:59.154660+00:00 -->
    </div>
  </footer>
  

  <script src="//code.jquery.com/jquery-3.5.1.slim.min.js" async
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
    crossorigin="anonymous"></script>
  <!-- <script>window.jQuery || document.write('<script src="../assets/js/vendor/jquery.slim.min.js"><\/script>')</script> -->
  <script async src="/js/bootstrap.bundle.min.js"></script>
  <script async src="/js/javascript.min.js"></script>
  <script async src="/js/bootstrap.min.js"></script>
</body>

</html>