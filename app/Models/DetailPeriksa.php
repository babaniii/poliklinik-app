<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailPeriksa extends Model
{
    protected $table = 'detail_periksa';

    protected $fillable = [
        'id_periksa',
        'id_pasien',
        'id_obat',
        'jumlah'
    ];

    public function obat()
    {
        return $this->belongsTo(Obat::class, 'id_obat');
    }

    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'id_pasien');
    }
public function periksa()
{
    return $this->belongsTo(Periksa::class, 'id_periksa');
}

}

