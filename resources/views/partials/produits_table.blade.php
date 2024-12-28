@foreach ($produits as $produit)
    <tr>
        <td>{{ $produit->id }}</td>
        <td>{{ $produit->nom }}</td>
        <td>{{ $produit->categorie }}</td>
        <td>{{ $produit->description }}</td>
        <td>{{ $produit->quantite }}</td>
        <td>{{ $produit->prix }}</td>
        <td>
            <button class="btn btn-success p-1 m-0 ajouter-au-panier" data-id="{{ $produit->id }}" title="Ajouter au panier"><i class="fa-solid fa-plus"></i></button>
        </td>
    </tr>
@endforeach