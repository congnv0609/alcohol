<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class EmaPersonal implements WithMultipleSheets
{
    use Exportable;

    private $_accountId = null;

    public function __construct($accountId)
    {
        $this->_accountId = $accountId;
    }

    /**
     * @return array
     */
    public function sheets(): array
    {
        $sheets = [];
        $sheets[] = new Ema1Personal($this->_accountId);
        $sheets[] = new Ema2Personal($this->_accountId);
        $sheets[] = new Ema3Personal($this->_accountId);
        return $sheets;
    }
}
