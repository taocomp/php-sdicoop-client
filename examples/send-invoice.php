<?php

use \Taocomp\Sdicoop\Client;
use \Taocomp\Sdicoop\FileSdIAccoglienza;
use \Taocomp\Sdicoop\RispostaSdIRiceviFile;

try
{
    require_once(__DIR__ . '/../bootstrap.php');

    // Set certs and key
    Client::setPrivateKey(__DIR__ . '/client.key');
    Client::setClientCert(__DIR__ . '/client.pem');
    Client::setCaCert(__DIR__ . '/ca.pem');

    // Set services
    Client::setService('SdIRiceviFile', array(
        'endpoint' => 'https://testservizi.fatturapa.it/ricevi_file',
        'wsdl'     => __DIR__ . '/../wsdl/SdIRiceviFile_v1.0.wsdl'        
    ));

    $client = new Client('SdIRiceviFile');
    $invoice = new FileSdIAccoglienza(__DIR__ . '/invoice.xml');
    $response = new RispostaSdIRiceviFile($client->RiceviFile($invoice));

    // Process response:
    // -----------------------------------------
    // $id       = $response->IdentificativoSdI;
    // $datetime = $response->DataOraRicezione;
    // $error    = $response->Errore;
    // -----------------------------------------
}
catch (\Exception $e)
{
    Client::log($e->getMessage(), LOG_ERR);
}
