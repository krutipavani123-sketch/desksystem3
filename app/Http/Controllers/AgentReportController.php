<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use App\Models\User;
    use App\Models\Ticket;

    use App\Models\AgentReport;

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
    }
