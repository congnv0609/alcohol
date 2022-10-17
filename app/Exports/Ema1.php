<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use PhpOffice\PhpSpreadsheet\Cell\DefaultValueBinder;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Cell\Cell;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;

class Ema1 extends DefaultValueBinder implements FromCollection, WithHeadings, WithTitle, ShouldAutoSize, WithCustomValueBinder, WithStrictNullComparison
{

    private $_headings = [];

    private $_withoutColumns = ['id', 'account_id', 'nth_popup','popup_time1', 'popup_time2', 'created_at', 'updated_at'];

    /**
     * @return string
     */
    public function title(): string
    {
        return 'EMA 1';
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
        
        $list = DB::Table('smokers')->whereNotNull('smokers.startDate')
            ->join('ema1s', 'smokers.id', '=', 'ema1s.account_id')
            ->select(DB::raw('if(smokers.term > 1, concat(smokers.account,"-",smokers.term), smokers.account) as user_id'), 'ema1s.*')
            ->whereNotNull('smokers.startDate')
            ->get();
        $list->transform(function ($i) {
            foreach ($i as $key => $col) {
                if (in_array($key, $this->_withoutColumns)) {
                    unset($i->$key);
                }
                //
                if($key=="date" && !empty($col)) {
                    $i->{$key} = date_format(date_create($col), 'd M Y');
                }
                if ($key =="attempt_time" && !empty($col)) {
                    $i->{$key} = date_format(date_create($col), 'H:i:s');
                }
                if ($key =="submit_time" && !empty($col)) {
                    $i->{$key} = date_format(date_create($col), 'H:i:s');
                }
                if ($key =="time_taken" && !empty($col)) {
                    $min = floor($col/60);
                    $sec = $col%60;
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
            foreach($cols as $key => $col) {
                if(in_array($col, $this->_withoutColumns)) {
                    unset($cols[$key]);
                } else {
                    $cols[$key] = ucfirst($col);
                }
            }
            $this->_headings = $cols;
        }
    }

    // public function columnFormats(): array
    // {
    //     return [
    //         'A' => NumberFormat::FORMAT_TEXT,
    //         'B' => NumberFormat::FORMAT_DATE_DDMMYYYY,
    //     ];
    // }

    // public function map($ema): array
    // {
    //     return [
    //         $ema->user_id,
    //         Date::dateTimeToExcel(date_create($ema->date)),
    //     ];
    // }

    // public function prepareRows($rows)
    // {
    //     return $rows->transform(function ($ema) {
    //         $ema->date = Date::dateTimeToExcel(date_create($ema->date));

    //         return $ema;
    //     });
    // }

    public function bindValue(Cell $cell, $value)
    {
        if (is_numeric($value) && $cell->getColumn() == "A") {
            $cell->setValueExplicit($value, DataType::TYPE_STRING);
            return true;
        }
        // else return default behavior
        return parent::bindValue($cell, $value);
    }
}
