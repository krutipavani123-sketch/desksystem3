<?php

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Spatie\LaravelPdf\Facades\Pdf;
use App\Models\CustomerReport;
// #[Signature('app:customer-report-command')]
// #[Description('Command description')]
class CustomerReportCommand extends Command
{
    protected $signature = 'app:customer-report-command';      //cmd name
    protected $description = 'Command description';    // show in list name
    public function handle()
    {
        $customers = User::role('customer')
            ->withcount('customertickets')->get();
        $content = view('reports.customer', compact('customers'))->render();

        $filename = "reports/customerreport_" . now()->format('Y_m_d') . ".html";

        Storage::disk('public')->put($filename, $content);

        CustomerReport::updateOrCreate(
            [
                //search condition
                'report_date' => now()->toDateString(),
            ],
            [
                'file_path' => $filename,
            ]
        );

        $this->info("Customer Report generated successfully!");
    }
}
