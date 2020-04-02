<?php

namespace App\Http\Controllers;

use App\Imports\FileImport;
use Illuminate\Http\Request;
//use Maatwebsite\Excel\Facades\Excel;
use Rap2hpoutre\FastExcel\FastExcel;
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
            //$import->sheets('Liste Med','Rapport Med');
            //$import->onlySheets('Liste Med', 'Rapport Med');
            //$import->convert('xls');
        /*
            Excel::import($import, 'users.xlsx');
        */
            set_time_limit(500);
            $files = $request->file('import_file');

            if($request->hasFile('import_file'))
            {
                foreach ($files as $file) {
                    //THIS FIRST IS FOR LARAVEL-EXCEL PACKAGE
                    //Excel::import(new FileImport, $file);
                    (new FastExcel)->sheet(3)->import($file, function ($line) {
                        // return User::create([
                        //     'name' => $line['Name'],
                        //     'email' => $line['Email']
                        // ]);
                       dd($line["Date de visite"]->format('d-m-Y'));
                            //$line["Date de visite"]->format('d-m-Y')
                            //$line["Plan/Réalisé"]

                            //$line["Nom Prenom"]
                            //$line["Specialité"]
                            //$line["Etablissement"]
                            //$line["Potentiel"]
                            //$line["Montant Inv Précédents"]
                            //$line["Zone-Ville"]
                            
                            //$line["P1 présenté"]
                            //$line["P1 Feedback"]
                            //$line["P1 Ech"]

                            //$line["P2 présenté"]
                            //$line["P2 Feedback"]
                            //$line["P2 Ech"]

                            //$line["P3 présenté"]
                            //$line["P3 Feedback"]
                            //$line["P3 Ech"]

                            //$line["P4 présenté"]
                            //$line["P4 Feedback"]
                            //$line["P4 Ech"]

                            //$line["P5 présenté"]
                            //$line["P5 Feedback"]
                            //$line["P5 Ech"]

                            //$line["Materiel Promotion"]
                            //$line["Invitation promise"]
                            
                          

                    });
                    
                }
            }


        


            //dd($table);

            //############################################"


            /*$table = Excel::load($request->file('import_file'), function($reader) {

            })->get();

            dd($table);*/
    }
}
