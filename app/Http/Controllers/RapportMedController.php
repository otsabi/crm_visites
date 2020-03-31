<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Rap2hpoutre\FastExcel\FastExcel;
use App\RapportMed;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class RapportMedController extends Controller
{
    public function index(){
        return view('import.index');
    }

    public function import(Request $request){
                set_time_limit(500);
                        $files = $request->file('import_file');

                        if($request->hasFile('import_file'))
                        {
                            foreach ($files as $file) {
                                //THIS FIRST IS FOR LARAVEL-EXCEL PACKAGE
                                //Excel::import(new FileImport, $file);
                                (new FastExcel)->sheet(3)->import($file, function ($line) {
                                     return RapportMed::create([
                                        
                                    'Date_de_visite' => Date::excelToDateTimeObject($line["Date de visite"])->format('Y-m-d H:i:s'),
                                    'Nom_Prenom' => $line["Nom Prenom"],
                                    'Specialité' => $line["Specialité"],
                                    'Etablissement' => $line["Etablissement"],
                                    'Potentiel' => $line["Potentiel"],
                                    'Montant_Inv_Précédents' => $line["Montant Inv Précédents"],
                                    'Zone_Ville' => $line["Zone-Ville"],

                                    'P1_présenté' => $line["P1 présenté"],
                                    'P1_Feedback' => $line["P1 Feedback"],
                                    'P1_Ech' => $line["P1 Ech"],

                                    'P2_présenté' =>$line["P2 présenté"],
                                    'P2_Feedback' => $line["P2 Feedback"],
                                    'P2_Ech' => $line["P2 Ech"],

                                    'P3_présenté' => $line["P3 présenté"],
                                    'P3_Feedback' => $line["P3 Feedback"],
                                    'P3_Ech' => $line["P3 Ech"],

                                    'P4_présenté' => $line["P4 présenté"],
                                    'P4_Feedback' => $line["P4 Feedback"],
                                    'P4_Ech' => $line["P4 Ech"],

                                    'P5_présenté' => $line["P5 présenté"],
                                    'P5_Feedback' => $line["P5 Feedback"],
                                    'P5_Ech' => $line["P5 Ech"],

                                    'Materiel_Promotion' => $line["Materiel Promotion"],
                                    'Invitation_promise' => $line["Invitation promise"],
                                    'Plan/Réalisé' => $line["Plan/Réalisé"],
                                    //'Visite_Individuelle/Double' => $line['Name'],
                                    'DELEGUE' => "EL MEHDI AIT FAKIR",
                                    'DELEGUE_id' => 1
       
                                    ]);

                                    //dd($line);

                                    //  $date = DateTime::createFromFormat('j-M-Y', $line["Date de visite"]);
                                    //  echo $date->format('Y-m-d');
                                     //var_dump(Date::excelToDateTimeObject($line["Date de visite"])->format('Y-m-d'));
                                     
                                     //$date = $line["Date de visite"];

                                     //var_dump($date->date);
                                     //print_r($date);
                                        //echo $date["date"];
                                });
                                
                            }
                        }

                    }
}
