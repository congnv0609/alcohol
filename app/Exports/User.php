<?php

namespace App\Exports;

use App\Models\Smoker;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use PhpOffice\PhpSpreadsheet\Cell\DefaultValueBinder;
use PhpOffice\PhpSpreadsheet\Cell\Cell;

class User extends DefaultValueBinder implements FromCollection, WithHeadings, WithTitle, WithColumnFormatting, ShouldAutoSize, WithMapping, WithCustomValueBinder
{

    public function headings(): array
    {
        return [
            'user_id',
            'start_date',
            'end_date',
            'prompt_ema',
            'response_ema',
            'non_response EMA',
            'future_ema',
            'response rate',
        ];
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'User';
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $list = Smoker::select(DB::raw('if(smokers.term > 1, concat(smokers.account,"-",smokers.term), smokers.account) as user_id'), DB::raw('if(smokers.status > 0, "(Delete)", "") as status'), 'startDate', 'endDate', 'prompt_ema', 'response_ema', 'non_response_ema', 'future_ema', 'response_rate')
        ->get();
        return $list;
    }

    public function columnFormats(): array
    {
        return [
            'A'=> NumberFormat::FORMAT_TEXT,
            'B' => NumberFormat::FORMAT_DATE_XLSX15,
            'C' => NumberFormat::FORMAT_DATE_XLSX15,
            'D'=>NumberFormat::FORMAT_NUMBER,
            'E'=>NumberFormat::FORMAT_NUMBER,
            'F'=>NumberFormat::FORMAT_NUMBER,
            'G'=>NumberFormat::FORMAT_NUMBER,
            'H'=>NumberFormat::FORMAT_GENERAL,
        ];
    }

    public function map($smoker): array
    {
        return [
            $smoker->user_id.$smoker->status,
            Date::dateTimeToExcel(date_create($smoker->startDate)),
            Date::dateTimeToExcel(date_create($smoker->endDate)),
            $smoker->prompt_ema,
            $smoker->response_ema,
            $smoker->non_response_ema,
            $smoker->future_ema,
            $smoker->response_rate,
        ];
    }

    public function bindValue(Cell $cell, $value)
    {
        if (is_numeric($value) && $cell->getColumn()=="A") {
            $cell->setValueExplicit($value, DataType::TYPE_STRING);
            return true;
        }

        // else return default behavior
        return parent::bindValue($cell, $value);
    }

}
