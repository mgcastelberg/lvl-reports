<?php

namespace App\Http\Livewire;

use App\Models\Invoice;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\invoice\InvoiceExport;

class FilterInvoices extends Component
{
    use WithPagination;

    public $filters = [
        'serie' => "",
        'fromNumber' => "",
        'toNumber' => "",
        'fromDate' => "",
        'toDate' => ""
    ];

    public function generateReport(){
        // return Excel::download(new InvoiceExport(),'invoices.xlsx');
        // return Excel::download(new InvoiceExport(),'invoices.csv', \Maatwebsite\Excel\Excel::CSV);
        // return (new InvoiceExport())->download(); //sin la implementacion Responsable
        // return new InvoiceExport(); //con la implementacion Responsable
        return new InvoiceExport($this->filters); //como es un metodo se pasan los filtros al constructor
    }

    public function render()
    {
        $invoices = Invoice::filters($this->filters)->paginate(10);
        return view('livewire.filter-invoices',compact('invoices'));
    }
}
