<?php

/**
 * Request
 *
 * @method static string fullUrl() Get the full URL for the request.               Example: http://localhost/stadtkonfetti/public/test?a=4
 * @method static string url() Get the URL for the request (without query string). Example: http://localhost/stadtkonfetti/public/test
 * @method static string baseUrl() Get the root URL for the application.           Example: http://localhost/stadtkonfetti/public
 * @method static string canonicalUrl() Get the canonical URL for the request.     Example: fullUrl = "http://stadtkonfetti.com/page?a=3" --> canonicalUrl = "https://www.stadtkonfetti.de/page"
 * @method static string path() Get the path for the request (without query string). Example: test
 * // @method static string|array query($key = null, $default = null) Retrieve a query string item from the request. Example: ['a' => 4]
 * @method static string|array input($key = null, $default = null) Retrieve an input item from the request ($_GET and $_POST).
 * @method static string|array cookie($key = null, $default = null) Retrieve a cookie from the request.
 * @method static object|array|null file($key = null, $default = null) Retrieve a file from the request.
 * // @method static string|array header($key = null, $default = null) Get a HTTP header item.
 * @method static string body() Gets the raw HTTP request body of the request.
 * @method static string method() Gets the request method (GET, HEAD, POST, PUT, PATCH or DELETE).
 * @method static string ip() Returns the client IP address.
 * @method static boolean isSecure() Checks whether the request is secure or not.
 * @method static boolean isAjax() Determine if the request is the result of an AJAX call.
 * @method static boolean isJson() Determine if the request is sending JSON.
 * @method static boolean wantsJson() Determine if the current request is asking for JSON in return.
 */

class Request extends \Core\Services\Facade
{
    /*
     * @var string Name of the service which is used in the Service Container.
     */
    protected static $serviceName = 'request';
}
