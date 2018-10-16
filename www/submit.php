<?php

//require_once __DIR__."/src/RestClient.php";
require_once __DIR__."/vendor/autoload.php";

use MVQN\REST\RestClient;

// Load the configuration file...
//$config = include(__DIR__."/config.php");
require_once __DIR__."/bootstrap.php";





// Create the REST Client.
$rest = new RestClient($config["ucrm"]["rest"]["url"], $config["ucrm"]["rest"]["key"]);


// Determine the CountryId, or UCRM will assign the organization's default.
$countryId = null;
if($_POST["country"] !== "")
{
    $countries = $rest->get("/countries");

    if ($countries != null)
        foreach ($countries as $country)
        {
            // Lookup based upon "name".
            if ($country["name"] === $_POST["country"])
                $countryId = $country["id"];

            // Lookup based upon "abbreviation".
            if($country["code"] === $_POST["country"])
                $countryId = $country["id"];
        }
}

// Determine the StateId, or UCRM will assign the organization's default (when the country supports a state/region).
$stateId = null;
if($_POST["state"] !== null && $countryId !== null)
{
    $states = $rest->get("/countries/$countryId/states");

    if($states != null)
        foreach ($states as $state)
        {
            // Lookup based upon "name".
            if ($state["name"] === $_POST["state"])
                $stateId = $state["id"];

            // Lookup based upon "abbreviation".
            if($state["code"] === $_POST["state"])
                $stateId = $state["id"];
        }
}

// Create the Client data...
$client = [
    "isLead" => true,
    "clientType" => (int)$_POST["clientType"],
    "companyName" => $_POST["companyName"],
    "companyContactFirstName" => $_POST["clientType"] === "2" ? $_POST["firstName"] : "",
    "companyContactLastName" => $_POST["clientType"] === "2" ? $_POST["lastName"] : "",
    "firstName" => $_POST["firstName"],
    "lastName" => $_POST["lastName"],
    "street1" => $_POST["street1"],
    "street2" => $_POST["street2"],
    "city" => $_POST["city"],
    "stateId" => $stateId,
    "zipCode" => $_POST["zipCode"],
    "countryId" => $countryId,
    "addressGpsLat" => (float)$_POST["latitude"],
    "addressGpsLon" => (float)$_POST["longitude"],
];

// Remove any empty or null values.
$client = array_filter($client, function($value)
{
    return $value !== null && $value !== "";
});

// Insert the Client.
$inserted = $rest->post("/clients", $client);
$clientId = $inserted["id"];


// Create the Contact data...
$contact = [
    "email" => $_POST["email"],
    "phone" => $_POST["phone"] ?: "",
    "name" => $_POST["firstName"]." ".$_POST["lastName"],
    "isBilling" => true,
    "isContact" => true,
];

// Remove any empty or null values.
$contact = array_filter($contact, function($value)
{
    return $value !== null && $value !== "";
});

// Insert the Contact.
$inserted = $rest->post("/clients/$clientId/contacts", $contact);



use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$siteUrl = $config["site"]["url"];

$mail = new PHPMailer(true);

try {
    //Server settings
    //$mail->SMTPDebug = 2;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = $config["smtp"]["server"];              // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = $config["smtp"]["username"];        // SMTP username
    $mail->Password = $config["smtp"]["password"];        // SMTP password
    //$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    //$mail->Port = 587;                                    // TCP port to connect to
    $mail->Port = 25;

    //Recipients
    $mail->setFrom($config["smtp"]["sender"]["email"], $config["smtp"]["sender"]["name"]);
    //$mail->addAddress('joe@example.net', 'Joe User');     // Add a recipient
    //$mail->addAddress('ellen@example.com');               // Name is optional

    foreach($config["smtp"]["recipients"] as $email => $name)
    {
        $mail->addAddress($email, $name);     // Add a recipient
    }

    $mail->addReplyTo($config["smtp"]["sender"]["email"], $config["smtp"]["sender"]["name"]);
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    //Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $config["smtp"]["subject"];

    $link = $config["ucrm"]["host"]."/client/".$clientId;
    $name = $contact['name'];
    $email = $contact['email'];
    $phone = (array_key_exists("phone", $contact) && $contact["phone"] !== null && $contact["phone"] !== "") ? "{$contact['phone']}" : "[NONE]";

    $mail->Body    =
        "Sales Team,<br/>".
        "<br/>".
        "A new client lead has been generated from an online form.<br/>".
        "<br/>".
        "<a href='$link'><strong>$name</strong></a><br/>".
        "Email: <a href='mailto:$email'>$email</a><br/>".
        "Phone: $phone";

    $mail->AltBody =
        "Sales Team,\r\n".
        "\r\n".
        "A new client lead has been generated from an online form.\r\n".
        "\r\n".
        "$name ( $link )\r\n".
        "Email: $email\r\n".
        "Phone: $phone";

    $mail->send();

    //Notify the user of a successful submission!
    echo "Thank you for your submission, a sales representative will contact you soon!<br/><br/>";
    echo "Click <a href='$siteUrl'>here</a> to return to our website.";
    //echo "Redirecting...";
    //sleep(3);
    //header("Location: ".$_SERVER["HTTP_REFERER"]);

}
catch (Exception $e)
{
    //Notify the user of an unsuccessful submission!
    echo "Message could not be sent. Mailer Error: ", $mail->ErrorInfo;

    echo "We are sorry for the inconvenience, but please feel free to contact us by phone!<br/><br/>";
    echo "Click <a href='$siteUrl'>here</a> to return to our website.";
    //sleep(3);
    //header("Location: ".$_SERVER["HTTP_REFERER"]);
    //die();
}

