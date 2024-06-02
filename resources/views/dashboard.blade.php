<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Prestameitor') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-cover bg-center"> 
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg"> 
                <div class="p-6 text-gray-900 dark:text-gray-100 flex flex-col items-center">
                    <h3 class="text-2xl font-bold mb-4 text-center"> {{ __("Bienvenido a Prestameitor") }}</h3> 
                       <!-- Botón para ir a la vista de préstamos -->
                       <a href="{{ route('index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            {{ __('Ver Préstamos') }}
                        </a>
                    </div>
                    <img src="{{ asset('images/prestalogomidsinfondo.png') }}" alt="Logo de Prestameitor" class="mx-auto mb-4">
                </div>
        </div>
    </div>
</x-app-layout>
