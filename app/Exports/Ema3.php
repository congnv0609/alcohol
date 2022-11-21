<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Cell\Cell;
use PhpOffice\PhpSpreadsheet\Cell\DefaultValueBinder;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;

class Ema3 extends DefaultValueBinder implements FromCollection, WithHeadings, WithTitle, ShouldAutoSize, WithColumnFormatting, WithCustomValueBinder, WithStrictNullComparison
{

    private $_headings = [];

    private $_withoutColumns = ['id', 'account_id', 'nth_popup', 'popup_time1', 'popup_time2', 'created_at', 'updated_at'];

    /**
     * @return string
     */
    public function title(): string
    {
        return 'EMA 3';
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
        $list = DB::Table('smokers')->whereNotNull('startDate')
            ->join('ema3s', 'smokers.id', '=', 'ema3s.account_id')
            ->select(DB::raw('if(smokers.term > 0, concat(smokers.account,"-",smokers.term), smokers.account) as user_id'), 'ema3s.*')
            ->get();
        $list->transform(function ($i) {
            foreach ($i as $key => $col) {
                if (in_array($key, $this->_withoutColumns)) {
                    unset($i->$key);
                }
                //
                if ($key =="date" && !empty($col)) {
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
        $row = DB::Table('smokers')->whereNotNull('startDate')
            ->join('ema3s', 'smokers.id', '=', 'ema3s.account_id')
            ->select(DB::raw('if(smokers.term > 0, concat(smokers.account,"-",smokers.term), smokers.account) as user_id'), 'ema3s.*')
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
