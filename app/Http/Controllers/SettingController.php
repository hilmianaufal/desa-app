<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SettingController extends Controller
{
    public function index()
    {
        $setting = Setting::firstOrCreate([]);

        return view('settings.index', compact('setting'));
    }

    public function update(Request $request, Setting $setting)
    {
        $data = $request->validate([
            'nama_desa' => 'nullable|string|max:255',
            'kecamatan' => 'nullable|string|max:255',
            'kabupaten' => 'nullable|string|max:255',
            'provinsi' => 'nullable|string|max:255',
            'alamat' => 'nullable|string',
            'kode_pos' => 'nullable|string|max:20',
            'telepon' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'website' => 'nullable|string|max:255',
            'nama_kepala_desa' => 'nullable|string|max:255',
            'nip_kepala_desa' => 'nullable|string|max:255',
            'logo_desa' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'ttd_kepala_desa' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
        ]);

        if (!File::exists(public_path('desa-assets/logo'))) {
            File::makeDirectory(public_path('desa-assets/logo'), 0755, true);
        }

        if (!File::exists(public_path('desa-assets/ttd'))) {
            File::makeDirectory(public_path('desa-assets/ttd'), 0755, true);
        }

        if ($request->hasFile('logo_desa')) {
            $fileName = time() . '_logo.' . $request->logo_desa->extension();
            $request->logo_desa->move(public_path('desa-assets/logo'), $fileName);

            $data['logo_desa'] = 'desa-assets/logo/' . $fileName;
        }

        if ($request->hasFile('ttd_kepala_desa')) {
            $fileName = time() . '_ttd.' . $request->ttd_kepala_desa->extension();
            $request->ttd_kepala_desa->move(public_path('desa-assets/ttd'), $fileName);

            $data['ttd_kepala_desa'] = 'desa-assets/ttd/' . $fileName;
        }

        $setting->update($data);

        return back()->with('success', 'Pengaturan desa berhasil diperbarui.');
    }
}