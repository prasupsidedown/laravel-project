<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agen extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_agen', 'nama_pic', 'provinsi', 'kota',
        'tahun_berdiri', 'alamat', 'whatsapp', 'email_bisnis',
        'website', 'no_siup', 'deskripsi',
        'layanan', 'jumlah_armada', 'jumlah_supir',
        'harga_mulai', 'area_destinasi',
        'file_ktp', 'file_siup', 'file_foto_kantor', 'file_logo',
        'nama_bank', 'no_rekening', 'atas_nama_rekening',
        'email_login', 'password', 'no_wa_otp', 'status',
    ];

    protected $casts = [
        'layanan' => 'array',
    ];

    protected $hidden = ['password'];
}