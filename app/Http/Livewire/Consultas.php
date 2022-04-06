<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Consulta;
use App\Models\Paciente;

class Consultas extends Component
{
    public $isOpen = 0; // Check if Modal is opened
    public $consulta_id,$sector_medico,$data_saida,$horario_entrada,$status,$observacao,$paciente_id;

    public function render()
    {
        $this->consultas = Consulta::get();
        $this->pacientes = Paciente::get();
        return view('livewire.consultas');
    }

    public function mount()
    {
        $this->consultas = Consulta::get();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function openModal()
    {
        $this->isOpen = true;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function closeModal()
    {
        $this->isOpen = false;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    private function resetInputFields(){
        // Resetar o formulario (todos campos)
        $this->sector_medico = '';
        $this->data_entrada  = '';
        $this->data_saida  = '';
        // $this->horario_entrada  = '';
        $this->status  = '';
        $this->observacao  = '';
        $this->paciente_id = '';

    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function store()
    {
        $this->validate([
            'data_entrada' => 'required',
            // 'horario_entrada' => 'required',
        ]);

            Consulta::updateOrCreate(['id' => $this->consulta_id], 
            [
                'sector_medico' => $this->sector_medico,
                'data_entrada'  => $this->data_entrada,
                'data_saida'  => $this->data_saida,
                // 'horario_entrada'  => $this->horario_entrada,
                'status'  => $this->status,
                'observacao'  => $this->observacao,
                'paciente_id'  => $this->paciente_id,
            ]);

        session()->flash('message',
            $this->consulta_id ? 'Consulta actualizada com sucesso.' : 'Consulta criada com sucesso.');

        $this->closeModal();
        $this->resetInputFields();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function edit($id)
    {
        $consulta = Consulta::findOrFail($id);

        $this->consulta_id = $id;
        $this->sector_medico = $consulta->sector_medico;
        $this->data_entrada = $consulta->data_entrada;
        $this->data_saida  = $consulta->data_saida;
        $this->status  = $consulta->status;
        $this->observacao  = $consulta->observacao;
        $this->horario_entrada  = $consulta->horario_entrada;
        $this->paciente_id = $consulta->paciente_id;

        $this->openModal();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function delete($id)
    {
        Consulta::find($id)->delete();
        $this->closeModal();
        session()->flash('message', 'Consulta deletada com sucesso.');
    }
}
