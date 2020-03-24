<?php

namespace App\Imports;

use App\Medecin;
use App\Imports\Functions;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;



//use Maatwebsite\Excel\Concerns\WithDates;

//, WithMultipleSheets
//, SkipsUnknownSheets
class ListeMed implements ToCollection, WithHeadingRow, WithCalculatedFormulas
{

    public function Collection(Collection $collection)
    {

        // //******************  BEGIN MEDECIN NAME  ******************
        //     //SELECT ALL MEDECIN NAME FROM DB
        //     $medecins_db = Medecin::select(
        //         DB::raw('UPPER(CONCAT(nom," ",prenom)) as nom_prenom')
        //     )
        //     ->pluck('nom_prenom');
        // //******************  END MEDECIN NAME  ******************
    
        // //******************  BEGIN FILTER MEDECIN NAME  ******************
        //     //DELETE ANY SPACE ON THE END OF [ nom prenom ] USING RTRIM FUNCTION
        //     //FILTER JUST MEDECIN NAME WHITCH DOES NOT ...
        //     //... EXISTS ON DB FROM EXCEL FILE
        //     //IGNORE COLUMN [ nom prenom ] IF IT HAS NULL VALUE
        //     $medecins_excel = $collection->map(function ($item) {
        //         $item['nom'] = mb_strtoupper(rtrim($item['nom']));
        //         $item['prenom'] = mb_strtoupper(rtrim($item['prenom']));
        //         $item['nom_prenom'] = $item['nom'].' '.$item['prenom'];
        //     });
       
        //     $medecins_excel = $collection->whereNotIn('nom_prenom', $medecins_db)
        //                                  ->whereNotIn('nom_prenom', " ");
        // //******************  END FILTER MEDECIN NAME  ******************


        // if (!$medecins_excel->isEmpty()) {
            
        //     //ADD MEDECIN, IF THERE ID ANY NEW MEDECIN DOES NOT EXISTS ON DB
        //     $medecins_excel->each(function ($item) {

        //         //******************  CHANGE IT INTO INFO OF AUTH USER [AFTER]  ******************
        //             $ID_USER = 2;
        //             $created_by="EL MEHDI AIT FAKIR";
        //         //******************  END  ******************


        //         //******************  BEGIN INFO OF MEDECIN  ******************
        //             $nom = mb_strtoupper($item['nom']);
        //             $prenom = mb_strtoupper($item['prenom']);
        //             $adresse = $item['adresse'];
        //             $tel = $item['tel'];
        //             $etablissement = mb_strtoupper($item["etablissement"]);
        //             $potentiel = $item['potentiel'];        
        //             $zone = mb_strtoupper($item["zone_sous_secteur"]);
        //         //******************  END INFO OF MEDECIN ******************
            
        //         //******************  BEGIN RETURN ID OF VILLE  ******************
        //             $ville_id = Functions::search_ville(mb_strtoupper($item["ville"]));
        //         //******************  END RETURN ID OF VILLE  ******************
            
        //         //******************  BEGIN RETURN ID OF SPECIALISTE  ******************
        //             $specialite_id = Functions::search_specialite(mb_strtoupper($item["specialite"]));
        //         //******************  END RETURN ID OF SPECIALISTE  ******************
            

        //     Functions::create_medecin($nom, $prenom, $adresse, $tel, $etablissement, $potentiel, $zone, $ville_id, $ID_USER, $specialite_id, $created_by);
    
        //     });

        // }else{
        //     var_dump("THERE IS ANY MEDECIN TO ADD !");
        // }

        // echo "<br> ############# ListeMed ############# <br>";
        // var_dump($collection);
        // echo "<br> ########################## <br>";

    }

}
