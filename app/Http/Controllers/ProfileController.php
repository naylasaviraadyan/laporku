<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;
use App\Models\Report;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'new_password' => 'nullable|min:6'
        ]);

        // UPDATE NAMA
        $user->name = $request->name;

        // UPDATE FOTO
        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('profile', 'public');
            $user->foto = $path;
        }

        // UPDATE PASSWORD
        if ($request->filled('current_password') || $request->filled('new_password')) {

            // wajib isi dua-duanya
            $request->validate([
                'current_password' => 'required',
                'new_password' => 'required|min:6',
            ]);

            // cek password lama
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors([
                    'current_password' => 'Password lama salah'
                ]);
            }

            // update password
            $user->password = Hash::make($request->new_password);
        }

        // 🔥 INI WAJIB BANGET
        $user->save();

        return redirect()->route('profil')->with('success', 'Profil berhasil diupdate');
    }

    public function index()
    {
        $total = \App\Models\Report::where('user_id', auth()->id())->count();

        $proses = \App\Models\Report::where('user_id', auth()->id())
            ->where('status', 'diproses')
            ->count();

        $selesai = \App\Models\Report::where('user_id', auth()->id())
            ->where('status', 'selesai')
            ->count();

        return view('profil', compact(
            'total',
            'proses',
            'selesai'
        ));
    }
}
