<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = ['nombre', 'fecha_pago', 'fecha_vencimiento']; // Se elimina 'estado_pago' de los fillable

    public function tvboxes()
    {
        return $this->hasMany(Tvbox::class,'id');
    }

    // Se agrega el accesor para el estado de pago
    public function getEstadoPagoAttribute()
    {
        return $this->fecha_vencimiento >= now();
    }
}
