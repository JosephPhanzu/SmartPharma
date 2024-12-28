<div class="d-flex flex-column">
    <div class="row">
        <h1>Facture #{{ $facture->id }}</h1>
        <p class="my-0"><strong>Nom du client :</strong> {{ $facture->nom_client }}</p>
        <p class="my-0"><strong>Date :</strong> {{ $facture->created_at->format('d/m/Y') }}</p>
        <p class="my-0"><strong>Heure :</strong> {{ $facture->created_at->format('h:i') }}</p>
    </div>
    <div class="table-responsive" style="height: 320px;">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Produit</th>
                    <th>Quantité</th>
                    <th>Prix unitaire</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($facture->produits as $produit)
                    <tr>
                        <td>{{ $produit->nom }}</td>
                        <td>{{ $produit->pivot->quantite }}</td>
                        <td>{{ $produit->pivot->prix }} Kw</td>
                        <td>{{ $produit->pivot->quantite * $produit->pivot->prix }} Kw</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" class="text-end"><strong>Total :</strong></td>
                    <td>{{ $facture->total }} Kw</td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>