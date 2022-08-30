<?php

namespace App\Http\Traits;

use App\Models\Ema1;
use App\Models\Ema2;
use App\Models\Ema3;

trait ReportTrait
{
    private $cols = [
        "b2",
        "b3",
        "b4",
        "b7",
        "b10",
        "b13",
        "b14",
        "b15",
        "b16",
    ];

    private $cond_none = [
        "b2" => "b1_a",
        "b3" => "b1_b",
        "b4" => "b1_c",
        "b7" => "b1_d",
        "b10" => "b1_e",
        "b13" => "b1_f",
        "b14" => "b1_g",
        "b15" => "b1_h",
        "b16" => "b1_i",
    ];

    private $rows = [
        ["c1_a", "c1a"],
        ["c1_b", "c1b"],
        ["c1_c", "c1c"],
        ["c1_d", "c1d"],
        ["c1_e", "c1e"],
        ["c1_f", "c1f"],
        ["c1_g", "c1g"],
        ["c1_h", "c1h"],
        ["c2_a", "c2a"],
        ["c2_b", "c2b"],
        ["c2_c", "c2c"],
        ["c2_d", "c2d"],
        ["c2_e", "c2e"],
        ["c2_f", "c2f"],
        ["c2_g", "c2g"],
        ["c2_h", "c2h"],
        ["c2_i", "c2i"],
        ["c2_j", "c2j"],
        ["c2_k", "c2k"],
        ["c2_l", "c2l"],
        ["c2_m", "c2m"],
        ["c2_n", "c2n"],
        ["c2_o", "c2o"],
        ["c2_p", "c2p"],
        ["c3_a", "c3a"],
        ["c3_b", "c3b"],
        ["c3_c", "c3c"],
        ["c3_d", "c3d"],
        ["c3_e", "c3e"],
        ["none", "none"],
    ];

    private function getData($accountId, &$data)
    {
        foreach ($this->cols as $col) {
            foreach ($this->rows as $row) {
                if ($row[0] != "none") {
                    $colName = sprintf("%s_%s", $col, $row[1]);
                    $sumYesEma1 = Ema1::where([[$row[0], true], [$colName, true], ['account_id', $accountId]])->count();
                    $sumYesEma2 = Ema2::where([[$row[0], true], [$colName, true], ['account_id', $accountId]])->count();
                    $sumYesEma3 = Ema3::where([[$row[0], true], [$colName, true], ['account_id', $accountId]])->count();
                    $sumYes = array_sum([$sumYesEma1, $sumYesEma2, $sumYesEma3]);

                    $sumNoEma1 = Ema1::where([[$row[0], true], [$colName, false], ['account_id', $accountId]])->count();
                    $sumNoEma2 = Ema2::where([[$row[0], true], [$colName, false], ['account_id', $accountId]])->count();
                    $sumNoEma3 = Ema3::where([[$row[0], true], [$colName, false], ['account_id', $accountId]])->count();
                    $sumNo = array_sum([$sumNoEma1, $sumNoEma2, $sumNoEma3]);
                    //add to array
                    $data[$colName] = [$sumYes, $sumNo];
                } else {
                    //answer for none
                    $colName = sprintf("%s_%s", $col, $row[1]);
                    $sumYesEma1 = Ema1::where([[$this->cond_none[$col], true], [$colName, true], ['account_id', $accountId]])
                        ->where(function ($query) {
                            $query->orWhere('c1_i', false)->orWhere('c2_q', false)->orWhere('c3_f', false);
                        })->count();
                    $sumYesEma2 = Ema2::where([[$this->cond_none[$col], true], [$colName, true], ['account_id', $accountId]])
                        ->where(function ($query) {
                            $query->orWhere('c1_i', false)->orWhere('c2_q', false)->orWhere('c3_f', false);
                        })->count();
                    $sumYesEma3 = Ema3::where([[$this->cond_none[$col], true], [$colName, true], ['account_id', $accountId]])
                        ->where(function ($query) {
                            $query->orWhere('c1_i', false)->orWhere('c2_q', false)->orWhere('c3_f', false);
                        })->count();

                    $sumYes = array_sum([$sumYesEma1, $sumYesEma2, $sumYesEma3]);

                    $sumNoEma1 = Ema1::where([[$this->cond_none[$col], true], [$colName, false], ['account_id', $accountId]])
                        ->where(function ($query) {
                            $query->orWhere('c1_i', false)->orWhere('c2_q', false)->orWhere('c3_f', false);
                        })->count();
                    $sumNoEma2 = Ema2::where([[$this->cond_none[$col], true], [$colName, false], ['account_id', $accountId]])
                        ->where(function ($query) {
                            $query->orWhere('c1_i', false)->orWhere('c2_q', false)->orWhere('c3_f', false);
                        })->count();
                    $sumNoEma3 = Ema3::where([[$this->cond_none[$col], true], [$colName, false], ['account_id', $accountId]])
                        ->where(function ($query) {
                            $query->orWhere('c1_i', false)->orWhere('c2_q', false)->orWhere('c3_f', false);
                        })->count();

                    $sumNo = array_sum([$sumNoEma1, $sumNoEma2, $sumNoEma3]);
                    //add to array
                    $data[$colName] = [$sumYes, $sumNo];
                }
            }
        }
    }

    public function getOverviewData($accountId)
    {
        $data = [];
        $this->getData($accountId, $data);
        return $data;
    }
}
