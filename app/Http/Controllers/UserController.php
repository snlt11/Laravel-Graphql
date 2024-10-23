<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Imports\UsersImport;
use App\Jobs\ExportUsersJob;
use App\Jobs\ImportUsersJob;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    public function export()
    {
        $file_name = 'users_' . time() . '.xlsx';

        ExportUsersJob::dispatch($file_name);

        $fileUrl = url('/storage/export_file/' . $file_name);

        return response()->json([
            'status' => 'success',
            'message' => 'Export is being processed',
            'file_url' => $fileUrl
        ], 201);
    }

    public function import(Request $request)
    {
        try {
            $fileType = $request->file('file')->store('imports');
            ImportUsersJob::dispatch($fileType);
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
