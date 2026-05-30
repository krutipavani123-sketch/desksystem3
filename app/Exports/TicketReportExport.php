<?php
//show data in excel or csv format that reason use export 
namespace App\Exports;

use App\Models\Ticket;
use Maatwebsite\Excel\Concerns\FromCollection;   //data come from db
use Maatwebsite\Excel\Concerns\WithHeadings;    // with column
use Maatwebsite\Excel\Concerns\WithMapping;    //for row

class TicketReportExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return collect([
            [
                Ticket::count(),
                Ticket::where('status', 'Open')->count(),
                Ticket::where('status', 'Closed')->count(),
                Ticket::where('status', 'Pending')->count(),
                Ticket::where('status', 'In Progress')->count(),
            ]
        ]);
    }

    // public function map($ticket): array
    // {
    //     return [
    //         $ticket->Total,
    //         $ticket->Open,
    //         $ticket->Closed,
    //         $ticket->Pending,
    //         $ticket->InProgress,

    //     ];
    // }

    public function headings(): array
    {
        return [
            'Total Tickets',
            'Open Tickets',
            'Closed Tickets',
            'Pending Tickets',
            'In Progress Tickets',
        ];
    }
}
