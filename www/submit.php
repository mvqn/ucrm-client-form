<?php
/**
 *
 *
 * @author Ryan Spaeth <rspaeth@mvqn.net>
 */

require_once __DIR__."/vendor/autoload.php";
require_once __DIR__."/bootstrap.php";

use MVQN\REST\RestClient;



// Get the previous page's URL without the query string.
$previousPage = preg_replace("/\?.*/", "", $_SERVER["HTTP_REFERER"]);



try
{
    $ucrmUrl = array_key_exists("demoUcrmUrl", $_COOKIE) ?
        $_COOKIE["demoUcrmUrl"]."/api/v1.0" :
        $config["ucrm"]["rest"]["url"];
    $ucrmKey = array_key_exists("demoUcrmKey", $_COOKIE) ?
        $_COOKIE["demoUcrmKey"] :
        $config["ucrm"]["rest"]["key"];

    // The encoded cookie always seems to replace "+" with " ", so this is a workaround!
    // TODO: Find a better way!
    $ucrmKey = str_replace(" ", "+", $ucrmKey);

    // Create the REST Client.
    $rest = new RestClient($ucrmUrl, $ucrmKey);

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

    var_dump($inserted);

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

    // Attempt to insert the Contact in the UCRM system.
    $inserted = $rest->post("/clients/$clientId/contacts", $contact);

    //var_dump($inserted);

    header("Location: $previousPage?status=success");
}
catch (Exception $e)
{
    //var_dump($e);

    header("Location: $previousPage?status=failure");
}

