<?php

namespace App\Console\Commands;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\MyEmail;
use App\Models\Cart;
use App\Models\User;

class SendEmailAbondedCart extends Command
{
    protected $signature = 'email:send';

    public function handle()
    {
        
    }
}
