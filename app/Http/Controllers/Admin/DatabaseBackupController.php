<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class DatabaseBackupController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:Super Admin|Admin']);
    }

    public function index()
    {
        return view('admin.backup.index');
    }

    public function runDatabaseBackup()
    {
        try {
            Artisan::queue('backup:run', ['--only-db' => true]);
            request()->session()->flash('success', 'Database backup Successfully');
            return redirect()->back();
        } catch (\Throwable $th) {
            request()->session()->flash('error', $th->getMessage());
            return redirect()->back();
        }
    }
}
