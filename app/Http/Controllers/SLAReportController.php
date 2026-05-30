<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\slaReport;
use Illuminate\Http\Request;

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
}
