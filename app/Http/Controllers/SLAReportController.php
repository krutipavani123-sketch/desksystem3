<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\slaReport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\slaReportExport;

class SLAReportController extends Controller
{
    public function index()
    {
        $reports = SLAReport::latest()->get();

        return view('reports.slareports', compact('reports'));
    }

    // public function index()
    // {
    //     $reports = TeamReport::latest()->get();
    //     return view('monitor', compact('reports'));
    // }


    public function slareport()
    {
        $slabreached = Ticket::where('status', '!=', 'Closed')
            ->whereNotNull('sla_deadline')
            ->where('sla_deadline', '<', now())
            ->count();

        $slaOk = Ticket::where('status', 'Closed')->count();
        return view('reports.sla', compact('slabreached', 'slaOk'));
    }

    public function download($id, $type)
    {
        $report = slaReport::findOrFail($id);

        if ($type == 'pdf') {
            return response()->file(
                storage_path('app/public/' . $report->file_path)
            );
        }

        if ($type == 'excel') {
            return Excel::download(
                new slaReportExport($report->id),
                'sla_report_' . now()->format('Y_m_d_H_i_s') . '.xlsx'
            );
        }

        if ($type == 'csv') {
            return Excel::download(
                new slaReportExport($report->id),
                'sla_report_' . now()->format('Y_m_d_H_i_s') . '.csv',
                \Maatwebsite\Excel\Excel::CSV
            );
        }
        abort(404);
    }
}
