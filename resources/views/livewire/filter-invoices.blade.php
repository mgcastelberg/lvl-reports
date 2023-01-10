<div>

{{-- @dump($filters) --}}

{{-- <div class="relative overflow-x-auto shadow-lg sm:rounded-lg"> --}}
<div class="p-8 mb-3 bg-white rounded shadow-sm">
    <h1 class="text-2xl font-semibold">Generar Reportes</h1>

    <div class="mb-4">
        Serie:
        <select wire:model="filters.serie" name="serie" id="serie" class="w-32 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            <option value="">Todas</option>
            <option value="F001">F001</option>
            <option value="B001">B001</option>
        </select>
    </div>

    <div class="flex mb-4 space-x-4">
        <div>
            Desde el N°:
            <x-jet-input wire:model="filters.fromNumber" type="text" class="w-32"></x-jet-input>
        </div>

        <div>
            Hasta el N°:
            <x-jet-input wire:model="filters.toNumber" type="text" class="w-32"></x-jet-input>
        </div>
    </div>

    <div class="flex mb-4 space-x-4">
        <div>
            Desde Fecha:
            <x-jet-input wire:model="filters.fromDate" type="date" class="w-32"></x-jet-input>
        </div>

        <div>
            Hasta Fecha:
            <x-jet-input wire:model="filters.toDate" type="date" class="w-32"></x-jet-input>
        </div>
    </div>

    <x-jet-button wire:click="generateReport">
        Generar Reporte
    </x-jet-button>

</div>


<div class="relative overflow-x-auto sm:rounded-lg">
    {{-- <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"> --}}
    <table class="w-full text-sm text-left text-gray-500">
        <thead class="text-xs text-gray-700 uppercase bg-gray-200">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Id
                </th>
                <th scope="col" class="px-6 py-3">
                    Serie
                </th>
                <th scope="col" class="px-6 py-3">
                    Correlativo
                </th>
                <th scope="col" class="px-6 py-3">
                    Base
                </th>
                <th scope="col" class="px-6 py-3">
                    Impuesto
                </th>
                <th scope="col" class="px-6 py-3">
                    Total
                </th>
                <th scope="col" class="px-6 py-3">
                    Fecha
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($invoices as $invoice)
                {{-- <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"> --}}
                <tr class="text-gray-600 bg-white border-b hover:bg-gray-50">
                    <td scope="row" class="px-6 py-4 font-medium whitespace-nowrap">
                        {{ $invoice->id}}
                    </td>
                    <td class="px-6 py-4">
                        {{ $invoice->serie}}
                    </td>
                    <td class="px-6 py-4">
                        {{ $invoice->correlative}}
                    </td>
                    <td class="px-6 py-4 text-right">
                        ${{ $invoice->base}}
                    </td>
                    <td class="px-6 py-4 text-center">
                        {{ $invoice->tax}}
                    </td>
                    <td class="px-6 py-4 text-right">
                        ${{ $invoice->total}}
                    </td>
                    <td class="px-6 py-4">
                        {{ $invoice->created_at->format('d-m-y')}}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

    <div class="mt-4">
        {{ $invoices->links() }}
    </div>
</div>
