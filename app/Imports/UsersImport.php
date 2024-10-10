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
            'name' => $row[0],
            'email' => $row[1],
            'position' => $row[2],
            'salary' => $row[3],
            'role' => $row[4],
        ]);
    }
    public function uniqueBy(array $row)
    {
        return $row[1];
    }
}
