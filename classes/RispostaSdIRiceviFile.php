<?php namespace Taocomp\Sdicoop;

class RispostaSdIRiceviFile
{
    public $IdentificativoSdI = null;
    public $DataOraRicezione = null;
    public $Errore = null;

    public function __construct(\StdClass $obj)
    {
        $this->IdentificativoSdI = $obj->IdentificativoSdI;
        $this->DataOraRicezione = $obj->DataOraRicezione;

        if (property_exists($obj, 'Errore')) {
            $this->Errore = $obj->Errore;
        }

        Client::log($this);
    }

    public function __toString()
    {
        $classArray = explode('\\', __CLASS__);
        $str = array_pop($classArray)
             . " IdentificativoSdI:{$this->IdentificativoSdI}"
             . " DataOraRicezione:{$this->DataOraRicezione}";

        if (null !== $this->Errore) {
            $str .= " Errore:{$this->Errore}";
        }

        return $str;
    }
}
