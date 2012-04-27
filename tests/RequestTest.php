<?php

namespace PHttpRequests;

require_once __DIR__ . '/../src/PHttpRequests/Request.php';

class RequestTest extends \PHPUnit_Framework_TestCase
{
    
    public function testShouldReturnARequestObjectWhenTryingToGetAnURL()
    {
        $request = new Request;
        $responseObject = $request->get('http://google.com');

        $this->assertInstanceOf('\PHttpRequests\Response', $responseObject);
    }
    
    /**
     * @expectedException InvalidArgumentException
     */
    public function testShouldThrowAnExceptionWhenAnInvalidURLSchemaIsGiven()
    {
        $request = new Request;
        $request->get("google.com");
    }
    
    public function testShouldReturnStatusCodeWhenRetrievingURLSuccessfully()
    {
        $request = new Request;
        $responseObject = $request->get('http://google.com');
        
        $this->assertNotNull($responseObject->statusCode);
    }
}
