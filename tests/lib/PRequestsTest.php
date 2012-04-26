<?php

require_once __DIR__."/../../lib/PRequests.php";

class PRequestsTest extends PHPUnit_Framework_TestCase
{
    
    public function testShouldReturnARequestObjectWhenTryingToGetAnURL()
    {
        $pRequests = new PRequests;
        $responseObject = $pRequests->get("http://google.com");
        
        $this->assertInstanceOf("PRequests_ResponseObject", $responseObject);
    }
    
    /**
     * @expectedException InvalidArgumentException
     */
    public function testShouldThrowAnExceptionWhenAnInvalidURLSchemaIsGiven()
    {
        $pRequests = new PRequests;
        $responseObject = $pRequests->get("google.com");
    }
    
    public function testShouldReturnStatusCodeWhenRetrivingURLIsSuccessfull()
    {
        $pRequests = new PRequests;
        $responseObject = $pRequests->get("http://google.com");
        
        $this->assertNotNull($responseObject->statusCode);
    }
    
}
