<?php

namespace Omnipay\Paytrace\Message\Check;

use Omnipay\Tests\TestCase;

class VoidRequestTest extends TestCase
{
    /** @var  \Omnipay\Paytrace\Message\Check\VoidRequest $request */
    private $request;

    public function setUp()
    {
        parent::setUp();
        $this->request = new VoidRequest($this->getHttpClient(), $this->getHttpRequest());
    }

    public function testGetData()
    {
        $expectedData = [
            'username' => 'tester',
            'password' => 'testpwd',
            'transactionReference' => '32167',
        ];

        $this->request->initialize($expectedData);
        $data = $this->request->getData();

        $this->assertSame($expectedData['transactionReference'], $data['CHECKID']);
        $this->assertSame($expectedData['username'], $data['UN']);
        $this->assertSame($expectedData['password'], $data['PSWD']);
        $this->assertSame('ManageCheck', $data['METHOD']);
        $this->assertSame('Void', $data['CHECKTYPE']);
    }
}
