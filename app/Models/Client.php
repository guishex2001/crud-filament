<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = ['nombre', 'fecha_pago', 'fecha_vencimiento', 'estado_pago'];

    public function tvboxes()
    {
        return $this->hasMany(Tvbox::class,'id');
    }
}
