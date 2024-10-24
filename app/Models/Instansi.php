<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Instansi extends Model
{
    protected $table = 'instansi';
    protected $primaryKey = 'kode';
    protected $keyType = 'string';
    protected $fillable = [
        'nama_instansi',
    ];

    public function pelapor()
    {
        return $this->hasMany(Pelapor::class, 'instansi_id', 'kode');
    }
}
