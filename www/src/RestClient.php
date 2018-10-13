<?php

/**
 * Class RestClient
 *
 * An almost completely stripped down version of the REST API (mvqn/rest).
 *
 * @author Ryan Spaeth <rspaeth@mvqn.net>
 */
final class RestClient
{
    /** @const int The default JSON encoding options. */
    private const JSON_OPTIONS = JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES;

    /** @var string The API URL of the UCRM server for which to submit the requests. */
    private $url;

    /** @var string The "App Key" configured in UCRM with Type: "Write". */
    private $key;

    /**
     * @param string $url The base URL of the UCRM server, including the /api/v1.0, but not including a trailing "/".
     * @param string $key The App Key generated in the UCRM with Write permissions.
     */
    public function __construct(string $url, string $key)
    {
        $this->url = $url;
        $this->key = $key;
    }

    /**
     * Creates a cURL session with the necessary options, headers and endpoint to communicate with the UCRM Server.
     *
     * @param string $endpoint The endpoint at which to make the request.
     * @return resource Returns a cURL session.
     */
    private function curl(string $endpoint)
    {
        // Get the base URL and App Key.
        $baseUrl = $this->url;

        // Create a cURL session.
        $curl = curl_init();

        // Set the options necessary for communicating with the UCRM Server.
        curl_setopt($curl, CURLOPT_URL, $baseUrl.$endpoint);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, false);

        // TODO: Determine if we EVER need to use HTTPS and how to handle it correctly here!
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2); // DEFAULT
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 1); // DEFAULT

        // Set the necessary HTTP HEADERS.
        curl_setopt($curl, CURLOPT_HTTPHEADER, [
            "Content-Type: application/json",
            "X-Auth-App-Key: {$this->key}"
        ]);

        return $curl;
    }

    /**
     * Sends a HTTP GET Request to the specified endpoint of the base URL.
     *
     * @param string $endpoint The endpoint at which to make the request.
     * @return array Returns an associative array of the JSON result.
     * @throws \Exception Throws an exception if there were errors during the REST request/response phase.
     */
    public function get(string $endpoint): array
    {
        // Create the cURL session.
        $curl = $this->curl($endpoint);

        // Execute the request and capture the response.
        $response = curl_exec($curl);

        // Check to see if there were any errors...
        if(!$response)
            throw new \Exception("The REST 'GET' request failed with the following error(s): ".curl_error($curl));

        // Close the cURL session.
        curl_close($curl);

        // Finally, return the resulting associative array!
        return json_decode($response, true);
    }

    /**
     * Sends a HTTP POST Requests to the specified endpoint of the base URL.
     *
     * @param string $endpoint The endpoint at which to make the request.
     * @param array $data A JSON encoded string of data to provide to the endpoint.
     * @return array Returns an associative array of the JSON result.
     * @throws \Exception Throws an exception if there were errors during the REST request/response phase.
     */
    public function post(string $endpoint, array $data): array
    {
        // Create the cURL session.
        $curl = $this->curl($endpoint);

        // Set any additional options.
        curl_setopt($curl, CURLOPT_POST, true);

        // Set the data to be provided to the endpoint.
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data, self::JSON_OPTIONS));

        // Execute the request and capture the response.
        $response = curl_exec($curl);

        // Check to see if there were any errors...
        if(!$response)
            throw new \Exception("The REST 'POST' request failed with the following error(s): ".curl_error($curl));

        // Close the cURL session.
        curl_close($curl);

        // Finally, return the resulting associative array!
        return json_decode($response, true);
    }

}