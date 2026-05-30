<?php

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('app:clear-reports')]
#[Description('Command description')]
class ClearReports extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
    }
}
