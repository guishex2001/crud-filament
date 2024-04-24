<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Tvbox extends Model
{
    protected $fillable = ['client_id', 'codigo'];

    protected $casts = [
        'fecha_vencimiento' => 'datetime',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class,'client_id');
    }

    public function getEstadoPagoAttribute()
    {
        // Suponiendo que 'fecha_vencimiento' es una instancia de Carbon o se puede castear a una
        $hoy = Carbon::now();

        // Si 'fecha_vencimiento' es igual o posterior a hoy, entonces se considera pagado
        if ($this->fecha_vencimiento >= $hoy) {
            return true; // Pagado
        } else {
            return false; // No Pagado
        }
    }
}
