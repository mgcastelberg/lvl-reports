<?php

namespace App\Imports;

use Carbon\Carbon;
use App\Models\Invoice;
use PhpOffice\PhpSpreadsheet\Shared\Date;
// use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\ToCollection;
// use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\WithGroupedHeadingRow;

// class InvoiceImport implements ToModel
// class InvoiceImport implements ToCollection, WithGroupedHeadingRow, WithCustomCsvSettings
class InvoiceImport implements ToCollection, WithGroupedHeadingRow
{
    /**
    * @param array $row
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    // public function model(array $row)
    // {
    //     $myDate = is_numeric($row[4]) ? Carbon::instance(Date::excelToDateTimeObject($row[4])) : Carbon::createFromFormat('d/m/Y',$row[4]);
    //     return new Invoice([
    //         'serie' => $row[0],
    //         'base' => $row[1],
    //         'tax' => $row[2],
    //         'total' => $row[2],
    //         'user_id' => 1, //dummy
    //         'created_at' => $myDate
    //     ]);
    // }

    public function collection($rows)
    {
        foreach ($rows as $row) {
            $myDate = is_numeric($row[4]) ? Carbon::instance(Date::excelToDateTimeObject($row[4])) : Carbon::createFromFormat('d/m/Y',$row[4]);
            $invoice = Invoice::create([
            'serie' => $row[0],
            'base' => $row[1],
            'tax' => $row[2],
            'total' => $row[2],
            'user_id' => 1, //dummy
            'created_at' => $myDate
            ]);
        }
    }

    // public function getCsvSettings(): array
    // {
    //     return [
    //         'input.encoding' => 'UTF-8', // ' ISO 8859-2'
    //         'delimiter' => ','
    //     ]
    // }

}
