<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAgenRequest;
use App\Models\Agen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AgenController extends Controller
{
    /**
     * Tampilkan halaman form pendaftaran agen
     */
    public function create()
    {
        return view('agen.daftar');
    }

    /**
     * Proses submit pendaftaran agen
     */
    public function store(StoreAgenRequest $request)
    {
        $data = $request->validated();

        // Upload file KTP
        if ($request->hasFile('file_ktp')) {
            $data['file_ktp'] = $request->file('file_ktp')
                ->store('agen/ktp', 'public');
        }

        // Upload file SIUP
        if ($request->hasFile('file_siup')) {
            $data['file_siup'] = $request->file('file_siup')
                ->store('agen/siup', 'public');
        }

        // Upload foto kantor
        if ($request->hasFile('file_foto_kantor')) {
            $data['file_foto_kantor'] = $request->file('file_foto_kantor')
                ->store('agen/foto', 'public');
        }

        // Upload logo
        if ($request->hasFile('file_logo')) {
            $data['file_logo'] = $request->file('file_logo')
                ->store('agen/logo', 'public');
        }

        // Hash password
        $data['password'] = Hash::make($data['password']);

        // Hapus field yang tidak ada di kolom DB
        unset($data['password_confirmation'], $data['setuju_tnc']);

        // Simpan ke database
        $agen = Agen::create($data);

        // Redirect ke halaman sukses
        return redirect()
            ->route('agen.daftar.sukses', $agen->id)
            ->with('success', 'Pendaftaran berhasil dikirim! Tim kami akan menghubungimu dalam 1–3 hari kerja.');
    }

    /**
     * Halaman konfirmasi sukses
     */
    public function sukses($id)
    {
        $agen = Agen::findOrFail($id);
        return view('agen.sukses', compact('agen'));
    }
}