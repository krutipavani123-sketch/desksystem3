<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TicketReport;
use App\Models\Ticket;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TicketReportExport;

class TicketReportController extends Controller
{


    public function index()
    {
        $reports = TicketReport::latest()->get();

        return view('reports.ticketreports', compact('reports'));
    }

    // public function index()
    // {
    //     $reports = TeamReport::latest()->get();
    //     return view('monitor', compact('reports'));
    // }


    public function ticketreport()
    {
        $ticketsummary = [
            'total' => Ticket::count(),
            'open' => Ticket::where('status', 'Open')->count(),
            'close' => Ticket::where('status', 'Closed')->count(),
            'pending' => Ticket::where('status', 'Pending')->count(),
            'inprogress' => Ticket::where('status', 'In Progress')->count(),
        ];

        return view('reports.ticket', compact('ticketsummary'));
    }

    public function download($id, $type)
    {
        $report = TicketReport::findOrFail($id);

        if ($type == 'pdf') {
            return response()->file(
                storage_path('app/public/' . $report->file_path)
            );
        }

        if ($type == 'excel') {
            return Excel::download(
                new TicketReportExport($report->id),
                'ticket_report_' . now()->format('Y_m_d_H_i_s') . '.xlsx'
            );
        }

        if ($type == 'csv') {
            return Excel::download(
                new TicketReportExport($report->id),
              'ticket_report_' . now()->format('Y_m_d_H_i_s') . '.csv',
                \Maatwebsite\Excel\Excel::CSV
            );
        }
        abort(404);
    }
}
