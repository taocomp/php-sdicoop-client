<?php

ini_set("soap.wsdl_cache_enabled", 0);
ini_set('soap.wsdl_cache_ttl', 0);

use \Taocomp\Einvoicing\Sdicoop\Client;
use \Taocomp\Einvoicing\Sdicoop\TestSdiRiceviNotifica;
use \Taocomp\Einvoicing\Sdicoop\FileSdI;
use \Taocomp\Einvoicing\Sdicoop\RispostaSdINotificaEsito;

try
{
    require_once(__DIR__ . '/../autoload.php');

    $client = new TestSdiRiceviNotifica(array(
        'key'     => __DIR__ . '/../assets/key/client.key',
        'cert'    => __DIR__ . '/../assets/certs/client.pem',
        'ca_cert' => __DIR__ . '/../assets/certs/ca.pem'
    ));

    // Verbose (default: false)
    TestSdiRiceviNotifica::$verbose = false;
    
    $fileSdI = new FileSdI();
    $fileSdI->load(__DIR__ . '/notice.xml');
    $response = new RispostaSdINotificaEsito($client->NotificaEsito($fileSdI));

    // Process response:
    // ----------------------------------
    // $result          = $response->Esito;
    // $discard         = $response->ScartoEsito;
    // $discardFilename = $discard->NomeFile;
    // $discardFile     = $discard->File;
    // ----------------------------------
}
catch (\Exception $e)
{
    TestSdiRiceviNotifica::log($e->getMessage(), LOG_ERR);
}
