<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use App\Models\Client;
    use App\Models\Produit;
    use App\Models\Facture;
    use Barryvdh\DomPDF\Facade\Pdf;
    

    class FactureController extends Controller
    {
        public function creerFacture(Request $request)
        {
            $panier = session('panier', []);

            if (empty($panier)) {
                return redirect()->back()->with('error', 'Le panier est vide.');
            }

            // Calcul du total
            $total = 0;
            foreach ($panier as $item) {
                $produit = Produit::find($item['id']);
                $total += $produit->prix * $item['quantite'];
            }

            // Créer la facture
            $facture = Facture::create([
                'nom_client' => $request->input('nom_client'),
                'total' => $total,
            ]);

            // Lier les produits à la facture
            foreach ($panier as $item) {
                $produit = Produit::find($item['id']);
                $facture->produits()->attach($produit, [
                    'quantite' => $item['quantite'],
                    'prix' => $produit->prix,
                ]);
                $produit->quantite -= $item['quantite'];
                $produit->save();
            }

            // Vider le panier
            session()->forget('panier');

            return redirect()->route('facture.show', $facture->id)
                            ->with('success', 'Facture créée avec succès.');
        }

        public function afficherFacture($id)
        {
            $facture = Facture::with('produits')->findOrFail($id);
            return view('factures.afficher', compact('facture'));
        }

        public function telecharger(Facture $facture)
        {
            $pdf = Pdf::loadView('factures.partials.blockFacture', compact('facture'));
            return $pdf->download("facture_{$facture->id}.pdf");
        }

    }
