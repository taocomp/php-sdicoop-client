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

class FileSdI extends FileSdIBase
{
    public $IdentificativoSdI = null;

    public function __construct( \StdClass $parametersIn = null )
    {
        parent::__construct($parametersIn);

        if ($parametersIn) {
            if (!property_exists($parametersIn, 'IdentificativoSdI')) {
                throw new \Exception("Cannot find property 'IdentificativoSdI'");
            }

            $this->IdentificativoSdI = $parametersIn->IdentificativoSdI;
        }
    }

    public function __toString()
    {
        return "IdentificativoSdI:{$this->IdentificativoSdI} " . parent::__toString();
    }

    public function load( $file, $contents = null )
    {
        parent::load($file, $contents);

        $xml = simplexml_load_file($file);

        if (!property_exists($xml, 'IdentificativoSdI')) {
            throw new \Exception("Cannot find 'IdentificativoSdI' in '$file'");
        }

        $this->IdentificativoSdI = $xml->IdentificativoSdI;

        return $this;
    }

    public function import( $file )
    {
        return $this->load($file);
    }
}
