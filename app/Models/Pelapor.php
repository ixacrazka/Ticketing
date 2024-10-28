<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelapor extends Model
{
    use HasFactory;

    protected $table = 'pelapors';

    protected $fillable = [
        'npelapor',
        'email',
        'nohp',
        'instansi_id'
    ];

    public function instansi()
    {
        return $this->belongsTo(Instansi::class, 'instansi_id', 'kode'); // Foreign key adalah 'instansi_id', primary key pada tabel instansi adalah 'kode'
    }

    public function pengaduan()
    {
        return $this->hasOne(Pengaduan::class, 'pelapor_id', 'id');
    }
    public function jenis()
    {
        return $this->belongsTo(Jenis::class, 'jenis_id', 'id');
    }
    // Pada model Pengaduan
    public function status()
    {
        return $this->belongsTo(Status::class);
    }

}
