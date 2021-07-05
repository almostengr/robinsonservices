<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/../phpenv.rs.php");
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <meta property="og:locale" content="en_US" />
  <meta property="og:site_name" content="Robinson Handy and Technology Services LLC" />
  <meta name="twitter:card" content="summary" />
  
  <meta name="description" content="Providing handyman and technology services for Montgomery, Prattville, Wetumpka, Millbrook and surrounding areas.">
  <meta property="og:description" content="Providing handyman and technology services for Montgomery, Prattville, Wetumpka, Millbrook and surrounding areas." />
  <meta name="twitter:description" content="Providing handyman and technology services for Montgomery, Prattville, Wetumpka, Millbrook and surrounding areas." />
  
  
  <meta name="author" content="Robinson Handy and Technology Services">
  
  
  <title>Robinson Handy and Technology Services LLC | Providing handyman and technology services for Montgomery, Prattville, Wetumpka, Millbrook and surrounding areas.</title>
  <meta property="og:title" content="Robinson Handy and Technology Services LLC | Providing handyman and technology services for Montgomery, Prattville, Wetumpka, Millbrook and surrounding areas." />
  <meta name="twitter:title" content="Robinson Handy and Technology Services LLC | Providing handyman and technology services for Montgomery, Prattville, Wetumpka, Millbrook and surrounding areas." />
  
  

  
  
  <meta property="og:type" content="website" />
  
  
  <meta name="robots" content="index, follow" />
  
  
  
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  <link href="/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.min.css">
  
  <link rel="shortcut icon" href="/images/logo.ico">
  
  <link href="/css/style.min.css" rel="stylesheet">
</head>

<body class="bg-black">
  <!-- Load Facebook SDK for JavaScript -->
  <div id="fb-root"></div>
  <script defer async>
    window.fbAsyncInit = function () {
      FB.init({
        xfbml: true,
        version: 'v10.0'
      });
    };
    (function (d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
  </script>
  <div class="fb-customerchat" attribution="setup_tool" page_id="105211041648889" theme_color="#ffc107">
  </div>
  <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <a class="navbar-brand" href="/">
      
      <img src="/images/logo.ico" alt="RHT Services logo">
      
      RHT Services LLC
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
      aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul class="navbar-nav mr-auto">
        
        
        <li class="nav-item">
          <a class="nav-link text-white" href="/services">Services</a>
        </li>
        
        
        
        <li class="nav-item">
          <a class="nav-link text-white" href="/about">About</a>
        </li>
        
        
        
        <li class="nav-item">
          <a class="nav-link text-white" href="/contact.php">Contact</a>
        </li>
        
        
        
        
      </ul>
      
      
      
      
      
      
      
      
      <a href="https://rhtservices.square.site/">
        <button class="btn btn-warning my-2 my-sm-0 rounded">Schedule Service</button>
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
            <input class="form-control" id="customerfirst" name="customerfirst" type="text" placeholder="First Name" minlength="3" required="required">
        </p>
        <p>
            <label for="customerlast" class="required">Last Name</label>
            <input class="form-control" id="customerlast" name="customerlast" type="text" placeholder="Last Name" minlength="3" required="required">
        </p>
        <p>
            <label for="emailaddress" class="required">Email Address</label>
            <input class="form-control" id="emailaddress" name="emailaddress" type="email" placeholder="Email Address" minlength="10" required="required">
        </p>
        <p>
            <label for="phonenumber" class="required">Phone Number</label>
            <input class="form-control" id="phonenumber" type="tel" minlength="10" name="phonenumber" maxlength="12" required="required" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}">
            <div class="text-small font-italic">Enter number in 555-555-5555 format.</div>
        </p>
        <p>
            <label for="textmessage" class="required">Does this number receive text messages?</label>
            <select name="textmessage" id="textmessage" class="form-control">
                <option>-Select-</option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
            </select>
        </p>
        <p>
            <label for="jobdescription" class="required">Job Description</label>
            <textarea class="form-control" rows="4" id="jobdescription" placeholder="How can we help you?" name="jobdescription" minlength="100"></textarea>
            <div class="text-small font-italic">Minimum 100 characters. The more details, the better</div>
        </p>
        <p>
            <label class="required">Are You Human?</label>
            <div class="g-recaptcha" data-sitekey="6LfYSYIaAAAAAMYtAq6ND9mMb0CyaTiMld1CtZW4"></div>
        </p>
        <p>
            <button type="submit" class="form-control btn btn-dark-gray">Submit</button>
        </p>
    </form>
<?php
}
?>

    </div>
    
  </main>
  
  <section class="bg-dark text-white subfooter">
    <div class="container text-left py-3">
      <div class="row">
        <div class="col-sm-12 col-md-3">
          <h4 class="px-2 subfooterheader text-warning">Sign Up for Deals!</h4>
          <form method="post" action="https://rhtservices.net/rhtnewsletter/?p=subscribe&id=1" name="subscribeform"
    id="subscribeform" enctype="multipart/form-data">
    <input type="hidden" name="list[2]" value="signup" />
    <input type="hidden" name="listname[2]" value="newsletter" />
    <input type="hidden" name="htmlemail" value="1" />
    <input type="hidden" name="subscribe" value="subscribe" />
    <div class="my-2">
        Sign up to receive deals in your inbox! We won't send you more than 1-2 emails per month.
    </div>
    <div class="my-2">
        <label class="required font-weight-bold" for="email">Email Address</label><br />
        <input type="text" name="email" required="required" class="form-control" id="email" />
        <script language="Javascript" type="text/javascript">addFieldToCheck("email", "Email");</script>
    </div>
    <div style="display:none">
        <input type="text" name="VerificationCodeX" value="">
    </div>
    <div class="my-2">
        <button class='button form-control btn btn-warning'
            onclick="if (checkNewsletterform()) {submitNewsletterForm();} return false;">Subscribe!</button>
    </div>
    <div id="result" style="color: red;"></div>
</form>
        </div>
        
        <div class="col-sm-12 col-md-3">
          <h4 class="px-2 subfooterheader text-warning">About RHT Services</h4>
          <ul class="list-unstyled mx-3">
            
            <li>
              
              <i class="bi bi-telephone"></i>
              
              
              <a href="tel:(334) 595-9690" class="text-white">
                (334) 595-9690</a>
              
            </li>
            
            <li>
              
              <i class="bi bi-globe"></i>
              
              
              <a href="https://rhtservices.net" class="text-white">
                rhtservices.net</a>
              
            </li>
            
            <li>
              
              <i class="bi bi-facebook"></i>
              
              
              <a href="https://facebook.com/rhtservicesllc" class="text-white">
                RHT Services on Facebook</a>
              
            </li>
            
            <li>
              
              <i class="bi bi-kanban"></i>
              
              
              <a href="/services" class="text-white">
                Services Offered</a>
              
            </li>
            
            <li>
              
              <i class="bi bi-cash"></i>
              
              
              <a href="/payment" class="text-white">
                Make A Payment</a>
              
            </li>
            
            <li>
              
              <i class="bi bi-calendar-check"></i>
              
              
              <a href="https://rhtservices.square.site/" class="text-white">
                Book Appointment / Service</a>
              
            </li>
            
            <li>
              
              <i class="bi bi-person-check"></i>
              
              
              <a href="/about#customer-reviews" class="text-white">
                Customer Reviews</a>
              
            </li>
            
            <li>
              
              <i class="bi bi-patch-question"></i>
              
              
              <a href="/faq" class="text-white">
                Frequently Asked Questions (FAQ)</a>
              
            </li>
            
            <li>
              
              <i class="bi bi-tools"></i>
              
              
              <a href="/uses" class="text-white">
                Uses (Recommended Tools)</a>
              
            </li>
            
            <li>
              
              <i class="bi bi-key"></i>
              
              
              <a href="/privacy" class="text-white">
                Privacy Policy</a>
              
            </li>
            
            <li>
              
              <i class="bi bi-diagram-3"></i>
              
              
              <a href="/sitemap.xml" class="text-white">
                Sitemap</a>
              
            </li>
            
          </ul>
        </div>
        
        <div class="col-sm-12 col-md-3">
          <h4 class="px-2 subfooterheader text-warning">Service Areas</h4>
          <ul class="list-unstyled mx-3">
            
            <li>
              
              <i class="bi bi-geo-alt-fill"></i>
              
              
              Autaugaville
              
            </li>
            
            <li>
              
              <i class="bi bi-geo-alt-fill"></i>
              
              
              Cecil
              
            </li>
            
            <li>
              
              <i class="bi bi-geo-alt-fill"></i>
              
              
              Coosada
              
            </li>
            
            <li>
              
              <i class="bi bi-geo-alt-fill"></i>
              
              
              Deatsville
              
            </li>
            
            <li>
              
              <i class="bi bi-geo-alt-fill"></i>
              
              
              Elmore
              
            </li>
            
            <li>
              
              <i class="bi bi-geo-alt-fill"></i>
              
              
              Hope Hull
              
            </li>
            
            <li>
              
              <i class="bi bi-geo-alt-fill"></i>
              
              
              Millbrook
              
            </li>
            
            <li>
              
              <i class="bi bi-geo-alt-fill"></i>
              
              
              Montgomery
              
            </li>
            
            <li>
              
              <i class="bi bi-geo-alt-fill"></i>
              
              
              Mount Meigs
              
            </li>
            
            <li>
              
              <i class="bi bi-geo-alt-fill"></i>
              
              
              Pike Road
              
            </li>
            
            <li>
              
              <i class="bi bi-geo-alt-fill"></i>
              
              
              Pine Level<br />(Autauga and Montgomery Counties)
              
            </li>
            
            <li>
              
              <i class="bi bi-geo-alt-fill"></i>
              
              
              Prattville
              
            </li>
            
            <li>
              
              <i class="bi bi-geo-alt-fill"></i>
              
              
              Rolling Hills
              
            </li>
            
            <li>
              
              <i class="bi bi-geo-alt-fill"></i>
              
              
              Tallassee
              
            </li>
            
            <li>
              
              <i class="bi bi-geo-alt-fill"></i>
              
              
              Waugh
              
            </li>
            
            <li>
              
              <i class="bi bi-geo-alt-fill"></i>
              
              
              Wetumpka
              
            </li>
            
            <li>
              
              <i class="bi bi-geo-alt-fill"></i>
              
              
              Autauga County, Alabama
              
            </li>
            
            <li>
              
              <i class="bi bi-geo-alt-fill"></i>
              
              
              Elmore County, Alabama
              
            </li>
            
            <li>
              
              <i class="bi bi-geo-alt-fill"></i>
              
              
              Montgomery County, Alabama
              
            </li>
            
          </ul>
        </div>
        
        <div class="col-sm-12 col-md-3">
          <h4 class="px-2 subfooterheader text-warning">Popular Services</h4>
          <ul class="list-unstyled mx-3">
            
            <li>
              
              <i class="bi bi-hammer"></i>
              
              
              <a href="/services/ceilingfan" class="text-white">
                Ceiling Fan Installation</a>
              
            </li>
            
            <li>
              
              <i class="bi bi-hammer"></i>
              
              
              <a href="/services/furniture" class="text-white">
                Furniture Assembly</a>
              
            </li>
            
            <li>
              
              <i class="bi bi-hammer"></i>
              
              
              <a href="/services/homenetwork" class="text-white">
                Home Networking Solutions</a>
              
            </li>
            
            <li>
              
              <i class="bi bi-hammer"></i>
              
              
              <a href="/services/lightfixture" class="text-white">
                Lighting Fixture Installation</a>
              
            </li>
            
            <li>
              
              <i class="bi bi-hammer"></i>
              
              
              <a href="/services/linuxtraining" class="text-white">
                Linux Training</a>
              
            </li>
            
            <li>
              
              <i class="bi bi-hammer"></i>
              
              
              <a href="/services/picturehanging" class="text-white">
                Picture Hanging</a>
              
            </li>
            
            <li>
              
              <i class="bi bi-hammer"></i>
              
              
              <a href="/services/tvstand" class="text-white">
                TV Stand Assembly</a>
              
            </li>
            
            <li>
              
              <i class="bi bi-hammer"></i>
              
              
              <a href="/services/tvmounting" class="text-white">
                TV Wall Mounting</a>
              
            </li>
            
            <li>
              
              <i class="bi bi-list-task"></i>
              
              
              <a href="/services" class="text-white">
                All Services</a>
              
            </li>
            
          </ul>
        </div>
        
      </div>
    </div>
  </section>
  
  
  <footer class="bg-black text-warning">
    <div class="container text-center py-3">
      <div class="col-sm-12">
        &copy; Copyright 2021 Robinson Handy and Technology (RHT) Services LLC
        
      </div>
      <div class="col-sm-12">
        Website developed by <a href="https://rhtservices.net" target='_blank'>Robinson Handy and Technology Services
          LLC</a>
      </div>
      <!-- Last updated: 2021-07-05 15:55:51.823380+00:00 -->
    </div>
  </footer>
  
  <script src="//code.jquery.com/jquery-3.5.1.slim.min.js" async crossorigin="anonymous"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"></script>
  <script async src="/js/bootstrap.bundle.min.js"></script>
  <script async src="/js/javascript.min.js"></script>
  <script async src="/js/bootstrap.min.js"></script>
</body>

</html>