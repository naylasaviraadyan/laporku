<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;

class ReportController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'kategori' => 'required',
            'lokasi' => 'required',
            'deskripsi' => 'required',
            'foto' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ], [
            'kategori.required' => 'Kategori wajib diisi',
            'lokasi.required' => 'Lokasi wajib diisi',
            'deskripsi.required' => 'Deskripsi wajib diisi',
            'foto.required' => 'Foto wajib diupload',
        ]);

        $path = null;

        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('laporan', 'public');
        }
        Report::create([
            'user_id' => Auth::id(),
            'kategori' => $request->kategori,
            'lokasi' => $request->lokasi,
            'deskripsi' => $request->deskripsi,
            'foto' => $path,
            'status' => 'pending',
        ]);

        return redirect()->route('dashboard')->with('success', 'Laporan berhasil dikirim');
    }
    public function index(Request $request)
    {
        $query = Report::where('user_id', Auth::id());

        if ($request->status) {
            $query->whereRaw('LOWER(status) = ?', [strtolower($request->status)]);
        }

        $reports = $query->latest()->get();

        return view('laporan.index', compact('reports'));
    }
    public function show($id)
    {
        $report = Report::where('id', $id)
            ->where('user_id', auth::id()) // biar user cuma lihat punya dia
            ->firstOrFail();

        return view('laporan.show', compact('report'));
    }
    public function status($id)
    {
        $report = Report::findOrFail($id);

        return view('laporan.status', compact('report'));
    }
    public function batal($id)
    {
        $report = Report::findOrFail($id);

        if ($report->status == 'pending') {
            $report->status = 'dibatalkan';
            $report->save();
        }

        return redirect()->back()->with('success', 'Laporan dibatalkan');
    }
    public function updateStatus(Request $request, $id, $status)
    {
        $report = Report::findOrFail($id);

        // UPDATE STATUS
        $report->status = $status;

        

        // FOTO BUKTI
        if ($request->hasFile('foto_bukti')) {

            $path = $request->file('foto_bukti')
                ->store('bukti', 'public');

            $report->foto_bukti = $path;
        }

        // CATATAN ADMIN
        $report->catatan_admin = $request->catatan_admin;

        $report->save();

        // NOTIFIKASI
        Notification::create([

            'user_id' => $report->user_id,

            'title' => match ($status) {
                'diproses' => 'Laporan Sedang Diproses',
                'selesai' => 'Laporan Selesai',
                'ditolak' => 'Laporan Ditolak',
                'dibatalkan' => 'Laporan Dibatalkan',
                default => 'Status Laporan'
            },

            'message' => match ($status) {

                'diproses' =>
                'Petugas sedang menangani laporan Anda.',

                'selesai' =>
                'Laporan Anda telah berhasil diselesaikan.',

                'ditolak' =>
                'Maaf, laporan Anda ditolak karena tidak sesuai ketentuan.',

                'dibatalkan' =>
                'Laporan dibatalkan oleh pelapor.',

                default =>
                'Status laporan diperbarui.'
            },

            'type' => $status,

            'report_id' => $report->id,

            'is_read' => false,
        ]);

        return redirect()->back()->with('success', 'Status berhasil diperbarui');
    }
    public function ratingForm($id)
    {
        $report = Report::findOrFail($id);
        return view('laporan.rating', compact('report'));
    }

    public function ratingStore(Request $request, $id)
    {
        $report = Report::findOrFail($id);

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'ulasan' => 'nullable|string'
        ]);

        $report->rating = $request->rating;
        $report->ulasan = $request->ulasan;
        $report->save();

        return redirect()->route('laporan.show', $report->id)
            ->with('success', 'Terima kasih atas penilaian Anda!');
    }
}
