<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Paciente;


class Pacientes extends Component
{

    public $pacientes;

    public function render()
    {
        $this->pacientes = Paciente::all();
        return view('livewire.pacientes');
    }

}
