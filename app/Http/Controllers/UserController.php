<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Imports\UsersImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    public function export()
    {
        $file_name = 'users_' . time() . '.xlsx';
        return Excel::download(new UsersExport, $file_name);
    }

    // public function import(Request $request)
    // {
    //     try {
    //         $csvFile = $request->file('file');
    //         Excel::import(new UsersImport, $csvFile);
    //     } catch (\Throwable $th) {
    //         return response()->json([
    //             'status' => 'error',
    //             'message' => $th->getMessage()
    //         ], 400);
    //     }
    //     return response()->json([
    //         'status' => 'success',
    //         'message' => 'Operation successful.'
    //     ], 201);
    // }
}
