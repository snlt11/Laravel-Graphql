<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return User::select(
    'id',
            'name',
            'email',
            'position',
            'salary',
            'department',
            'date_of_birth',
            'nrc',
            'address',
            'phone',
            'gender',
            'skills',
            'emergency_contact',
            'emergency_contact_number',
            'joining_date',
            'system_status'
            )->get();
    }
    public function headings(): array
    {
        return [
            "Id",
            'Name',
            'Email',
            'Position',
            'Salary',
            'Department',
            'Date of Birth',
            'NRC',
            'Address',
            'Phone',
            'Gender',
            'Skills',
            'Emergency Contact',
            'Emergency Contact Number',
            'Joining Date',
            'System Status'
        ];
    }
}
