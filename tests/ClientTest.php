<?php
use PHPUnit\Framework\TestCase;
use Taocomp\Einvoicing\SdicoopClient\Client;

class ClientTest extends TestCase
{
    public function testCannotCreateWithoutParams()
    {
        $this->expectException(\Exception::class);

        $client = new Client();
    }

    public function testCanCreateWithAllParamsInArray()
    {
        $client = new Client(array(
            'key' => '',
            'cert' => '',
            'ca_cert' => '',
            'endpoint' => 'https://testservizi.fatturapa.it/ricevi_file',
            'wsdl' => __DIR__ . '/../assets/wsdl/SdIRiceviFile_v1.0.wsdl'
        ));

        $this->assertInstanceOf(Client::class, $client);        
    }
}
