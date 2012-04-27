<?php

namespace PHttpRequests\SimpleCurl;

require_once "Exception/ConnectionErrorException.php";

use PHttpRequests\SimpleCurl\RequestInformation;
use PHttpRequests\SimpleCurl\Exception\ConnectionErrorException;

class SimpleCurl
{
    private $handler = null;
    private $requestContent = null;

    public function __destruct()
    {
        if (!is_null($this->handler)) {
            curl_close($this->handler);
            $this->handler = null;
        }
    }

    public function connect($url)
    {
        $this->destroyRequestData();

        $result = curl_init($url);

        if ($result) {
            $this->handler = $result;
            $this->setDefaultConfiguration();
        }

        /* TODO: Should throw an exception when was unable to connect */

        $result = null;
    }

    public function disconnect()
    {
        if (is_null($this->handler)) {
            throw new \LogicException('Trying to disconnect without create a cUrl session.');
        }

        curl_close($this->handler);
        $this->destroyRequestData();
    }

    public function getHandler()
    {
        return $this->handler;
    }

    public function makeRequest()
    {
        if (is_null($this->handler)) {
            throw new \LogicException('Trying to make a request without create a cUrl session.');
        }

        $requestContent = curl_exec($this->handler);

        if ($requestContent) {
            $this->requestContent = $requestContent;
        } else {
            throw new ConnectionErrorException("Unable to reach requested url.");
        }
    }

    public function getRequestContent()
    {
        return $this->requestContent;
    }

    public function getRequestInformation()
    {
        if (is_null($this->handler)) {
            throw new \LogicException('Trying to get request information without create a cUrl session.');
        }

        if (is_null($this->requestContent)) {
            throw new \LogicException('Trying to get request information without make any request.');
        }

        $info = curl_getinfo($this->handler);

        if ($info) {
            return new RequestInformation($info);
        }

        /* TODO: Should throw an exception when was unable to get information from request */
    }

    private function setDefaultConfiguration()
    {
        curl_setopt($this->handler, CURLOPT_RETURNTRANSFER, true);

        /* TODO: Turn on follow redirects. Needs a test! */

        //curl_setopt($requestHandler, CURLOPT_FOLLOWLOCATION, true);
    }

    private function destroyRequestData()
    {
        $this->handler = null;
        $this->requestContent = null;
    }

}
