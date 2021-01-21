<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/../phpenv.rs.php");
?>
{% extends "base.html" %}

{% block content %}

<h1 id="request-services-contact">Request Services / Contact Us</h1>

<?php
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

    // if ($_POST['emailaddress'] == "tester@rhtservices.net") {
    if (false) {
        $mail_result = true;
    } else {
        $mail_result = mail($HELPDESK_EMAIL, $subject, $message, $headers);
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

    <p>
        Call <a href="tel:3345959690">334-595-9690</a>
    </p>

    <h2>Email</h2>

    <p>
        Please allow up to 48 business hours to get back to you.
    </p>

    <form method="POST" action="/contact.php">
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
            <input type="submit" class="form-control btn btn-dark-gray" value="Submit">
        </p>
    </form>

<?php
}
?>
{% endblock %}