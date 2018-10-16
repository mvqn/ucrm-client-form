<?php

// Require necessary libraries...
require_once __DIR__ . "/src/RestClient.php";

// Load the configuration file...
//$config = include(__DIR__."/config.php");
require_once __DIR__."/bootstrap.php";

//Notify the user of a successful submission!
echo "Thank you for your submission, a sales representative will contact you soon!";



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
    "phone" => $_POST["phone"],
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



