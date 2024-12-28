<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use App\Models\Produit;

    class PanierController extends Controller
    {
        public function afficher()
        {
            $panier = session()->get('panier', []); // Récupérer le panier depuis la session
            $total = 0;

            foreach ($panier as $item) {
                $total += $item['prix'] * $item['quantite'];
            }

            return view('panier.afficher', compact('panier', 'total'));
        }

        public function ajouter(Request $request)
        {
            $validated = $request->validate([
                'produit_id' => 'required|exists:produits,id',
                'quantite' => 'required|integer|min:1'
            ]);

            $produit = Produit::findOrFail($validated['produit_id']);
            $panier = session()->get('panier', []);

            // Vérifier si le produit est déjà dans le panier
            if (isset($panier[$produit->id])) {
                $panier[$produit->id]['quantite'] += $validated['quantite'];
            } else {
                $panier[$produit->id] = [
                    'id' => $produit->id,
                    'nom' => $produit->nom,
                    'prix' => $produit->prix,
                    'quantite' => $validated['quantite']
                ];
            }

            session()->put('panier', $panier);

            return redirect()->route('panier.afficher')->with('success', 'Produit ajouté au panier.');
        }

        public function supprimer(Request $request)
        {
            $validated = $request->validate([
                'produit_id' => 'required|exists:produits,id'
            ]);

            $panier = session()->get('panier', []);

            if (isset($panier[$validated['produit_id']])) {
                unset($panier[$validated['produit_id']]);
                session()->put('panier', $panier);
            }

            return redirect()->route('panier.afficher')->with('success', 'Produit supprimé du panier.');
        }

        public function mettreAJour(Request $request)
        {
            $validated = $request->validate([
                'produit_id' => 'required|exists:produits,id',
                'quantite' => 'required|integer|min:1'
            ]);

            $panier = session()->get('panier', []);

            if (isset($panier[$validated['produit_id']])) {
                $panier[$validated['produit_id']]['quantite'] = $validated['quantite'];
                session()->put('panier', $panier);
            }

            return redirect()->route('panier.afficher')->with('success', 'Quantité mise à jour.');
        }
    }
