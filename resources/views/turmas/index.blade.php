<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lista de Turmas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if(session('success'))
                        <div class="mb-4 text-green-600">
                            {{ session('success') }}
                        </div>
                    @endif

                    <x-primary-button onclick="location.href='{{ route('turmas.create') }}'">{{ __('Cadastrar Nova Turma') }}</x-primary-button><br><br>

                    <table class="min-w-full bg-white border border-gray-300">
                        <thead>
                            <tr>
                                <th class="border border-gray-300 px-4 py-2">Nome</th>
                                <th class="border border-gray-300 px-4 py-2">Descrição</th>
                                <th class="border border-gray-300 px-4 py-2">Tipo</th>
                                <th class="border border-gray-300 px-4 py-2">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($turmas as $turma)
                                <tr>
                                    <td class="border border-gray-300 px-4 py-2">{{ substr($turma->nome, 0, 20) }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ substr($turma->descricao, 0, 50) . __('...')  }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $turma->tipo }}</td>
                                    <td class="border border-gray-300 px-4 py-2">
                                        <x-primary-button onclick="location.href='{{ route('turmas.edit', $turma->id) }}'">{{ __('Editar') }}</x-primary-button>
                                        <form action="{{ route('turmas.destroy', $turma->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <x-primary-button>{{ __('Excluir') }}</x-primary-button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{ $turmas->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
