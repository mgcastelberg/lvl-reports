<?php

namespace App\Exports\invoice;

use App\Models\Invoice;
use Maatwebsite\Excel\Excel;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;

class InvoiceExport implements FromCollection, WithCustomStartCell, Responsable
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
}
