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
            {{-- @else
            <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3" role="alert">
                <div class="flex">
                  <div>
                    <p class="text-sm">{{ session('error') }}</p>
                  </div>
                </div>
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
