<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Excel;
use App\Imports\VisitesPhImport;
//use Maatwebsite\Excel\Concerns\WithMultipleSheets;
//use Maatwebsite\Excel\Concerns\WithConditionalSheets;

class ImportExcelController extends Controller
{
    //
    public function index(){
        return view('ImportExportExcel\import_excel');
    }


    //import from excel file with sheet Liste Ph
    public function import(){
       // Excel::import(new VisitesPhImport,'C:\Users\HEALTHINNOVATION\Downloads\Rapport CASA ELOUADEH (1).xlsx');
        $import = new VisitesPhImport();
        $import->onlySheets('Liste Ph','Rapport Ph');

        Excel::import($import, 'C:\Users\HEALTHINNOVATION\Downloads\Rapport CASA ELOUADEH (1).xlsx');
    }

   
}
