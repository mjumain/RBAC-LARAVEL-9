<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use ZipArchive;
use Illuminate\Support\Str;

class DBBackupController extends Controller
{
    public function DBDataBackup(Request $request)  // db data backup only
    {
        $dir = $_SERVER['DOCUMENT_ROOT'] . '/uploads/db/backups/';
        File::ensureDirectoryExists($dir);
        $file_name = 'db_backup_' . Str::slug(now(), '_') . '.sql';
        $file_full_url = $dir . $file_name;
        $file = fopen($file_full_url, 'w');

        $databaseName = DB::getDatabaseName();
        $table_names = DB::table('information_schema.tables')
            ->where('table_schema', $databaseName)
            ->where('TABLE_TYPE', 'BASE TABLE')
            ->when($request->filled('except_tables') && count($request->except_tables), function ($q) {
                $q->whereNotIn('table_name', request('except_tables'));
            })
            ->pluck('TABLE_NAME')
            ->toArray();

        // Loop through the tables and export data into files
        foreach ($table_names as $table_name) {
            $data = DB::table($table_name) // getting a table dataset using select
                ->when($request->filled('table_rules') && count($request->table_rules), function ($q) use ($request, $table_name)  // executing all rules
                {
                    foreach ($request->table_rules as $key => $rule) {
                        if (isset($rule['table_name']) && $rule['table_name'] == $table_name && isset($rule['row_limit']))   // for table row limit
                        {
                            $q->limit($rule['row_limit']);
                        }

                        if (isset($rule['table_name']) && $rule['table_name'] == $table_name && isset($rule['order_by']) && isset($rule['order_type']))   // for table order by
                        {
                            $q->orderBy($rule['order_by'], $rule['order_type']);
                        }
                    }
                })
                ->get();

            if ($data->count() > 0) {
                fwrite($file, PHP_EOL . PHP_EOL . '-- ==================Table: ' . $table_name . '================== ' . PHP_EOL . PHP_EOL);

                foreach ($data as $row) {
                    $insert = "INSERT INTO `$table_name` (";
                    $values = "VALUES (";

                    foreach ($row as $column => $value) {
                        $insert .= "`$column`, ";
                        $values .= "'" . addslashes($value) . "', ";
                    }

                    $insert = rtrim($insert, ', ') . ")";
                    $values = rtrim($values, ', ') . ");\n";

                    fwrite($file, $insert . " " . $values);
                }
            }
        }
        fclose($file); // close the file

        $zip_file_full_url = substr($file_full_url, 0, -3) . 'zip'; // zip full url
        $zip_file_name = substr($file_name, 0, -3) . 'zip'; // zip file name
        $zip = new ZipArchive();
        $zip->open($zip_file_full_url, ZipArchive::CREATE); // open the zip archive
        $zip->addFile($file_full_url, $file_name); // add file to zip archive
        $zip->close(); // close the file

        File::delete($file_full_url);  // after zip delete the sql file

        return Response::download($zip_file_full_url, $zip_file_name, [ // download the zip file
            'Content-Type' => 'application/zip',
        ]);
    }
}
