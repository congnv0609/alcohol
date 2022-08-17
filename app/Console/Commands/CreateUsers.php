<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user-create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create an admin account';

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
        $name = $this->ask('What is your name?');
        $username = $this->ask('What is your username?');
        $password = $this->secret('What is the password?');
        $user = User::where('username', $username)->first();
        if (empty($user)) {
            $user = User::create([
                'name' => $name,
                'username' => $username,
                'password' => Hash::make($password)
            ]);
        } else {
            $user->name = $name;
            $user->password = Hash::make($password);
        }
        $user->save();
        $this->info('The user created successful!');
        return 0;
    }
}
