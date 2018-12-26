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

namespace Taocomp\Einvoicing\SdicoopClient;

class RispostaSdIRiceviFile
{
    public $IdentificativoSdI = null;
    public $DataOraRicezione = null;
    public $Errore = null;

    public function __construct( \StdClass $obj )
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
