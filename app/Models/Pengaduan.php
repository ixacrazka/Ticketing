<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    use HasFactory;

    protected $table = 'pengaduan';

    protected $fillable = [
        'pelapor_id',
        'naplikasi',
        'laporan',
        'jenis_id',
        'status_id',
        'file_foto',
        'kode',
        'keterangan',
        'created_at'
    ];

    public function pelapor()
    {
        return $this->belongsTo(Pelapor::class, 'pelapor_id', 'id');
    }
        // Relasi Pada Tabel Status
    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }
    // Relasi Pada Tabel Jenis
    public function jenis()
    {
        return $this->belongsTo(Jenis::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
