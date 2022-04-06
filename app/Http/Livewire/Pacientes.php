<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Paciente;

class Pacientes extends Component
{
    public function render()
    {
        return view('livewire.pacientes');
    }
    
}
