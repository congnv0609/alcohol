<?php

namespace App\Console\Commands;

use App\Mail\AlertMail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class SendMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'alert-mail:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // $email = env('MAIL_TO_ADDRESS', 'info@zoneonezone.com');
        $email2 = "hmrfemasmoking@gmail.com";
        // $email3 = "congnv69@gmail.com";
        $userList = $this->getUserInfo();
        $data = [
                    'date'=> date("d M Y", strtotime("yesterday")),
                    'data' => $userList
        ];
        // Mail::to($email)->send(new AlertMail($data));
        Mail::to($email2)->send(new AlertMail($data));
        // Mail::to($email3)->send(new AlertMail($data));
    }

    private function getUserInfo(){
        $yesterday = date("Y-m-d", strtotime("yesterday"));
        $userList = DB::table('incentives')
                    ->leftjoin('smokers', 'incentives.account_id', '=', 'smokers.id')
                    ->where('incentives.date', $yesterday)
                    ->where(function($query) {
                        $query->where('valid_ema', '<', 3)->orWhereNull('valid_ema');
                    })
                    ->orderBy('smokers.account', 'asc')->orderBy('term', 'asc')
                    ->get();
        return $userList;
    }
}
