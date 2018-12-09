<?php namespace Taocomp\Sdicoop;

class FileSdI extends FileSdIBase
{
    public $IdentificativoSdI = null;

    protected function setFromObject( \StdClass $obj )
    {
        parent::setFromObject($obj);
        
        if (!property_exists($obj, 'IdentificativoSdI')) {
            throw new \Exception("Cannot find property 'IdentificativoSdI'");
        }

        $this->IdentificativoSdI = $obj->IdentificativoSdI;
    }

    protected function setFromFile( string $file )
    {
        parent::setFromFile($file);

        $xml = simplexml_load_file($file);

        if (!property_exists($xml, 'IdentificativoSdI')) {
            throw new \Exception("Cannot find 'IdentificativoSdI' in '$file'");
        }

        $this->IdentificativoSdI = $xml->IdentificativoSdI;
    }

    public function __toString()
    {
        return "IdentificativoSdI:{$this->IdentificativoSdI} " . parent::__toString();
    }
}
