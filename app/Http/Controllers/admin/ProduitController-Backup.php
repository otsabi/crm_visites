<?php

namespace App\Http\Controllers\admin;

use App\Gamme;
use App\Produit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;

class ProduitController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:ADMIN|SUPADMIN');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produits = Produit::all();
        $gammes = Gamme::select('gamme_id','libelle')->orderBy('created_at')->get();

        return view('admin.products.products',compact(['produits','gammes']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[

            'code'=>'required|min:3',
            'libelle'=>'required|min:3',
            'price'=>'required|numeric|between:1.00,9999.99',
            'gamme' => 'required|exists:gammes,gamme_id'
            ],
            [
            'code.*'=>'Code produit invalid.',
            'libelle.*'=>'libelle produit invalid.',
            'price.*'=>'prix incorrect',
            'gamme.*'=>'gamme invalide ou n\'existe pas',
            ]
        );

        if($validator->fails()){
            return redirect()->back()->withErrors($validator);
        }

        $produit = new Produit();
        $produit->code_produit = $request->input('code');
        $produit->gamme_id = $request->input('gamme');
        $produit->libelle = $request->input('libelle');
        $produit->prix = $request->input('price');

        $produit->save();

        return redirect()->back()->with('status','Produit crée avec succès.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $produit = Produit::findOrfail($id);

        $validator = Validator::make($request->all(),[
            'up_libelle'=>'required|min:3',
            'up_price'=>'required|numeric|between:1.00,9999.99',
            'up_gamme' => 'required|exists:gammes,gamme_id'
            ],
            [
                'up_libelle.*'=>'libelle produit invalid.',
                'up_price.*'=>'prix incorrect',
                'up_gamme.*'=>'gamme invalide ou n\'existe pas',
            ]
        );

        if($validator->fails()){
            return redirect()->back()->withErrors($validator);
        }

        $produit->gamme_id = $request->input('up_gamme');
        $produit->libelle = $request->input('up_libelle');
        $produit->prix = $request->input('up_price');

        $produit->save();

        return redirect()->back()->with('status','Vos modifications sont enregistrées.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pr = Produit::findOrfail($id);
        try {
            $pr->delete();
            return redirect()->back()->with('status','Produit supprimé avec succès.');
        }
        catch (QueryException $exception){
            return redirect()->route('admin.products.index')->withErrors(['Error' => 'vous ne pouvez pas supprimer ce produit car il est lié à certaines visites']);
        }
        catch(\Exception $e){
            return redirect()->route('admin.products.index')->withErrors(['Error' => 'nous n\'avons pas pu terminer votre demande. s\'il vous plaît essayez à nouveau']);
        }



    }
}
