<?php namespace Taocomp\Sdicoop;

class FileSdIBase
{
    public $NomeFile = null;
    public $File = null;

    public function __construct( $arg = null )
    {
        if (is_object($arg)) {
            $this->setFromObject($arg);
        } else if (is_string($arg)) {
            $this->setFromFile($arg);
        }
    }

    protected function setFromObject( \StdClass $obj )
    {
        if (!property_exists($obj, 'NomeFile')) {
            throw new \Exception("Cannot find property 'NomeFile'");
        }
        if (!property_exists($obj, 'File')) {
            throw new \Exception("Cannot find property 'File'");
        }
        
        $this->NomeFile = $obj->NomeFile;
        $this->File = base64_decode($obj->File);        
    }

    protected function setFromFile( string $file )
    {
        if (false === is_readable($file)) {
            throw new \Exception("'$file' not found or not readable");
        }

        $this->NomeFile = basename($file);

        // https://forum.italia.it/t/risolto-notifica-di-scarto-content-is-not-allowed-in-prolog/5798/7
        $this->File = str_replace("\xEF\xBB\xBF", '', file_get_contents($file));
    }

    public function __toString()
    {
        return "NomeFile:{$this->NomeFile}";
    }
}
