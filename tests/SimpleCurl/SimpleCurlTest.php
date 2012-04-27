<?php

namespace PHttpRequests\SimpleCurl;

require_once __DIR__.'/../../src/PHttpRequests/SimpleCurl/SimpleCurl.php';
require_once __DIR__.'/../../src/PHttpRequests/SimpleCurl/RequestInformation.php';

class SimpleCurlTest extends \PHPUnit_Framework_TestCase
{
    public function testShouldBeAbleToMakeCurlSession()
    {
        $simpleCurl = new SimpleCurl();
        $simpleCurl->connect('http://google.com');

        $this->assertTrue(is_resource($simpleCurl->getHandler()));
    }

    public function testShouldBeAbleToDestroyACurlSession()
    {
        $simpleCurl = new SimpleCurl();
        $simpleCurl->connect('http://google.com');
        $simpleCurl->disconnect();

        $this->assertNull($simpleCurl->getHandler());
    }

    /**
     * @expectedException LogicException
     */
    public function testShouldThrowAnExceptionWhenTryingToDisconnectWithoutConnect()
    {
        $simpleCurl = new SimpleCurl();
        $simpleCurl->disconnect();
    }

    public function testShouldReturnPageContentsWhenAValidURLIsGiven()
    {
        $simpleCurl = new SimpleCurl();
        $simpleCurl->connect('http://google.com');
        $simpleCurl->makeRequest();

        $this->assertNotNull($simpleCurl->getRequestContent());
    }

    /**
     * @expectedException LogicException
     */
    public function testShouldThrowAnExceptionWhenTryingToMakeARequestWithoutConnect()
    {
        $simpleCurl = new SimpleCurl();
        $simpleCurl->makeRequest();
    }

    /**
     * @expectedException \PHttpRequests\SimpleCurl\Exception\ConnectionErrorException
     */
    public function testShouldThrowAnExceptionWhenUrlGivenDoesNotExist()
    {
        $simpleCurl = new SimpleCurl();
        $simpleCurl->connect('http://1234abc12345.com');
        $simpleCurl->makeRequest();
    }

    public function testShouldBeAbleToGetRequestInformationForWhenAValidURLIsGiven()
    {
        $simpleCurl = new SimpleCurl();
        $simpleCurl->connect('http://google.com');
        $simpleCurl->makeRequest();

        $info = $simpleCurl->getRequestInformation();

        $this->assertNotNull($info);
    }

    /**
     * @expectedException LogicException
     */
    public function testShouldThrowAnExceptionWhenTryingToGetRequestInformationWithoutConnect()
    {
        $simpleCurl = new SimpleCurl();
        $simpleCurl->getRequestInformation();
    }

    /**
     * @expectedException LogicException
     */
    public function testShouldThrowAnExceptionWhenTryingToGetRequestInformationWithoutMakeAnyRequest()
    {
        $simpleCurl = new SimpleCurl();
        $simpleCurl->connect('http://google.com');
        $simpleCurl->getRequestInformation();
    }

    public function testShouldReturnAnInstanceOfRequestInformation()
    {
        $simpleCurl = new SimpleCurl();
        $simpleCurl->connect('http://google.com');

        $simpleCurl->makeRequest();

        $requestInfo = $simpleCurl->getRequestInformation();

        $this->assertInstanceOf('\PHttpRequests\SimpleCurl\RequestInformation', $requestInfo);
    }

}
