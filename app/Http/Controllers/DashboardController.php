<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $total = Report::where('user_id', $userId)->count();
        $proses = Report::where('user_id', $userId)->where('status', 'diproses')->count();
        $selesai = Report::where('user_id', $userId)->where('status', 'selesai')->count();


        $latest = Report::where('user_id', $userId)->latest()->take(3)->get();

        return view('dashboard', compact('total', 'proses', 'selesai', 'latest'));
    }
    public function updateStatus(Request $request, $id)
    {
        $report = Report::findOrFail($id);

        $report->status = $request->status;

        $report->catatan_admin = $request->catatan_admin;

        if ($request->hasFile('foto_bukti')) {

            $path = $request->file('foto_bukti')
                ->store('bukti', 'public');

            $report->foto_bukti = $path;
        }

        $report->save();

        return back()->with('success', 'Status berhasil diupdate');
    }
    public function pengguna()
    {
        $users = User::where('role', 'user')->latest()->get();

        return view('admin.pengguna', compact('users'));
    }
    public function laporanAdmin()
{
    $reports = Report::latest()->get();

    return view('admin.laporan', compact('reports'));
}
}
