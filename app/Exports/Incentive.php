<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;

class Incentive implements FromCollection, WithHeadings, WithTitle, ShouldAutoSize, WithStrictNullComparison
{

    public function headings(): array
    {
        return [
            'user_id',
            'date',
            'ema1',
            'ema2',
            'ema3',
            'Valid EMA',
            'Incentive',
        ];
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'Incentive';
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        //
        $list = DB::Table('smokers')
            ->join('incentives', 'smokers.id', '=', 'incentives.account_id')
            ->select(DB::raw('if(smokers.term > 1, concat(smokers.account,"-",smokers.term), smokers.account) as account'), 'incentives.date', 'incentives.ema_1', 'incentives.ema_2', 'incentives.ema_3', 'incentives.ema_4', 'incentives.ema_5', 'incentives.valid_ema', 'incentives.incentive')
            ->whereNotNull('smokers.startDate')
            ->get();
        $list->transform(function ($i) {
            foreach ($i as $key => $col) {
                if ($key == "date" && !empty($col)) {
                    $i->{$key} = date_format(date_create($col), 'd/m/Y');
                }
                if ($key == "incentive" && !empty($col)) {
                    $i->{$key} = $col < 15 ? 0 : $col;
                }
            }
            return $i;
        });
        return $list;
    }

    public function columnFormats(): array
    {
        return [
            'A' => NumberFormat::FORMAT_TEXT,
            'B' => NumberFormat::FORMAT_DATE_DDMMYYYY,
        ];
    }
}
