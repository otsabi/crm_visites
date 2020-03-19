<?php

namespace App\Imports;

use App\Imports\Functions;
use App\Medecin;
use App\Produit;
use App\Specialite;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
//use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
//use Maatwebsite\Excel\Concerns\SkipsUnknownSheets;
//use Maatwebsite\Excel\Concerns\WithConditionalSheets;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
//use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Shared\Date;


//use Maatwebsite\Excel\Concerns\WithDates;

//, WithMultipleSheets
//, SkipsUnknownSheets
class RapportMed implements ToCollection, WithCalculatedFormulas, WithHeadingRow
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
            'Rapport Med' => new FileImport(),
            'Liste Med' => new FileImport(),
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
        /*
         * i will use ID USER = 2 witch is EL MEHDI ID
         * */


        $tab = $collection->whereIn('planrealise', ['Réalisé', 'Réalisé hors Plan']);

        $tab->each(function ($item) {

            //#################  CHANGE IT INTO INFO OF AUTH USER [AFTER]  #################
            $ID_USER = 2;
            $created_by="EL MEHDI AIT FAKIR";
            //#################  END  #################

            //#################  BEGIN DECLARATION  #################
            $produit_id = NULL;
            $feedback_id = NULL;
            $nbr_ech = 0;
            //#################  END DECLARATION  #################

            // BEGIN MEDCIN
            //Y-m-d

            $medecin_id = Functions::search_medecin_id($item['nom_prenom']);
            $etat = $item['planrealise'];
            $date_visite = Date::excelToDateTimeObject($item['date_de_visite'])->format('Y-m-d');
            $last_visite_id = Functions::create_visite($ID_USER, $medecin_id, $etat, $date_visite, $created_by);
            //echo 'visite : '.$last_visite_id.'<br>';
            //NJBED ID MEDCIN
            //echo $item['specialite'].'<br>';
            //echo $item['etablissement'].'<br>';
            //echo $item['potentiel'].'<br>';
            //echo $item['montant_inv_precedents'].'<br>';
            //echo $item['zone_ville'].'<br>';
            // END MEDCIN

            // #################  BEGIN PRODUIT 01  #################
            if (!empty($item['p1_presente'])){

                $produit_id = Functions::search_product_id($item['p1_presente']);
                    //echo 'Produit : '.$produit_id.'<br>';
                if(!empty($item['p1_feedback'])){

                    $feedback_id = Functions::create_feedback($item['p1_feedback']);
                    //echo 'Feedback : '.$feedback_id.'<br>';
                }
                if(!empty($item['p1_ech'])){
                    $nbr_ech = $item['p1_ech'];
                    //echo 'nbr ech : '.$nbr_ech.'<br>';
                }
                Functions::create_visite_med_product($last_visite_id, $produit_id, $feedback_id , $nbr_ech);
            }

            //echo $item;
            // #################  END PRODUIT 01  #################

            /*if (!empty($item['p2_presente'])) {
                echo $item['p2_presente'] . '<br>';
                echo $item['p2_feedback'] . '<br>';
                echo $item['p2_ech'] . '<br>';
            }

            if (!empty($item['p3_presente'])) {
                echo $item['p3_presente'] . '<br>';
                echo $item['p3_feedback'] . '<br>';
                echo $item['p3_ech'] . '<br>';
            }

            if (!empty($item['p4_presente'])) {
                echo $item['p4_presente'] . '<br>';
                echo $item['p4_feedback'] . '<br>';
                echo $item['p4_ech'] . '<br>';
            }

            if (!empty($item['p5_presente'])) {
                echo $item['p5_presente'] . '<br>';
                echo $item['p5_feedback'] . '<br>';
                echo $item['p5_ech'] . '<br>';
            }*/
            // END PRODUIT

            //echo $item['materiel_promotion'].'<br>';
            //echo $item['invitation_promise'].'<br>';

            //echo $item['visite_individuelledouble'].'<br>';

            //echo '<br><br>###################<br><br>';
            //echo $key.'<br><br><br><br>';


            //echo $last_visite_id;
        });

        /*$post = Specialite::latest('specialite_id')->first();
        dd($post->libelle);*/

    }


}
