<?php

namespace App\Console\Commands;
use Spatie\LaravelPdf\Facades\Pdf;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use App\Models\Ticket;
use App\Models\TicketReport;
// #[Signature('app:ticket-report-command')]
// #[Description('Command description')]
class TicketReportCommand extends Command
{
    protected $signature = 'app:ticket-report-command';      //cmd name
    protected $description = 'Command description';    // show in list name

    public function handle()
    {
        $ticketsummary = [
            'total' => Ticket::count(),
            'open' => Ticket::where('status', 'Open')->count(),
            'close' => Ticket::where('status', 'Closed')->count(),
            'pending' => Ticket::where('status', 'Pending')->count(),
            'inprogress' => Ticket::where('status', 'In Progress')->count(),
        ];

        $content = view('reports.ticket', compact('ticketsummary'))->render();

        $filename = "reports/ticketreport_" . now()->format('Y_m_d') . ".html";

        Storage::disk('public')->put($filename, $content);

        TicketReport::updateOrCreate(
            [
                //search condition
                'report_date' => now()->toDateString(),
            ],
            [
                'file_path' => $filename,
            ]
        );

        $this->info("Ticket Report generated successfully!");
    }
}
