<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Paciente;


class Pacientes extends Component
{

    public $pacientes;
    public $isOpen = 0; // Check if Modal is opened

    public function render()
    {
        $this->pacientes = Paciente::all();
        return view('livewire.pacientes');
    }

    // public function openModal($id)
    // {
    //     $this->isOpen = $id;
    // }

    // public function closeModal()
    // {
    //     $this->isOpen = 0;
    // }

    // public function updatePaciente($id)
    // {
    //     $paciente = Paciente::find($id);
    //     $paciente->update([
    //         'nome' => $this->nome,
    //         'data_nascimento' => $this->data_nascimento,
    //         'sexo' => $this->sexo,
    //         'telefone' => $this->telefone,
    //         'email' => $this->email,
    //         'endereco' => $this->endereco,
    //         'bairro' => $this->bairro,
    //         'cidade' => $this->cidade,
    //         'estado' => $this->estado,
    //         'cep' => $this->cep,
    //         'cpf' => $this->cpf,
    //         'rg' => $this->rg,
    //         'nome_mae' => $this->nome_mae,
    //         'nome_pai' => $this->nome_pai,
    //         'nome_conjugue' => $this->nome_conjugue,
    //         'nome_responsavel' => $this->nome_responsavel,
    //         'telefone_responsavel' => $this->telefone_responsavel,
    //         'email_responsavel' => $this->email_responsavel,
    //         'endereco_responsavel' => $this->endereco_responsavel,
    //         'bairro_responsavel' => $this->bairro_responsavel,
    //         'cidade_responsavel' => $this->cidade_responsavel,
    //         'estado_responsavel' => $this->estado_responsavel,
    //         'cep_responsavel' => $this->cep_responsavel,
    //         'cpf_responsavel' => $this->cpf_responsavel,
    //         'rg_responsavel' => $this->rg_responsavel,
    //         'nome_mae_responsavel' => $this->nome_mae_respons
    //     ]);
    //     $this->closeModal();
    // }

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
        $this->sexo  = '';
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
            'sexo' => $this->sexo,
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
        $this->sexo  = $paciente->sexo;
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
        // Paciente::find($id)->delete();
        $paciente = Paciente::find($id);
        $paciente->delete();
        $this->closeModal();
        session()->flash('message', 'Paciente deletado com sucesso.');
    }

}
