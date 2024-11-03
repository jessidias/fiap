<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Turma') }}
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
                    <form action="{{ route('turmas.update', $turma->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="nome" class="block text-sm font-medium text-gray-700">Nome</label>
                            <input type="text" name="nome" id="nome" value="{{ old('nome', $turma->nome) }}" required class="mt-1 block w-full border border-gray-300 rounded-md p-2">
                        </div>

                        <div class="mb-4">
                            <label for="descricao" class="block text-sm font-medium text-gray-700">Descrição</label>
                            <textarea name="descricao" id="descricao" required class="mt-1 block w-full border border-gray-300 rounded-md p-2">{{ old('descricao', $turma->descricao) }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label for="tipo" class="block text-sm font-medium text-gray-700">Tipo</label>
                            <select name="tipo" id="tipo" required class="mt-1 block w-full border border-gray-300 rounded-md p-2">
                                <option value="" disabled {{ old('tipo', $turma->tipo) ? '' : 'selected' }}>Selecione o tipo</option>
                                <option value="Presencial" {{ old('tipo', $turma->tipo) == 'Presencial' ? 'selected' : '' }}>Presencial</option>
                                <option value="EAD" {{ old('tipo', $turma->tipo) == 'EAD' ? 'selected' : '' }}>EAD</option>
                            </select>
                        </div>

                        <x-primary-button>{{ __('Salvar') }}</x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
