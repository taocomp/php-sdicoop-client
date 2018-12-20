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

namespace Taocomp\Einvoicing\Sdicoop;

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
        if (true === property_exists($obj->ScartoEsito)) {
            $this->ScartoEsito = new FileSdIBase($obj->ScartoEsito);
        }

        Client::log($this);
    }

    public function __toString()
    {
        $classArray = explode('\\', __CLASS__);
        $str = array_pop($classArray)
             . " Esito:{$this->Esito}";

        if (null !== $this->ScartoEsito) {
            $str .= " ScartoEsito->NomeFile:{$this->ScartoEsito->NomeFile}";
        }
        
        return $str;
    }
}
