<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produit;

class PageViews extends Controller
{
    //
    public function accueil(Request $request){

        $query = Produit::query();

        if ($request->has('search')) {
            $query->where('nom', 'like',  $request->input('search') . '%')
                  ->orWhere('categorie', 'like',  $request->input('search') . '%');
        }
    
        $produits = $query->paginate(10);

        if ($request->ajax()) {

            $contenu = $produits->isEmpty() 
            ? '<tr><td colspan="6" class="text-center">Aucun résultat trouvé.</td></tr>' 
            : view('partials.produits_table', compact('produits'))->render();

            return response()->json([
                'table' => $contenu,
                'pagination' => (string) $produits->links(),
            ]);
        }

        return view('contenu.accueil', compact('produits'));
    }


    public function ajoutProd(){
        return view('contenu.ajoutProd');
    }
}
