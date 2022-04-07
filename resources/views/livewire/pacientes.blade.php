<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Gerir Pacientes
    </h2>
</x-slot>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
            @if (session()->has('message'))
                <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3" role="alert">
                  <div class="flex">
                    <div>
                      <p class="text-sm">{{ session('message') }}</p>
                    </div>
                  </div>
                </div>
            @endif 
            
            @if (session()->has('error'))            
                <div role="alert">
                    <div class="bg-red-500 text-white font-bold rounded-t px-4 py-2">
                        Detectado um erro!
                    </div>
                    <div class="border border-t-0 border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700">
                        <p>{{ session('error') }}</p>
                    </div>
                </div>
            @endif
            
            <button wire:click="create()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">Novo Paciente</button>
            @if($isOpen)
                @include('livewire.pacientes_create')
            @endif
            <table class="table-fixed w-full">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 w-20">No.</th>
                        <th class="px-4 py-2">Nome</th>
                        <th class="px-4 py-2">Data de Nascimento</th>
                        <th class="px-4 py-2">Sexo</th>
                        <th class="px-4 py-2">Profissao</th>
                        <th class="px-4 py-2">Endereco</th>
                        <th class="px-4 py-2">Seguro</th>
                        <th class="px-4 py-2">Contacto</th>
                        <th class="px-4 py-2">Accao</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($patientes as $paciente)
                    <tr>
                        <td class="border px-4 py-2">{{ $paciente->id }}</td>
                        <td class="border px-4 py-2">{{ $paciente->Nome }}</td>
                        <td class="border px-4 py-2">{{ $paciente->Data_de_nascimento }}</td>
                        <td class="border px-4 py-2">{{ $paciente->sexo }}</td>
                        <td class="border px-4 py-2">{{ $paciente->Profissao }}</td>
                        <td class="border px-4 py-2">{{ $paciente->Endereco }}</td>
                        <td class="border px-4 py-2">{{ $paciente->Seguro }}</td>
                        <td class="border px-4 py-2">{{ $paciente->Contacto }}</td>
                        <td class="border px-4 py-2">
                        <button wire:click="edit({{ $paciente->id }})" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Editar</button>
                            <button wire:click="delete({{ $paciente->id }})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Apagar</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $patientes->links() }}
        </div>
    </div>
</div>
