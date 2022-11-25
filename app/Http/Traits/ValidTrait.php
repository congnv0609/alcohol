<?php

namespace App\Http\Traits;

use App\Models\Smoker;

trait ValidTrait
{
    public function checkValidAccount($account)
    {
        $num_length = strlen((string)$account);
        if ($num_length == 5) {
            return 1;
        } else {
            return false;
        }
    }

    public function newAccount(&$account)
    {
        if (Smoker::where([['account', $account->account], ['term', $account->term]])->exists()) {
            $account->term++;
            $this->newAccount($account);
        } else {
            $user = Smoker::create((array)$account);
            return $user;
        }
    }
}
