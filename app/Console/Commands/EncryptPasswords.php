<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class EncryptPasswords extends Command
{
    protected $signature = 'encrypt:passwords';
    protected $description = 'Encrypt all user passwords';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $users = User::all();

        foreach ($users as $user) {
            if (!Hash::needsRehash($user->password)) {
                continue;
            }

            $user->password = Hash::make($user->password);
            $user->save();
        }

        $this->info('All passwords have been encrypted!');
    }
}
