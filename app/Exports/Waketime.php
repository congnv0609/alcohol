<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use App\Models\WakeTime as ModelsWakeTime;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

class Waketime implements FromCollection, WithHeadings, WithTitle, ShouldAutoSize, WithColumnFormatting
{

    public function headings(): array
    {
        return [
            'user_id',
            'date_of_change',
            'time_of_change',
            'old_wake',
            'new_wake',
        ];
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'Wake time';
    }

    public function columnFormats(): array
    {
        return [
            'A' => NumberFormat::FORMAT_TEXT,
            'B' => NumberFormat::FORMAT_DATE_DDMMYYYY,
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $list = DB::Table('smokers')->whereNotNull('smokers.startDate')
        ->join('wake_times', 'smokers.id', '=', 'wake_times.account_id')
        ->select(DB::raw('if(smokers.term > 1, concat(smokers.account,"-",smokers.term), smokers.account) as user_id'), 'wake_times.date_of_change', 'wake_times.updated_at', 'wake_times.old_wake', 'wake_times.new_wake')
        ->get();
        $list->transform(function ($i) {
            foreach ($i as $key => $col) {
                // if (in_array($key, $this->_withoutColumns)) {
                //     unset($i->$key);
                // }
                //
                if ($key =="date_of_change" && !empty($col)) {
                    $i->{$key} = date_format(date_create($col), 'd/m/Y');
                }
                if ($key =="updated_at" && !empty($col)) {
                    $i->{$key} = date_format(date_create($col), 'H:i:s');
                }
                if ($key =="old_wake" && !empty($col)) {
                    $i->{$key} = date_format(date_create($col), 'H:i:s');
                }
                if ($key =="new_wake" && !empty($col)) {
                    $i->{$key} = date_format(date_create($col), 'H:i:s');
                }
            }
            return $i;
        });
        return $list;
    }
}
