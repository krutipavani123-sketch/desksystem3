<?php
//show data in excel or csv format that reason use export 
namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;   //data come from db
use Maatwebsite\Excel\Concerns\WithHeadings;    // with column
use Maatwebsite\Excel\Concerns\WithMapping;    //for row

class CustomerReportExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return User::role('customer')
            ->withCount('customertickets as tickets_count')
            ->get();
    }

    public function map($user): array
    {
        return [
            $user->id,
            $user->name,
            $user->email,
            $user->tickets_count ?? 0,

        ];
    }

    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Email',
            'Total Tickets',

        ];
    }
}
