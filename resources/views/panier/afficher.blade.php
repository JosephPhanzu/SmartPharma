@extends('index')

@section('contenuMain')
    <div class="container">
        <div class="row d-flex p-0">
            <div class="d-flex justify-content-between">
                <h3 class="text-primary fw-bolder">Votre panier</h3>
                @if (session('success'))
                    <div class="alert alert-success p-1 me-5">{{ session('success') }}</div>
                @endif
            </div>
            @if (count($panier) > 0)
                <div class="d-flex flex-column table-responsive m-0" style="height: 330px;">
                    <table class="table m-0">
                        <thead>
                            <tr>
                                <th class="rounded-start" style="background: rgb(41,60,200);color:aliceblue;">Produit</th>
                                <th style="background: rgb(41,60,200);color:aliceblue;">Prix</th>
                                <th style="background: rgb(41,60,200);color:aliceblue;">Quantité</th>
                                <th style="background: rgb(41,60,200);color:aliceblue;">Sous-total</th>
                                <th class="rounded-end" style="background: rgb(41,60,200);color:aliceblue;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($panier as $id => $item)
                                <tr>
                                    <td>{{ $item['nom'] }}</td>
                                    <td>{{ $item['prix'] }}</td>
                                    <td>
                                        <form action="{{ route('panier.mettreAJour') }}" method="POST" class="d-inline">
                                            @csrf
                                            <input type="hidden" name="produit_id" value="{{ $id }}">
                                            <input type="number" name="quantite" value="{{ $item['quantite'] }}" min="1" class="form-control" style="width: 80px; display: inline;">
                                            <button type="submit" class="btn btn-primary btn-sm">Mettre à jour</button>
                                        </form>
                                    </td>
                                    <td>{{ $item['prix'] * $item['quantite'] }}</td>
                                    <td>
                                        <form action="{{ route('panier.supprimer') }}" method="POST" class="d-inline">
                                            @csrf
                                            <input type="hidden" name="produit_id" value="{{ $id }}">
                                            <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="row position-relative">
                    <form class="position-absolute" action="{{ route('factures.creer') }}" method="POST">
                        <h3 class="m-0">Total : {{ $total }} Kw</h3>
                        @csrf
                        <div class="my-2">
                            <input type="text" name="nom_client" id="nom_client" class="form-control" placeholder="Nom du client" required>
                        </div>
                        <button type="submit" class="btn btn-success">Créer la facture</button>
                    </form>
                </div>

            @else
                <div class="row justify-content-center">
                    <p class="alert alert-warning col-md-10">Votre panier est vide.</p>
                </div>
            @endif
        </div>
    </div>
@endsection
@push('scripts')
    @vite(['resoueces/js/app.js'])
    <script type="module">
        $(document).ready(function(){
            
        });
    </script>
@endpush