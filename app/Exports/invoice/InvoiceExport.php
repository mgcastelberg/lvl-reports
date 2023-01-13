<?php

namespace App\Exports\invoice;

use Carbon\Carbon;
use App\Models\Invoice;
use Maatwebsite\Excel\Excel;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize; // ancho de columnas de forma automatizada
// use Maatwebsite\Excel\Concerns\WithColumnWidths; //Para definir de forma personalizada el ancho de las columnas


class InvoiceExport implements FromCollection, WithCustomStartCell, Responsable, WithMapping, WithColumnFormatting, WithHeadings, ShouldAutoSize
{
    use Exportable;
    // private $filename = 'invoices.csv';
    // private $writerType = Excel::CSV;
    private $fileName = 'invoices.xlsx';
    private $writerType = Excel::XLSX;
    private $filters;

    public function __construct($filters){
        $this->filters = $filters;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // return Invoice::all();
        return Invoice::filters($this->filters)->get();
    }

    public function startCell(): string{
        return 'A7';
    }

    public function map($invoice): array
    {
        return [
            $invoice->serie,
            $invoice->correlative,
            $invoice->base,
            $invoice->tax,
            $invoice->total,
            $invoice->user->name,
            Date::dateTimeToExcel($invoice->created_at),
            // Carbon::parse($invoice->created_at)->format('d/m/Y')
            // Date::dateTimeToExcel(strtotime($invoice->created_at)),
            // Date::dateTimeToExcel(Carbon::parse($invoice->created_at))
            // Date::dateTimeToExcel(Carbon::createFromFormat('d-m-y', $invoice->created_at))
        ];
    }

    public function columnFormats(): array
    {
        return [
            'G' => 'dd/mm/yyyy'
        ];
    }

    public function headings(): array
    {
        return [
            'Serie',
            'Correlativo',
            'Base',
            'Impuesto',
            'Total',
            'Usuario',
            'Fecha'
        ];
    }

    // public function columnWidths(): array
    // {
    //     return [
    //         'A' => 10,
    //         'B' => 10,
    //         'C' => 10,
    //         'D' => 10,
    //         'E' => 10,
    //         'F' => 30,
    //         'G' => 15
    //     ];
    // }
}
