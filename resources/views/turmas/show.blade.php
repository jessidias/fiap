<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Alunos matrículados na turma: {{ $turma->nome }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if ($alunos->isEmpty())
                        <p>Não há alunos matriculados nesta turma.</p>
                    @else
                        <table class="min-w-full bg-white border border-gray-300">
                            <thead>
                                <tr>
                                    <th class="border border-gray-300 px-4 py-2">Aluno(s)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($alunos as $matricula)
                                    <tr>
                                        <td class="border border-gray-300 px-4 py-2">{{ $matricula->aluno->nome }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                    <x-back-button />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
