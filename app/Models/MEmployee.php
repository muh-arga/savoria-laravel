<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MEmployee extends Model
{
    use HasFactory;

    protected $table = 'm_employee';
    public $timestamps = false;

    protected $fillable = [
        'nama_karyawan',
        'tanggal_lahir',
        'alamat',
        'email',
        'valid_from',
        'valid_to',
        'create_by',
        'create_date',
        'update_by',
        'update_date',
    ];

    public function family()
    {
        return $this->hasMany(MFamily::class, 'employee_id', 'id');
    }
}
