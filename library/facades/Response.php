<?php

/**
 * Response
 *
 * @method static output($content) Set the output.
 * @method static send() Send the Response to the browser.
 */
class Response extends \Core\Services\Facade
{
    /*
     * @var string Name of the service which is used in the Service Container.
     */
    protected static $serviceName = 'response';
}