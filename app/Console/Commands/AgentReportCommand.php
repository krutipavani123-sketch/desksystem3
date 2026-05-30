<?php

namespace App\Console\Commands;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use App\Models\User;
use App\Models\AgentReport;
use Illuminate\Support\Facades\Storage;

// #[Signature('app:agent-report-command')]
// #[Description('Command description')]
class AgentReportCommand extends Command
{
    protected $signature = 'app:agent-report-command';      //cmd name
    protected $description = 'Command description';    // show in list name

    public function handle()
    {
        $agents = User::role('support_agent')
            ->withcount([
                'assignedticket as totaltickets',
                'assignedticket as closetickets' =>
                function ($q) {
                    $q->where('status', 'Closed');
                }
            ])->get();

        //    $content = view('reports.agent', compact('agents'))->render();

        //$filename = "reports/agentreport_" . now()->format('Y_m_d') . ".html";

        //  Storage::disk('public')->put($filename, $content);


        $pdf = Pdf::loadview('reports.agent', compact('agents'));
        $filename = "reports/agentreport_" . now()->format('Y_m_d') . ".pdf";

        Storage::disk('public')->put($filename, $pdf->output()); //convert pdf object in binary pdf        
        // file override if exits else create new             

        AgentReport::updateOrCreate(
            [
                //search condition
                'report_date' => now()->toDateString(),
            ],
            [
                'file_path' => $filename,
            ]
        );

        $this->info("Agent Report generated successfully!");
    }
}
