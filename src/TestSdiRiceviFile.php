<?php
namespace Taocomp\Einvoicing\Sdicoop;

class TestSdiRiceviFile extends Client
{
    const ENDPOINT = 'https://testservizi.fatturapa.it/ricevi_file';
    const WSDL     = __DIR__ . '/../assets/wsdl/SdIRiceviFile_v1.0.wsdl';
}
