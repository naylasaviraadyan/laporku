<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;

class AdminController extends Controller
{
    public function index()
    {
        $reports = Report::latest()->get();
        $avgRating = Report::whereNotNull('rating')->avg('rating');
        $avgRating = round($avgRating ?? 0, 1);

        $total = Report::count();
        $pending = Report::where('status', 'pending')->count();
        $diproses = Report::where('status', 'diproses')->count();
        $selesai = Report::where('status', 'selesai')->count();
        $ditolak = Report::where('status', 'ditolak')->count();
        $performance = $total > 0
            ? round(($selesai / $total) * 100)
            : 0;

        return view('admin.dashboard', compact(
            'reports',
            'total',
            'pending',
            'diproses',
            'selesai',
            'ditolak',
            'avgRating',
            'performance'
        ));
    }

    public function updateStatus(Request $request, $id)
    {
        $report = Report::findOrFail($id);

        $report->update([
            'status' => $request->status
        ]);

        if ($request->status == 'pending') {
            $title = 'Laporan Menunggu';
            $message = 'Laporan Anda sedang menunggu verifikasi petugas.';
        } elseif ($request->status == 'diproses') {
            $title = 'Laporan Sedang Diproses';
            $message = 'Petugas sedang menangani laporan Anda.';
        } elseif ($request->status == 'selesai') {
            $title = 'Laporan Selesai';
            $message = 'Laporan Anda telah berhasil diselesaikan.';
        } elseif ($request->status == 'ditolak') {
            $title = 'Laporan Ditolak';
            $message = 'Maaf, laporan Anda ditolak karena tidak sesuai ketentuan.';
        }

        Notification::create([
            'user_id' => $report->user_id,
            'title' => $title,
            'message' => $message,
        ]);

        return back();
    }
    public function show($id)
    {
        $report = Report::with('user')->findOrFail($id);

        return view('admin.detail', compact('report'));
    }
}
