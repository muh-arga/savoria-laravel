<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MFamily extends Model
{
    use HasFactory;

    protected $table = 'm_family';
    public $timestamps = false;

    protected $fillable = [
        'employee_id',
        'hubungan_keluarga',
        'nama_anggota_keluarga',
        'tanggal_lahir_anggota_keluarga',
    ];

    public function employee()
    {
        return $this->belongsTo(MEmployee::class, 'employee_id', 'id');
    }
}
