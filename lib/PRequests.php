<?php

require_once "ResponseObject.php";

class PRequests
{
    
    public function get($url)
    {
        $responseObject = null;
        
        $requestHandler = $this->initRequestHandler($url);
        
        $requestContent = $this->makeRequest($requestHandler);
        
        $requestInfo = curl_getinfo($requestHandler);
        $responseObject = new PRequests_ResponseObject;
        $responseObject->statusCode = $requestInfo["http_code"];
        
        return $responseObject;
        
    }
    
    private function initRequestHandler($url)
    {
        $requestHandler = curl_init($url);
        curl_setopt($requestHandler, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($requestHandler, CURLOPT_FOLLOWLOCATION, true);
        
        if (false !== $requestHandler) {
            return $requestHandler;
        }
    }
    
    private function parseURL($url)
    {
        if (is_null(parse_url($url, PHP_URL_SCHEME))) {
            throw new InvalidArgumentException("Invalid url scheme");
        }
    }
    
    private function closeRequestHandler($handler)
    {
        curl_close($handler);
    }
    
    private function makeRequest($handler)
    {
        $response = curl_exec($handler);
        
        if (false !== $response) {
            return $response;
        }
    }
    
}
