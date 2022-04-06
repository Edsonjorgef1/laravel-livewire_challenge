<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    use HasFactory;

    protected $fillable = [
        'sector_medico',
        'data_entrada',
        'data_saida',
        // 'status',
        'observacao',
        'paciente_id',
    ];

    public function paciente(){
        return $this->belongsTo(Paciente::class);
    }
}
