<?php
namespace Taocomp\Einvoicing\Sdicoop;

class TestSdiRiceviNotifica extends Client
{
    const ENDPOINT = 'https://testservizi.fatturapa.it/ricevi_notifica';
    const WSDL     = __DIR__ . '/../assets/wsdl/SdIRiceviNotifica_v1.0.wsdl';
}
