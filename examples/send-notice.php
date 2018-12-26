<?php

ini_set("soap.wsdl_cache_enabled", 0);
ini_set('soap.wsdl_cache_ttl', 0);

use \Taocomp\Einvoicing\SdicoopClient\Client;
use \Taocomp\Einvoicing\SdicoopClient\FileSdI;
use \Taocomp\Einvoicing\SdicoopClient\RispostaSdINotificaEsito;

try
{
    require_once(__DIR__ . '/../vendor/autoload.php');

    $client = new Client(array(
        'key'      => __DIR__ . '/../assets/key/client.key',
        'cert'     => __DIR__ . '/../assets/certs/client.pem',
        'ca_cert'  => __DIR__ . '/../assets/certs/ca.pem',
        'endpoint' => 'https://testservizi.fatturapa.it/ricevi_notifica',
        'wsdl'     => __DIR__ . '/../assets/wsdl/SdIRiceviNotifica_v1.0.wsdl'
    ));

    // Verbose (default: false)
    // $client->setVerbose(true);
    
    $fileSdI = new FileSdI();
    $fileSdI->load(__DIR__ . '/notice.xml');
    $response = new RispostaSdINotificaEsito($client->NotificaEsito($fileSdI));

    // Process response:
    // ----------------------------------
    $result          = $response->Esito;
    // $discard         = $response->ScartoEsito;
    // $discardFilename = $discard->NomeFile;
    // $discardFile     = $discard->File;
    echo PHP_EOL;
    echo "Esito: $result" . PHP_EOL;
    echo PHP_EOL;
    // ----------------------------------
}
catch (\Exception $e)
{
    Client::log($e->getMessage(), LOG_ERR);
}
