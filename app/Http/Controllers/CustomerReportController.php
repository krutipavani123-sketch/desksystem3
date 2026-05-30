<?php

namespace App\Http\Controllers;

use App\Models\CustomerReport;
use App\Models\User;

use Illuminate\Http\Request;

class CustomerReportController extends Controller
{
    public function index()
    {
        $reports = CustomerReport::latest()->get();

        return view('reports.customerreports', compact('reports'));
    }

    // public function index()
    // {
    //     $reports = TeamReport::latest()->get();
    //     return view('monitor', compact('reports'));
    // }


    public function customerreport()
    {
        $customers = User::role('customer')
            ->withcount('customertickets')->get();

        return view('reports.customer', compact('customers'));
    }
}
