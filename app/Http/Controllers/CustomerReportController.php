<?php

namespace App\Http\Controllers;

use App\Models\CustomerReport;
use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CustomerReportExport;

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

    public function download($id, $type)
    {
        $report = CustomerReport::findOrFail($id);

        if ($type == 'pdf') {
            return response()->file(
                storage_path('app/public/' . $report->file_path)
            );
        }

        if ($type == 'excel') {
            return Excel::download(
                new CustomerReportExport($report->id),
                'customer_report_' . now()->format('Y_m_d_H_i_s') . '.xlsx'
            );
        }

        if ($type == 'csv') {
            return Excel::download(
                new CustomerReportExport($report->id),
                'customer_report_' . now()->format('Y_m_d_H_i_s') . '.csv',
                \Maatwebsite\Excel\Excel::CSV
            );
        }
        abort(404);
    }
}
