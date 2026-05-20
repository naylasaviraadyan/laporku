<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;


class NotifikasiController extends Controller
{
    public function index()
    {
        $notifications = Notification::where('user_id', Auth::id())
            ->latest()
            ->get();
        foreach ($notifications as $notif) {
            $notif->update(['is_read' => true]);
        }

        return view('notifikasi', compact('notifications'));
    }
    public function show($id)
    {
        $notif = Notification::findOrFail($id);

        // tandai sudah dibaca
        $notif->update([
            'is_read' => true
        ]);

        // redirect ke detail laporan
        return redirect()->route('laporan.show', [
            'id' => $notif->report_id
        ]);
    }
}
