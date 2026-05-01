<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warga extends Model
{
    use HasFactory;

    protected $fillable = [
        'nik',
        'nama',
        'alamat',
        'jenis_kelamin',
        'pekerjaan',
    ];

    public function penilaians()
    {
        return $this->hasMany(Penilaian::class);
    }
}
