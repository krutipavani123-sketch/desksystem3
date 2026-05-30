<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Ticket;

use App\Models\AgentReport;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AgentReportExport;
use ReturnTypeWillChange;

class AgentReportController extends Controller
{
    public function index()
    {
        $reports = AgentReport::latest()->get();

        return view('reports.agentreports', compact('reports'));
    }

    // public function index()
    // {
    //     $reports = TeamReport::latest()->get();
    //     return view('monitor', compact('reports'));
    // }


    public function agentreport()
    {
        $agents = User::role('support_agent')
            ->withcount([
                'assignedticket as totaltickets',
                'assignedticket as closetickets' =>
                function ($q) {
                    $q->where('status', 'Closed');
                }
            ])->get();


        return view('reports.agent', compact('agents'));
    }

    public function download($id, $type)
    {
        $report = AgentReport::findOrFail($id);

        if ($type == 'pdf') {
            return response()->file(
                storage_path('app/public/' . $report->file_path)
            );
        }

        if ($type == 'excel') {
            return Excel::download(
                new AgentReportExport($report->id),
                'agent_report_' . now()->format('Y_m_d_H_i_s') . '.xlsx'
            );
        }

        if ($type == 'csv') {
            return Excel::download(
                new AgentReportExport(),
               'agent_report_' . now()->format('Y_m_d_H_i_s') . '.csv',
                \Maatwebsite\Excel\Excel::CSV
            );
        }
        abort(404);
    }
}
