<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    public function export()
    {
        $file_name = 'users_' . time() . '.xlsx';
        return Excel::download(new UsersExport, $file_name);
    }
}
