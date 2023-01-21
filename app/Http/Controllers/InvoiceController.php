<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Imports\InvoiceImport;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class InvoiceController extends Controller
{
    public function export(){
        return view('invoices.export');
    }

    public function import(){
        return view('invoices.import');
    }

    public function importStore(Request $request) {

        // return Carbon::instance(Date::excelToDateTimeObject($request->date));
        // return Carbon::createFromFormat('d/m/Y',"08/10/2021");

        $request->validate([
            'file' => 'required|mimes:csv,xlsx'
        ]);
        $file = $request->file('file');

        // return Excel::toCollection(new InvoiceImport, $file); //para visualizar como lo esta leyendo
        Excel::import(new InvoiceImport, $file); // Para que lo importe

        return "Se importa el archivo";
        // return "se llego con exito a la prueba";
    }

    public function importCsv(){
        return Excel::toCollection(new InvoiceImport, 'csv/InvoiceImportFechaString.csv');
    }
}
