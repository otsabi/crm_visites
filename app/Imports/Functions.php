<?php

namespace App\Imports;

use App\Feedback;
use App\Medecin;
use App\Produit;
use App\VisiteMedical;
use App\VmedProduit;
use Illuminate\Support\Facades\DB;
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
class Functions
{
    static public function search_medecin_id($value){
        /*
         * 1- catche ID of product
         * 2- insert product into table visite_med_produit
         */
        $medecin = Medecin::select(
            DB::raw('UPPER(CONCAT(nom," ",prenom)) as nom_prenom, medecin_id')
        )
         ->pluck('medecin_id', 'nom_prenom');

        $medecin = $medecin->get(strtoupper($value));

        if (!empty($medecin)){
            return $medecin;
        }

    }

    static public function create_visite($user_id, $medecin_id, $etat, $date_visite, $created_by){
        /*
         * 1- insert new visite
         * 2- return last id of visite
         */

            $new_visite = new VisiteMedical();
            $new_visite->user_id=$user_id;
            $new_visite->medecin_id=$medecin_id;
            $new_visite->etat=$etat;
            $new_visite->date_visite=$date_visite;
            $new_visite->created_by=$created_by;
            $new_visite->save();

            if ($new_visite){
                return $new_visite->visitemed_id;
            }

    }

    static public function search_product_id($code_produit){
        /*
         * 1- catche ID of product
         * 2- insert product into table visite_med_produit
         */
        $produit = Produit::where("code_produit",$code_produit)->first();
        if ($produit){
            return $produit->produit_id;
        }
    }

    static public function create_feedback($feedback){
        /*
         * 1- insert new Feedback
         * 2- return last id of Feedback
         */

        $new_feedback = new Feedback();
        $new_feedback->libelle = $feedback;
        $new_feedback->save();

        if ($new_feedback){
            return $new_feedback->feedback_id;
        }

    }

    static public function create_visite_med_product($visite_id, $produit_id, $feedback_id , $nbr_ech){
        /*
         * 1- catche ID of product,feedback,number_ech
         * 2- insert into table visite_med_produit
         */
        $new_visite_produit = new VmedProduit();
        $new_visite_produit->visitemed_id=$visite_id;
        $new_visite_produit->produit_id=$produit_id;
        $new_visite_produit->feedback_id=$feedback_id;
        $new_visite_produit->nbr_ech=$nbr_ech;
        $new_visite_produit->save();
    }

}
