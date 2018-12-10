<?php

use \Taocomp\Sdicoop\Client;
use \Taocomp\Sdicoop\FileSdI;
use \Taocomp\Sdicoop\RispostaSdINotificaEsito;

try
{
    require_once(__DIR__ . '/../autoload.php');

    // Set certs and key
    Client::setPrivateKey(__DIR__ . '/client.key');
    Client::setClientCert(__DIR__ . '/client.pem');
    Client::setCaCert(__DIR__ . '/ca.pem');

    $client = new Client(array(
        'endpoint' => 'https://testservizi.fatturapa.it/ricevi_notifica',
        'wsdl'     => __DIR__ . '/../wsdl/SdIRiceviNotifica_v1.0.wsdl'
    ));
    
    $notification = new FileSdI();
    $notification->import(__DIR__ . '/notification.xml')->encodeFile();
    $response = new RispostaSdINotificaEsito($client->NotificaEsito($notification));

    // Process response:
    // ----------------------------------
    // $result  = $response->Esito;
    // $discard = $response->ScartoEsito;
    // ----------------------------------
}
catch (\Exception $e)
{
    Client::log($e->getMessage(), LOG_ERR);
}
