<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    protected $fillable = ["nama", "nip", "jenis_kelamin", "tanggal_lahir", "jabatan", "unit_kerja"];
    use HasFactory;
}
