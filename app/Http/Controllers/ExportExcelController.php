<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Excel;
use App\VisiteMedical;
use App\Exports\VisitesExport;
use Yajra\Datatables\Datatables;
use \App\User;

class ExportExcelController extends Controller
{


    public function export() 
    {
        //$visite_data = new VisitesExport();
       // dd($visite_data);
       
       //Function to export all visites into excel
        return Excel::download(new VisitesExport, 'Visites.xlsx');

       // return redirect('ImportExportExcel.export_excel',$data);
        //redirect()->view('ImportExportExcel/export_excel',$visite_data);
       // return view('ImportExportExcel.export_excel',['visite_data'=>$visite_data]);
       // dd(new VisitesExport);
    }


    function index()
    {
       

        return view('ImportExportExcel.export_excel');
    
    }

    
    


//     function excel()
//     {
//      $visite_data = DB::table('visite_medicals')->get()->toArray();
//      $visite_array[] = array('date_visite');
//      foreach($visite_data as $visite)
//      {
//       $visite_array[] = array(
//        'date_visite'  => $visite->date_visite,
//       /* 'champ'   => $visite->champ,
//        'champ'    => $visite->champ,
//        'champ'  => $customervisite->champ,
//        'champ'   => $visite->champ*/
//       );
//      }
//      return Excel::download($data, 'invoices.xlsx');
//     /* return Excel::download($export, 'invoices.xlsx');
//      Excel::create('Données Visite', function($excel) use ($visite_array){
//       $excel->setTitle('Données Visite');
//       $excel->sheet('Données Visite', function($sheet) use ($visite_array){
//        $sheet->fromArray($visite_array, null, 'A1', false, false);
//       });
//      })->export('xlsx');
// */
     
//     }
}

?>