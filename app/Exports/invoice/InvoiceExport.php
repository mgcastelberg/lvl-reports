<?php

namespace App\Exports\invoice;

use Carbon\Carbon;
use App\Models\Invoice;
use Maatwebsite\Excel\Excel;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\withDrawings;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithCustomStartCell; // ancho de columnas de forma automatizada
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
// use Maatwebsite\Excel\Concerns\WithColumnWidths; //Para definir de forma personalizada el ancho de las columnas


class InvoiceExport implements FromCollection, WithCustomStartCell, Responsable, WithMapping, WithColumnFormatting, WithHeadings, ShouldAutoSize, withDrawings, WithStyles
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
        return 'A8';
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

    public function drawings(){
        $drawing = new Drawing();
        $drawing->setName('Xtreme Technology');
        $drawing->setDescription('Logo');
        $drawing->setPath(public_path('img/extreme_logo.png'));
        $drawing->setHeight(90);
        $drawing->setCoordinates('B2');
        return $drawing;
    }

    public function styles(Worksheet $sheet){
        $sheet->setTitle('Invoices');
        $sheet->mergeCells('B7:F7');
        $sheet->setCellValue('B7','Invoices Xtreme Technologies');
        $sheet->setCellValue('F6','=5+4');

        $sheet->getStyle('A7:G7')->applyFromArray([
            'font' => [
                'bold' => true,
                'name' => 'Arial',
                'size' => 16
            ]
        ]);

        $sheet->getStyle('A8:G8')->applyFromArray([
            'font' => [
                'bold' => true,
                'name' => 'Arial',
            ],
            'fill' => [
                'fillType' => 'solid',
                'startColor' => [
                    'argb' => 'C5D9F1'
                ]
            ]
        ]);
        // Aplicar stilos para otro conjunto de celdas
        $sheet->getStyle('A8:G'.$sheet->getHighestRow())->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => 'thin',
                    'color' => [
                        'argb' => '7f8c8d'
                    ]
                ]
            ]
        ]);
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
