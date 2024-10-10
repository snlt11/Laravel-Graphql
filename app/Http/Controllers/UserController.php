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

        // Excel::store(new UsersExport, 'export_file/' . $file_name);

        // $fileUrl = url('/storage/' . $file_name);

        // return $fileUrl;

        return Excel::download(new UsersExport, $file_name);
    }

    public function import(Request $request)
    {
        try {
            $fileType = $request->file('file');
            Excel::import(new UsersImport, $fileType);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 400);
        }
        return response()->json([
            'status' => 'success',
            'message' => 'File imported successfully'
        ], 201);
    }
}
