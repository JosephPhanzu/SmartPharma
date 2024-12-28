<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produit;

class ProduitController extends Controller
{
    //

    public function ajout(Request $request){
        $request->validate([
            'nom' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'quantite' => ['required', 'string', 'max:255'],
            'prix' => ['required', 'string', 'max:255'],
            'date' => ['required', 'date'],
            'categorie' => ['required','string','max:255'],
        ]);
 
        $produit = Produit::updateOrCreate([ 
                'nom' => $request->nom,
                'categorie' => $request->categorie,
            ],
            [
                'description' => $request->description,
                'quantite' => $request->quantite,
                'prix' => $request->prix,
                'date' => $request->date,

            ]
        );

        if (!$produit) {
            return response()->json([ 'message' => 'Echec lors de l\'enregistrement!']);
        }
        return response()->json([ 'message' => 'Enregistré avec succèss']);
    }

    public function getproduit(Request $request){
        
        $produits = Produit::all();

        return response()->json('donnees', $produits);

        return view('contenu.accueil')->with('produits', $produits);
        return view('contenu.ajoutProd', compact('produits'));

    }
}
