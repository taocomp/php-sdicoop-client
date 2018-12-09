<?php namespace Taocomp\Sdicoop;

class RispostaSdINotificaEsito
{
    // Notifica non accettata
    const ES00 = 'ES00';
    // Notifica accettata
    const ES01 = 'ES01';
    // Servizio non disponibile
    const ES02 = 'ES02';
    
    public $Esito = null;
    public $ScartoEsito = null;

    public function __construct( \StdClass $obj )
    {
        $this->Esito = $obj->Esito;
        $this->ScartoEsito = new ScartoEsito($obj->ScartoEsito);

        Client::log($this);
    }

    public function __toString()
    {
        $classArray = explode('\\', __CLASS__);
        return array_pop($classArray)
            . " Esito:{$this->Esito}"
            . " NomeFile:{$this->ScartoEsito->NomeFile}";
    }
}
