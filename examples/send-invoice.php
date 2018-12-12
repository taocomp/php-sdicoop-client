<?php

/**
 * Copyright (C) 2018 Taocomp s.r.l.s. <https://taocomp.com>
 *
 * This file is part of php-sdicoop-client.
 *
 * php-sdicoop-client is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * php-sdicoop-client is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with php-sdicoop-client.  If not, see <http://www.gnu.org/licenses/>.
 */

ini_set("soap.wsdl_cache_enabled", 0);
ini_set('soap.wsdl_cache_ttl', 0);

use \Taocomp\Sdicoop\Client;
use \Taocomp\Sdicoop\FileSdIBase;
use \Taocomp\Sdicoop\RispostaSdIRiceviFile;

try
{
    require_once(__DIR__ . '/../autoload.php');

    // Set certs and key
    Client::setPrivateKey(__DIR__ . '/client.key');
    Client::setClientCert(__DIR__ . '/client.pem');
    Client::setCaCert(__DIR__ . '/ca.pem');

    $client = new Client(array(
        'endpoint' => 'https://testservizi.fatturapa.it/ricevi_file',
        'wsdl'     => __DIR__ . '/../wsdl/SdIRiceviFile_v1.0.wsdl'
    ));
    
    $invoice = new FileSdIBase();
    $invoice->import(__DIR__ . '/invoice.xml');
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
