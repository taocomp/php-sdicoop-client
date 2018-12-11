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

namespace Taocomp\Sdicoop;

class FileSdIBase
{
    public $NomeFile = null;
    public $File = null;

    public function __construct( \StdClass $parametersIn = null )
    {
        if ($parametersIn) {
            if (!property_exists($parametersIn, 'NomeFile')) {
                throw new \Exception("Cannot find property 'NomeFile'");
            }
            if (!property_exists($parametersIn, 'File')) {
                throw new \Exception("Cannot find property 'File'");
            }
        
            $this->NomeFile = $parametersIn->NomeFile;
            $this->File = $parametersIn->File;
            $this->decodeFile();
        }
    }

    public function __toString()
    {
        return "NomeFile:{$this->NomeFile}";
    }

    public function import( string $file )
    {
        if (false === is_readable($file)) {
            throw new \Exception("'$file' not found or not readable");
        }

        $this->NomeFile = basename($file);
        $this->File = file_get_contents($file);

        return $this;
    }

    public function encodeFile()
    {
        // https://forum.italia.it/t/risolto-notifica-di-scarto-content-is-not-allowed-in-prolog/5798/7
        $this->File = str_replace("\xEF\xBB\xBF", '', $this->File);

        return $this;
    }

    public function decodeFile()
    {
        $this->File = base64_decode($this->File);

        return $this;
    }
}
