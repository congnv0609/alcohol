<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use NumberFormatter;

class Incentive implements FromCollection, WithHeadings, WithTitle, ShouldAutoSize, WithStrictNullComparison
{

    public function headings(): array
    {
        return [
            'user_id',
            'No of date',
            'date',
            'ema1',
            'ema2',
            'ema3',
            'Valid EMA',
            'Incentive',
            'Complaince rate',
            'Additional incentive',
            'Total incentive'
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
        $list = DB::Table('smokers')->whereNotNull('startDate')
            ->join('incentives', 'smokers.id', '=', 'incentives.account_id')
            ->select(DB::raw('if(smokers.term > 0, concat(smokers.account,"-",smokers.term), smokers.account) as account'), 
                'incentives.no_of_date', 
                'incentives.date', 
                'incentives.ema_1', 
                'incentives.ema_2', 
                'incentives.ema_3', 
                'incentives.valid_ema', 
                'incentives.incentive', 
                'incentives.complaince_rate',
                'incentives.additional_incentive',
                'incentives.total_incentive'
            )
            ->get();
        $list->transform(function ($i) {
            foreach ($i as $key => $col) {
                if ($key == "no_of_date" && !empty($col)) {
                    $locale = 'en_US';
                    $nf = new NumberFormatter($locale, NumberFormatter::ORDINAL);
                    $i->{$key} = $nf->format($col);
                }
                if ($key == "date" && !empty($col)) {
                    $i->{$key} = date_format(date_create($col), 'd M Y');
                }
                if ($key == "complaince_rate" && !empty($col)) {
                    $i->{$key} = sprintf("%d\%", $col);
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
            'B' => NumberFormat::FORMAT_DATE_XLSX15,
        ];
    }
}
