<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jenis extends Model
{
    use HasFactory;

    protected $table = 'jenis';

    protected $fillable = [
        'jenis_pengaduan', 
    ];
    
    public function pelapor()
    {
        return $this->hasMany(Pelapor::class, 'jenis_id', 'id');
    }
}
