<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;

class UsersImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new User([
            'name' => $row[1],
            'email' => $row[2],
            'position' => $row[3],
            'salary' => $row[4],
            'department' => $row[5],
            'date_of_birth' => $row[6],
            'nrc' => $row[7],
            'address' => $row[8],
            'phone' => $row[9],
            'gender' => $row[10],
            'skills' => $row[11],
            'emergency_contact' => $row[12],
            'emergency_contact_number' => $row[13],
            'joining_date' => $row[14],
            'system_status' => $row[15],
        ]);
    }
}
