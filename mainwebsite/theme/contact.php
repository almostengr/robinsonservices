<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/../phpenv.rs.php");
?>
{% extends "base.html" %}
{% block content %}
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
    } else if ($appearSpam == false)
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
{% endblock %}