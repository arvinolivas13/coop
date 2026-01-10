<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DatabaseBackupController extends Controller
{
    public function backup(Request $request)
    {
        $filename = 'backup-' . date('Y-m-d_H-i-s') . '.sql';
        $storagePath = storage_path('app/backups');

        if (!file_exists($storagePath)) {
            mkdir($storagePath, 0755, true);
        }

        $db = [
            'host'     => config('database.connections.mysql.host'),
            'username' => config('database.connections.mysql.username'),
            'password' => config('database.connections.mysql.password'),
            'database' => config('database.connections.mysql.database'),
        ];

        // Escape password and other inputs to avoid issues
        $mysqldumpPath = '"C:\\xampp\\mysql\\bin\\mysqldump.exe"'; // note the double backslashes and quotes

        $command = sprintf(
            '%s --host=%s --user=%s --password=%s %s > %s 2>&1',
            $mysqldumpPath,
            $db['host'],
            $db['username'],
            $db['password'],
            $db['database'],
            $storagePath . '\\' . $filename
        );

        $result = null;
        $output = null;

        exec($command, $output, $result);

        if ($result === 0) {
            return response()->json([
                'success' => true,
                'message' => 'Backup created successfully!',
                'file' => asset('storage/backups/' . $filename),
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Database backup failed.',
            ], 500);
        }
    }
}
