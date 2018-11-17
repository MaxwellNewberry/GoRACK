<?php

/* If there is no form POST then kill the page. (security) */
if(!isset($_POST)) { die('You must be lost.'); }

// Verify captcha
$post_data = http_build_query(
    array(
        'secret' => '6LevSXkUAAAAAJLf3bzd326Gfb3Z_Svrgz27URmn',
        'response' => $_POST['g-recaptcha-response'],
        'remoteip' => $_SERVER['REMOTE_ADDR']
    )
);
$opts = array('http' =>
    array(
        'method'  => 'POST',
        'header'  => 'Content-type: application/x-www-form-urlencoded',
        'content' => $post_data
    )
);
$context  = stream_context_create($opts);
$response = file_get_contents('https://www.google.com/recaptcha/api/siteverify', false, $context);
$result = json_decode($response);
if (!$result->success) {
  die('Captcha failed.');
}

function clean_string($string) {
  $bad = array("content-type","bcc:","to:","cc:","href");
  return str_replace($bad,"",$string);
}

$email_to = "pintsizenetwork@gmail.com";
$email_subject = "You received a new form submission (";

if(isset($_POST['type']))
{
  if($_POST['type'] == "contact_us")
  {
    // contact.html
    $first_name = stripslashes($_POST['first_name']);
    $last_name = stripslashes($_POST['last_name']);
    $email = stripslashes($_POST['email']);
    $website = stripslashes($_POST['website']);
    $dept = stripslashes($_POST['custom']);
    $message = stripslashes($_POST['message']);

    // We need to set the department name, html returns as numeric values
    switch($dept) {
      case 1:
        $dept = "Colocation Sales";
        break;
      case 2:
        $dept = "Cloud Sales";
        break;
      case 3:
        $dept = "VPS Sales";
        break;
    }

    $email_message = "Form details below.\n\n";
    $email_message .= "First Name: ".clean_string($first_name)."\n";
    $email_message .= "Last Name: ".clean_string($last_name)."\n";
    $email_message .= "E-mail: ".clean_string($email)."\n";
    $email_message .= "Website ".clean_string($website)."\n";
    $email_message .= "Department: ".clean_string($dept)."\n";
    $email_message .= "Message: ".clean_string($message)."\n";

    $email_subject .= "Contact Us)"; // Finish Subject line

    // Headers for e-mail
    $headers = 'From: '.$email."\r\n".
    'Reply-To: '.$email."\r\n" .
    'X-Mailer: PHP/' . phpversion();
    @mail($email_to, $email_subject, $email_message, $headers);
    header('Location: contact.html?message=success');
  }

  if($_POST['type'] == "tour")
  {
    // tour.html
    $first_name = stripslashes($_POST['first_name']);
    $last_name = stripslashes($_POST['last_name']);
    $email = stripslashes($_POST['email']);
    $phone = stripslashes($_POST['phone']);
    $company = stripslashes($_POST['company']);
    $facility = stripslashes($_POST['facility']);
    $time = $_POST['time'];
    $date = $_POST['date'];
    $message = stripslashes($_POST['message']);

    // Set value of facility
    switch($facility) {
      case 1:
        $facility = "421 W. Church St.";
        break;
      case 2:
        $facility = "800 Water St.";
        break;
    }

    // Set value of time
    switch($time) {
        case 1:
          $time = "9:00 AM EST";
          break;
        case 2:
          $time = "10:00 AM EST";
          break;
        case 3:
          $time = "11:00 AM EST";
          break;
        case 4:
          $time = "12:00 PM EST";
          break;
        case 5:
          $time = "1:00 PM EST";
          break;
        case 6:
          $time = "2:00 PM EST";
          break;
        case 7:
          $time = "3:00 PM EST";
          break;
        case 8:
          $time = "4:00 PM EST";
          break;
    }

    $email_message = "Form details below.\n\n";
    $email_message .= "First Name: ".clean_string($first_name)."\n";
    $email_message .= "Last Name: ".clean_string($last_name)."\n";
    $email_message .= "E-mail: ".clean_string($email)."\n";
    $email_message .= "Phone: ".clean_string($phone)."\n";
    $email_message .= "Company: ".clean_string($company)."\n";
    $email_message .= "Facility: ".clean_string($facility)."\n";
    $email_message .= "Time: ".clean_string($time)."\n";
    $email_message .= "Date: ".clean_string($date)."\n";
    $email_message .= "Message: ".clean_string($message)."\n";

    $email_subject .= "Tour)";

    // Headers for e-mail
    $headers = 'From: '.$email."\r\n".
    'Reply-To: '.$email."\r\n" .
    'X-Mailer: PHP/' . phpversion();
    @mail($email_to, $email_subject, $email_message, $headers);
    header('Location: tour.html?message=success');
  }

  if($_POST['type'] == "colocation")
  {
    // colocation.html
    $first_name = stripslashes($_POST['first_name']);
    $last_name = stripslashes($_POST['last_name']);
    $email = stripslashes($_POST['email']);
    $phone = stripslashes($_POST['phone_number']);
    $company = stripslashes($_POST['company']);
    $package = $_POST['package'];
    $date = $_POST['date'];
    $message = stripslashes($_POST['message']);

    // Set value of package
    switch($package) {
      case 1:
        $package = "Shared";
        break;
      case 2:
        $package = "Half-Cab";
        break;
      case 3:
        $package = "Full-Cab";
        break;
      case 4:
        $package = "Private Cage";
        break;
    }

    $email_subject .= "Co-Location)";

    $email_message = "Form details below.\n\n";
    $email_message .= "First Name: ".clean_string($first_name)."\n";
    $email_message .= "Last Name: ".clean_string($last_name)."\n";
    $email_message .= "E-mail: ".clean_string($email)."\n";
    $email_message .= "Phone: ".clean_string($phone)."\n";
    $email_message .= "Company: ".clean_string($company)."\n";
    $email_message .= "Package: ".clean_string($package)."\n";
    $email_message .= "Date: ".clean_string($date)."\n";
    $email_message .= "Message: ".clean_string($message)."\n";

    // Headers for e-mail
    $headers = 'From: '.$email."\r\n".
    'Reply-To: '.$email."\r\n" .
    'X-Mailer: PHP/' . phpversion();
    @mail($email_to, $email_subject, $email_message, $headers);
    header('Location: colocation.html?message=success');
  }
}
?>
