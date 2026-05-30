<?php

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use App\Models\Ticket;
use App\Models\slaReport;
use Illuminate\Support\Facades\Storage;
use Spatie\LaravelPdf\Facades\Pdf;
// #[Signature('app:sla-report-command')]
// #[Description('Command description')]
class slaReportCommand extends Command
{
    protected $signature = 'app:sla-report-command';      //cmd name
    protected $description = 'Command description';    // show in list name

    public function handle()
    {
        $slabreached = Ticket::where('status', '!=', 'Closed')
            ->whereNotNull('sla_deadline')
            ->where('sla_deadline', '<', now())
            ->count();

        $slaOk = Ticket::where('status', 'Closed')->count();

        $content = view('reports.sla', compact('slabreached', 'slaOk'))->render();

        $filename = "reports/slareport_" . now()->format('Y_m_d') . ".html";

        Storage::disk('public')->put($filename, $content);

        slaReport::updateOrCreate(
            [
                //search condition
                'report_date' => now()->toDateString(),
            ],
            [
                'file_path' => $filename,
            ]
        );

        $this->info("SLA Report generated successfully!");
    }
}
