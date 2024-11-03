<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Painel Administrativo') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __('Seja bem-vindo(a), ') . Auth::user()->name . __('!') }}
                    <br><br>
                    <x-primary-button onclick="location.href='{{ route('alunos.index') }}'">{{ __('Alunos') }}</x-primary-button>
                    <x-primary-button onclick="location.href='{{ route('turmas.index') }}'">{{ __('Turmas') }}</x-primary-button>
                    <x-primary-button onclick="location.href='{{ route('matriculas.index') }}'">{{ __('Matrículas') }}</x-primary-button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
