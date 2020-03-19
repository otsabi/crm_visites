<?php

namespace App\Http\Controllers;

use App\Imports\FileImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports;


class FileController extends Controller
{
    public function index(){
        return view('import.index');
    }

    public function import(Request $request){
        //$var = $request->file('import_file')." Worked !";
        //echo $var;
        //return view('import.index');


            //$import = new FileImport();
            //,'Rapport Ph'
            //$import->sheets('Rapport Med');
            //$import->convert('xls');
        /*
            Excel::import($import, 'users.xlsx');
        */

            Excel::import(new FileImport, $request->file('import_file'));
            //dd($table);

            //############################################"


            /*$table = Excel::load($request->file('import_file'), function($reader) {

            })->get();

            dd($table);*/
    }
}
