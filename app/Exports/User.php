<?php

namespace App\Exports;

use App\Models\Smoker;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class User implements FromCollection, WithHeadings, WithColumnFormatting
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
        $list = Smoker::select('account', 'startDate', 'endDate')->get();
        // $this->prepareRows($list);
        return $list;
    }

    public function columnFormats(): array
    {
        return [
            // 'B' => NumberFormat::FORMAT_DATE_YYYYMMDD,
            // 'C' => NumberFormat::FORMAT_DATE_YYYYMMDD,
        ];
    }

    // public function map($smoker): array
    // {
    //     return [
    //         Date::dateTimeToExcel($smoker->startDate),
    //         Date::dateTimeToExcel($smoker->endDate),
    //     ];
    // }

    // public function prepareRows($rows)
    // {
    //     return $rows->transform(function ($user) {
    //         $this->map($user);

    //         return $user;
    //     });
    // }

}