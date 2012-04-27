<?php

namespace PHttpRequests;

require_once "Response.php";
require_once "SimpleCurl/SimpleCurl.php";

use PHttpRequests\SimpleCurl\SimpleCurl;

class Request
{
    public function get($url)
    {
        $responseObject = null;

        $this->parseUrl($url);

        $responseObject = new Response;
        $responseObject->statusCode = $this->getRequestInformation($url)->httpCode;

        return $responseObject;
        
    }
    
    private function parseURL($url)
    {
        if (is_null(parse_url($url, PHP_URL_SCHEME))) {
            throw new \InvalidArgumentException('Invalid URL. No URL scheme supplied.');
        }
    }

    private function getRequestInformation($url)
    {
        $simpleCurl = new SimpleCurl;
        $simpleCurl->connect($url);
        $simpleCurl->getHandler();
        $simpleCurl->makeRequest();

        $requestInformation =  $simpleCurl->getRequestInformation();

        $simpleCurl->disconnect();

        return $requestInformation;
    }
}
