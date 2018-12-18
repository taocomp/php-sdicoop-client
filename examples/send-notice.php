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
    
    $fileSdI = new FileSdI();
    $fileSdI->import(__DIR__ . '/notice.xml');
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
    Client::log($e->getMessage(), LOG_ERR);
}
