<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTransaksi extends Model
{
    use HasFactory;
    public $guarded = ['id'];

    public function jenis_sampah()
    {
        return $this->belongsTo(JenisSampah::class, 'id_jenis_sampah', 'id');
    }
}
