<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TicketReport;
use App\Models\Ticket;

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
}
