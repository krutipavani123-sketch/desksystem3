<?php
//show data in excel or csv format that reason use export 
namespace App\Exports;

use App\Models\Ticket;
use Maatwebsite\Excel\Concerns\FromCollection;   //data come from db
use Maatwebsite\Excel\Concerns\WithHeadings;    // with column
use Maatwebsite\Excel\Concerns\WithMapping;    //for row

class slaReportExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Ticket::whereNotNull('sla_deadline')->get();
    }

    public function map($ticket): array
    {
        return [
            $ticket->id,
            $ticket->subject,
            $ticket->status,
            $ticket->sla_deadline,
            $ticket->sla_deadline < now() ? 'Breached' : 'OK',
        ];
    }

    public function headings(): array
    {
        return [
            'ID',
            'Subject',
            'Status',
            'SLA Deadline',
            'SLA Status',
        ];
    }
}
