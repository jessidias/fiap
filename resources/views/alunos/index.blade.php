<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lista de Alunos') }}
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
                    <form action="{{ route('alunos.index') }}" method="GET" class="mb-4">
                        <input type="text" name="search" value="{{ old('search', $query) }}" placeholder="Buscar por nome" class="border border-gray-300 rounded-md p-2">
                        <x-primary-button>{{ __('Buscar') }}</x-primary-button>
                        <a href="{{ route('alunos.index') }}" class="btn btn-secondary ml-2">Limpar</a>
                    </form>

                    <x-primary-button onclick="location.href='{{ route('alunos.create') }}'">{{ __('Cadastrar Aluno') }}</x-primary-button><br><br>

                    <table class="min-w-full bg-white border border-gray-300">
                        <thead>
                            <tr>
                                <th class="border border-gray-300 px-4 py-2">Nome</th>
                                <th class="border border-gray-300 px-4 py-2">Data de Nascimento</th>
                                <th class="border border-gray-300 px-4 py-2">Usuário</th>
                                <th class="border border-gray-300 px-4 py-2">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($alunos as $aluno)
                                <tr>
                                    <td class="border border-gray-300 px-4 py-2">{{ $aluno->nome }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $aluno->data_nascimento->format('d/m/Y') }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $aluno->usuario }}</td>
                                    <td class="border border-gray-300 px-4 py-2">
                                        <x-primary-button onclick="location.href='{{ route('alunos.edit', $aluno) }}'">{{ __('Editar') }}</x-primary-button>
                                        
                                        <form action="{{ route('alunos.destroy', $aluno) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <x-primary-button>{{ __('Excluir') }}</x-primary-button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{ $alunos->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
