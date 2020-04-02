<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\withHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

use App\User;
use Auth;
use DB;

class VisitesExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    //recuperer les données des visites
    public function collection()
    {
        
        //user authentifié 
        $user_id = Auth::user()->user_id;

        //recuperer les visites du delegue authetifié
        $array = DB::select("select m.nom,m.prenom,m.etablissement,m.potentiel,vismed.date_visite,s.libelle as specialite,v.libelle as ville,GROUP_CONCAT(p.libelle) as listproduits,GROUP_CONCAT(f.libelle) as feedbacks
        FROM users u 
        Left join visite_medicals vismed on u.user_id = vismed.user_id 
        Left join medecins m on vismed.medecin_id = m.medecin_id 
        Left join vmed_produits vmedp on vismed.visitemed_id = vmedp.visitemed_id 
        Left join produits p on vmedp.produit_id = p.produit_id 
        Left join specialites s on m.specialite_id = s.specialite_id 
        Left join feedbacks f on vmedp.feedback_id = f.feedback_id 
        Left join villes v on m.ville_id = v.ville_id 
        where u.user_id = ".$user_id."
        GROUP BY vismed.date_visite,m.medecin_id
        Order By vismed.date_visite ASC
        ");



        //////Get List feedbacks for each request line
        for($i=0;$i<count($array);$i++){

        //trim products
        $produits = $array[$i]->listproduits;
        $products = preg_split("/[\n\r,.;]+/", $produits, -1, PREG_SPLIT_NO_EMPTY);

        //trim feedbacks
        $allfeedbacks = $array[$i]->feedbacks;
        $feedbacks = preg_split("/[\n\r,.;]+/", $allfeedbacks, -1, PREG_SPLIT_NO_EMPTY);
        
        //put products values
        if(isset($products[0])) $produit1 = $products[0];
        if(isset($products[1])) $produit2 = $products[1];
        if(isset($products[2])) $produit3 = $products[2];
        if(isset($products[3])) $produit4 = $products[3];
        if(isset($products[4])) $produit5 = $products[4];
        //put feedbacks values
        if(isset($feedbacks[0])) $feedback1 = $feedbacks[0];
        if(isset($feedbacks[1])) $feedback2 = $feedbacks[1];
        if(isset($feedbacks[2])) $feedback3 = $feedbacks[2];
        if(isset($feedbacks[3])) $feedback4 = $feedbacks[3];
        if(isset($feedbacks[4])) $feedback5 = $feedbacks[4];

        ///fill array with products & feedbacks
        if(isset($products[0])) $array[$i]->produit1=$products[0];
        if(isset($feedbacks[0])) $array[$i]->feedback1=$feedbacks[0];
        if(isset($products[1])) $array[$i]->produit2=$products[1];
        if(isset($feedbacks[1])) $array[$i]->feedback2=$feedbacks[1];
        if(isset($products[2])) $array[$i]->produit2=$products[2];
        if(isset($feedbacks[2])) $array[$i]->feedback3=$feedbacks[2];
        if(isset($products[3])) $array[$i]->produit2=$products[3];
        if(isset($feedbacks[3])) $array[$i]->feedback4=$feedbacks[3];
        if(isset($products[4])) $array[$i]->produit2=$products[4];
        if(isset($feedbacks[4])) $array[$i]->feedback5=$feedbacks[4];
        
        

        }

        
        
       

        //traitement to get products from array
        //$products = preg_split("/[\n\r,.;]+/", $array[7], -1, PREG_SPLIT_NO_EMPTY);
        //dd($products);
       // dd($array);
       //for($i=0;$i<count($array);$i++){
       //$array = array_except($array,['0']);
       
      // }


      //dd($array);
     // delete products from list of products and feedbacks
      for($i=0;$i<count($array);$i++){
      
        unset($array[$i]->listproduits);
        unset($array[$i]->feedbacks);
       
    
      }



        $collection = collect($array);
        
        
        //dd($collection);
       // $collection.push(['data',"datas"]);
        //dd($collection);
       
       
        // for($i=0;$i<count($collection)+1;$i++){
        //     dd($collection[$i]->listproduits);
        // }
        
        //dd($array[1]->listproduits);

        // foreach($array as $arr){
        //     echo $arr->listproduits.'<br>';
            
        // }

       // dd($collection);


        // $products = preg_split("/[\n\r,.;]+/", $collection[0]->listproduits, -1, PREG_SPLIT_NO_EMPTY);
        
 
        return $collection;
        
        

        

    }


//headings
    public function headings(): array
    {
        return [
            'Nom',
            'Prenom',
            'Etablissement',
            'Potentiel',
            'Date de Visite',
            'Spécialité',
            'Ville',
            'Libelle du P1',
            'Feedback P1',
            'Libelle du P2',
            'Feedback P2',
            'Libelle du P3',
            'Feedback P3',
            'Libelle du P4',
            'Feedback P4',
            'Libelle du P5',
            'Feedback P5'
            
        ];
    }




    /**
     * @return array
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:W1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);
            },
        ];
    }

    




}
