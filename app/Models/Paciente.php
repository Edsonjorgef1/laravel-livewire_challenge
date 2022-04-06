<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;

    protected $fillable = [
        'Nome',
        'Data_de_nascimento',
        'sexo',
        'Profissao',
        'Endereco',
        'Seguro',
        'Contacto',
    ];


}
