<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Import Invoice') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden sm:rounded-lg">

                <form action="{{ route('invoices.importStore') }}" method="POST" enctype="multipart/form-data" class="p-8 bg-white rounded shadow">
                    @csrf
                    <div class="">
                        <x-jet-validation-errors></x-jet-validation-errors>
                        <h1 class="mb-4 text-2xl font-semibold ">Por favor seleccione el archivo que quiere importar</h1>
                        <input type="file" name="file" accept=".csv, .xlsx">
                    </div>
                    <x-jet-button class="mt-4">
                        Importar Archivo
                    </x-jet-button>
                </form>

            </div>
        </div>
    </div>

</x-app-layout>
