<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;

class Ema1Personal implements FromCollection, WithHeadings, WithTitle, WithColumnFormatting, ShouldAutoSize, WithStrictNullComparison
{

    private $_headings = [];

    private $_withoutColumns = ['id', 'account_id', 'nth_popup', 'popup_time1', 'popup_time2', 'created_at', 'updated_at'];

    private $_accountId = null;

    public function __construct($accountId)
    {
        $this->_accountId = $accountId;
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'Ema 1';
    }

    public function headings(): array
    {
        $this->getFirst();
        return $this->_headings;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
       return $this->makeList();
    }

    private function makeList(){
        $list = DB::Table('smokers')->where('smokers.id', $this->_accountId)->whereNotNull('smokers.startDate')
        ->join('ema1s', 'smokers.id', '=', 'ema1s.account_id')
        ->select(DB::raw('if(smokers.term > 1, concat(smokers.account,"-",smokers.term), smokers.account) as user_id'), 'ema1s.*')
        ->get();
        $list->transform(function ($i) {
            foreach ($i as $key => $col) {
                if (in_array($key, $this->_withoutColumns)) {
                    unset($i->$key);
                }
                //
                if ($key == "date" && !empty($col)) {
                    $i->{$key} = date_format(date_create($col), 'd M Y');
                }
                if ($key =="attempt_time" && !empty($col)) {
                    $i->{$key} = date_format(date_create($col), 'H:i:s');
                }
                if ($key =="submit_time" && !empty($col)) {
                    $i->{$key} = date_format(date_create($col), 'H:i:s');
                }
                if ($key =="time_taken" && !empty($col)) {
                    $min = floor($col / 60);
                    $sec = $col % 60;
                    $i->{$key} = sprintf('00:%02d:%02d', $min, $sec);
                }
            }
            return $i;
        });
        return $list;
    }

    private function getFirst()
    {
        $row = DB::Table('smokers')
        ->join('ema1s', 'smokers.id', '=', 'ema1s.account_id')
        ->select(DB::raw('if(smokers.term > 1, concat(smokers.account,"-",smokers.term), smokers.account) as user_id'), 'ema1s.*')
        ->first();
        if (!empty($row)) {
            $cols = array_keys(get_object_vars($row));
            foreach ($cols as $key => $col) {
                if (in_array($col, $this->_withoutColumns)) {
                    unset($cols[$key]);
                } else {
                    $cols[$key] = ucfirst($col);
                }
            }
            $this->_headings = $cols;
        }
    }

    public function columnFormats(): array
    {
        return [
            'A' => NumberFormat::FORMAT_TEXT,
        ];
    }
}
