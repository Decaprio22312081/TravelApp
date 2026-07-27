<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BankAccount;
use App\Models\PromoBanner;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PengaturanController extends Controller
{
    public function index()
    {
        $bankAccounts = BankAccount::all();
        $settings = Setting::all()->keyBy('key');
        $promoBanners = PromoBanner::all();

        return view('admin.pengaturan.index', compact('bankAccounts', 'settings', 'promoBanners'));
    }

    public function bankStore(Request $request)
    {
        $data = $request->validate([
            'nama_bank' => 'required|string|max:255',
            'nomor_rekening' => 'required|string|max:50',
            'atas_nama' => 'required|string|max:255',
            'is_aktif' => 'nullable|boolean',
        ]);

        $data['is_aktif'] = $request->boolean('is_aktif');

        BankAccount::create($data);

        return redirect()->route('admin.pengaturan.index')
            ->with('success', 'Rekening bank berhasil ditambahkan.');
    }

    public function bankUpdate(Request $request, $id)
    {
        $bank = BankAccount::findOrFail($id);

        $data = $request->validate([
            'nama_bank' => 'required|string|max:255',
            'nomor_rekening' => 'required|string|max:50',
            'atas_nama' => 'required|string|max:255',
            'is_aktif' => 'nullable|boolean',
        ]);

        $data['is_aktif'] = $request->boolean('is_aktif');

        $bank->update($data);

        return redirect()->route('admin.pengaturan.index')
            ->with('success', 'Rekening bank berhasil diperbarui.');
    }

    public function bankDestroy($id)
    {
        $bank = BankAccount::findOrFail($id);
        $bank->delete();

        return redirect()->route('admin.pengaturan.index')
            ->with('success', 'Rekening bank berhasil dihapus.');
    }

    public function settingUpdate(Request $request)
    {
        $request->validate([
            'no_telp' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'alamat' => 'nullable|string',
            'facebook' => 'nullable|string|max:255',
            'instagram' => 'nullable|string|max:255',
            'tentang_kami' => 'nullable|string',
        ]);

        $keys = ['no_telp', 'email', 'alamat', 'facebook', 'instagram', 'tentang_kami'];

        foreach ($keys as $key) {
            if ($request->filled($key)) {
                Setting::updateOrCreate(
                    ['key' => $key],
                    ['value' => $request->$key]
                );
            }
        }

        return redirect()->route('admin.pengaturan.index')
            ->with('success', 'Pengaturan berhasil diperbarui.');
    }

    public function bannerStore(Request $request)
    {
        $data = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'link' => 'nullable|string|max:255',
            'is_aktif' => 'nullable|boolean',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        $data['is_aktif'] = $request->boolean('is_aktif');

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('promo-banners', 'public');
        }

        PromoBanner::create($data);

        return redirect()->route('admin.pengaturan.index')
            ->with('success', 'Banner promosi berhasil ditambahkan.');
    }

    public function bannerUpdate(Request $request, $id)
    {
        $banner = PromoBanner::findOrFail($id);

        $data = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'link' => 'nullable|string|max:255',
            'is_aktif' => 'nullable|boolean',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        $data['is_aktif'] = $request->boolean('is_aktif');

        if ($request->hasFile('gambar')) {
            if ($banner->gambar) {
                Storage::disk('public')->delete($banner->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('promo-banners', 'public');
        }

        $banner->update($data);

        return redirect()->route('admin.pengaturan.index')
            ->with('success', 'Banner promosi berhasil diperbarui.');
    }

    public function bannerDestroy($id)
    {
        $banner = PromoBanner::findOrFail($id);

        if ($banner->gambar) {
            Storage::disk('public')->delete($banner->gambar);
        }

        $banner->delete();

        return redirect()->route('admin.pengaturan.index')
            ->with('success', 'Banner promosi berhasil dihapus.');
    }
}
