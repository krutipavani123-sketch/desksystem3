<?php
//show data in excel or csv format that reason use export 
namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;   //data come from db
use Maatwebsite\Excel\Concerns\WithHeadings;    // with column
use Maatwebsite\Excel\Concerns\WithMapping;    //for row

class AgentReportExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return User::role('support_agent')
            ->withCount([
                'assignedticket as totalticket',
                'assignedticket as closeticket' => function ($q) {
                    $q->where('status', 'Closed');
                }
            ])
            ->get();
    }

    //which type row show in excel that define
    public function map($user): array
    {
        return [
            $user->id,
            $user->name,
            $user->email,
            $user->totalticket ?? 0,
            $user->closeticket ?? 0,
        ];
    }
    //first row of excel
    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Email',
            'Total Tickets',
            'Closed Tickets',
        ];
    }
}
    