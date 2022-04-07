<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Paciente;


class Pacientes extends Component
{
    use WithPagination;

    public $pacientes, $Nome, $Data_de_nascimento, $Sexo, $Profissao, $Endereco, $Seguro, $Contacto, $paciente_id;
    public $isOpen = 0; // Check if Modal is opened

    public function render()
    {
        return view('livewire.pacientes', [
            'patientes' => Paciente::orderBy('id', 'desc')->paginate(4),
        ]);

    }

    public function mount()
    {
        $this->pacientes = Paciente::all();
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
        $this->Nome = '';
        $this->Data_de_nascimento  = '';
        $this->Sexo  = '';
        $this->Profissao  = '';
        $this->Endereco  = '';
        $this->Seguro  = '';
        $this->Contacto  = '';
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function store()
    {
        $this->validate([
            'Nome' => 'required',
            'Contacto' => 'required',
        ]);

            Paciente::updateOrCreate(['id' => $this->paciente_id], [
                'Nome' => $this->Nome,
                'Data_de_nascimento' => $this->Data_de_nascimento,
                'Sexo' => $this->Sexo,
                'Profissao' => $this->Profissao,
                'Endereco' => $this->Endereco,
                'Seguro' => $this->Seguro,
                'Contacto' => $this->Contacto,
            ]);

        session()->flash('message',
            $this->paciente_id ? 'Paciente actualizado com sucesso.' : 'Paciente criado com sucesso.');

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
        $paciente = Paciente::findOrFail($id);

        $this->paciente_id = $id;
        $this->Nome = $paciente->Nome;
        $this->Data_de_nascimento = $paciente->Data_de_nascimento;
        $this->Sexo  = $paciente->sexo;
        $this->Profissao  = $paciente->Profissao;
        $this->Endereco  = $paciente->Endereco;
        $this->Seguro  = $paciente->Seguro;
        $this->Contacto  = $paciente->Contacto;

        $this->openModal();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function delete($id)
    {
        Paciente::find($id)->delete();
        $this->closeModal();
        session()->flash('message', 'Paciente deletado com sucesso.');
    }

}
