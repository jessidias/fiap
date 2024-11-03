<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lista de Matrículas') }}
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

                    <div class="mb-4">
                        <x-primary-button onclick="location.href='{{ route('matriculas.create') }}'">{{ __('Cadastrar Nova Matrícula') }}</x-primary-button>
                    </div>

                    <table class="min-w-full bg-white border border-gray-300">
                        <thead>
                            <tr>
                                <th class="border border-gray-300 px-4 py-2">Aluno</th>
                                <th class="border border-gray-300 px-4 py-2">Turma</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($matriculasAgrupadas as $nomeAluno => $matriculas)
                                <tr>
                                    <td class="border border-gray-300 px-4 py-2">{{ $nomeAluno  }}</td>
                                    <td class="border border-gray-300 px-4 py-2">
                                        @foreach ($matriculas as $matricula)
                                        <a href="{{ route('turmas.show', $matricula->turma->id) }}" class="text-blue-600 hover:text-blue-900">
                                            <i class="fa-solid fa-eye"></i> {{ $matricula->turma->nome }}
                                        </a> <x-primary-button onclick="location.href='{{ route('matriculas.edit', $matricula->id) }}'">{{ __('Editar matrícula') }}</x-primary-button><br><br>
                                        @endforeach
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
