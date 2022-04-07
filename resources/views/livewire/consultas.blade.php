<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Gerir Consultas
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

                {{-- <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">Detectado erro!</strong>
                    <span class="block sm:inline">{{ session('error') }}</span>
                    <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                      <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                    </span>
                </div> --}}
            @endif
            
            <button wire:click="create()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">Nova Consulta</button>
            @if($isOpen)
                @include('livewire.consultas_create')
            @endif
            <table class="table-fixed w-full">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 w-20">No.</th>
                        <th class="px-4 py-2">Departamento</th>
                        <th class="px-4 py-2">Data de Entrada</th>
                        <th class="px-4 py-2">Observacao</th>
                        <th class="px-4 py-2">Paciente</th>
                        <th class="px-4 py-2">Accao</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($agendamentos as $consulta)
                    <tr>
                        <td class="border px-4 py-2">{{ $consulta->id }}</td>
                        <td class="border px-4 py-2">{{ $consulta->sector_medico }}</td>
                        <td class="border px-4 py-2">{{ $consulta->data_entrada }}</td>
                        <td class="border px-4 py-2">{{ $consulta->observacao }}</td>
                        <td class="border px-4 py-2">{{ $consulta->paciente->Nome }}</td>
                        <td class="border px-4 py-2">
                        <button wire:click="edit({{ $consulta->id }})" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Editar</button>
                            <button wire:click="delete({{ $consulta->id }})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Apagar</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $agendamentos->links() }}
        </div>
    </div>
</div>
