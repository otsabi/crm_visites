<?php

namespace App\Imports;

use App\Specialite;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
//use Maatwebsite\Excel\Concerns\ToModel;
//use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
//use Maatwebsite\Excel\Concerns\SkipsUnknownSheets;
//use Maatwebsite\Excel\Concerns\WithConditionalSheets;
//use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
//use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;


//use Maatwebsite\Excel\Concerns\WithDates;

//, WithMultipleSheets
//, SkipsUnknownSheets
class FileImport implements ToCollection, WithMultipleSheets
{
    //use WithConditionalSheets;

    /*public function conditionalSheets(): array
    {
        return [
            'Rapport Med' => new RapportMed(),
            'Worksheet 2' => new SecondSheetImport(),
            //'Worksheet 3' => new ThirdSheetImport(),
        ];
    }*/

    public function sheets(): array
    {
        return [
            'Rapport Med' => new RapportMed(),
            'Liste Med' => new ListeMed(),
        ];
    }

    // public function onUnknownSheet($sheetName)
    // {
    //     // E.g. you can log that a sheet was not found.
    //     //info("Sheet {$sheetName} was skipped");
    //     dd("ERROR : {$sheetName} is not found !");
    // }

    /*public function chunkSize(): int
    {
        return 1000;
    }

    public function batchSize(): int
    {
        return 1000;
    }*/




    public function Collection(Collection $collection)
    {

        /*$collection->each(function ($item, $key) {
            //echo $item['nom_prenom'].'<br><br><br><br>';
            echo $key.'<br><br><br><br>';
        });*/

        //foreach ($collections->toArray() as $collection){
             //$collection->dd();
             //$collection[$key]['specialite'];
             //$collection[$key]['etablissement'];

            //dd($collection);
            //print_r(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($collection['date_de_visite'])->format('d-m-Y'));
           //echo $collection['nom_prenom'];
            /*print_r($collection['specialite']);
            print_r($collection['etablissement']);
            print_r($collection['potentiel']);
            print_r($collection['montant_inv_precedents']);
            print_r($collection['zone_ville']);
            print_r($collection['p1_presente']);
            print_r($collection['p1_feedback']);
            print_r($collection['p1_ech']);
            print_r($collection['p2_presente']);
            print_r($collection['p2_feedback']);
            print_r($collection['p2_ech']);
            print_r($collection['p3_presente']);
            print_r($collection['p3_feedback']);
            print_r($collection['p3_ech']);
            print_r($collection['p4_presente']);
            print_r($collection['p4_feedback']);
            print_r($collection['p4_ech']);
            print_r($collection['p5_presente']);
            print_r($collection['p5_feedback']);
            print_r($collection['p5_ech']);
            print_r($collection['materiel_promotion']);
            print_r($collection['invitation_promise']);
            print_r($collection['planrealise']);
            print_r($collection['visite_individuelledouble']);*/
            //echo "#############################";
       // }

         //return dd($collections->toArray());

        /*$collections->each(function ($item) {
            print_r($item);
        });*/

        /*$post = Specialite::latest('specialite_id')->first();
        dd($post->libelle);*/

    }



}
