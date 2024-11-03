<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Matrícula') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if ($errors->any())
                        <div class="mb-4">
                            <ul class="text-red-600">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <x-back-button />
                    <form action="{{ route('matriculas.update', $matricula->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-4">
                            <label for="aluno_id" class="block text-sm font-medium text-gray-700">Aluno</label>
                            <select name="aluno_id" id="aluno_id" disabled class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                @foreach ($alunos as $aluno)
                                    <option value="{{ $aluno->id }}" {{ $aluno->id == $matricula->aluno_id ? 'selected' : '' }}>
                                        {{ $aluno->nome }}
                                    </option>
                                @endforeach
                            </select>
                            <input type="hidden" name="aluno_id" value="{{ $matricula->aluno_id }}">
                        </div>

                        <div class="mb-4">
                            <label for="turma_id" class="block text-sm font-medium text-gray-700">Turma</label>
                            <select name="turma_id" id="turma_id" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                @foreach ($turmas as $turma)
                                    <option value="{{ $turma->id }}" {{ $turma->id == $matricula->turma_id ? 'selected' : '' }}>
                                        {{ $turma->nome }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <x-primary-button>{{ __('Salvar') }}</x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
