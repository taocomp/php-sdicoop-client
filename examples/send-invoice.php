<?php

ini_set("soap.wsdl_cache_enabled", 0);
ini_set('soap.wsdl_cache_ttl', 0);

use \Taocomp\Einvoicing\Sdicoop\Client;
use \Taocomp\Einvoicing\Sdicoop\FileSdIBase;
use \Taocomp\Einvoicing\Sdicoop\RispostaSdIRiceviFile;

try
{
    require_once(__DIR__ . '/../vendor/autoload.php');

    // Set certs and key
    Client::setPrivateKey(__DIR__ . '/../assets/key/client.key');
    Client::setClientCert(__DIR__ . '/../assets/certs/client.pem');
    Client::setCaCert(__DIR__ . '/../assets/certs/ca.pem');

    $client = new Client(array(
        'endpoint' => 'https://testservizi.fatturapa.it/ricevi_file',
        'wsdl'     => __DIR__ . '/../assets/wsdl/SdIRiceviFile_v1.0.wsdl'
    ));
    
    // Verbose (default: false)
    // $client->setVerbose(true);
    
    $fileSdI = new FileSdIBase();
    $fileSdI->load(__DIR__ . '/invoice.xml');
    $response = new RispostaSdIRiceviFile($client->RiceviFile($fileSdI));

    // Process response:
    // -----------------------------------------
    $id       = $response->IdentificativoSdI;
    $datetime = $response->DataOraRicezione;
    $error    = $response->Errore;

    echo PHP_EOL;
    echo "IdentificativoSdI: $id" . PHP_EOL;
    echo "DataOraRicezione : $datetime" . PHP_EOL;
    if (false === empty($error)) {
        echo "Errore           : $error" . PHP_EOL;
    }
    echo PHP_EOL;
    // -----------------------------------------
}
catch (\Exception $e)
{
    Client::log($e->getMessage(), LOG_ERR);
}
