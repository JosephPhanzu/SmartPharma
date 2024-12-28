@extends('index')

@section('contenuMain')
    <div class="row">
        <div class="d-flex mt-2 justify-content-between">
            <form class="form-inline">
                <div class="form-group justify-content-end">
                    <div class="input-group">
                        <input type="search" name="search" class="form-control form-control-sm shadow-none" placeholder="Rechercher" id="rech">
                        <span class="input-group-text"><i class="fa-solid fa-magnifying-glass"></i></span>
                    </div>
                </div>
            </form>
            <div class="block-panier me-5">
                <a href="{{ route('panier.afficher') }}" class="mb-2">
                    <span><i class="fa-solid fa-cart-plus cursor-pointer fs-4"></i></span><span class="notification me-5"><span class="badge">
                        {{ count(session('panier', []))}}
                    </span></span>
                </a>
            </div>
        </div>
    </div>
    <div class="row mt-1 w-100 p-0 h-100">
        <div class="d-flex flex-column table-responsive pt-0" style="height:420px">
            <table class="table table-striped table-hover" style="margin: 0;">
                <thead class="rounded sticky-top">
                    <tr class="text-white">
                        <th class="rounded-start" style="background: rgb(41,60,200);color:aliceblue;">N°</th>
                        <th style="background: rgb(41,60,200);color:aliceblue;">Produit</th>
                        <th style="background: rgb(41,60,200);color:aliceblue;">categorie</th>
                        <th style="background: rgb(41,60,200);color:aliceblue;">Description</th>
                        <th style="background: rgb(41,60,200);color:aliceblue;">Quantité</th>
                        <th style="background: rgb(41,60,200);color:aliceblue;">Prix</th>
                        <th class="rounded-end" style="background: rgb(41,60,200);color:aliceblue;">Action</th>
                    </tr>
                </thead>
                <tbody id="produits-tbody" style="overflow:visible">
                @foreach ($produits as $produit)
                    <tr>
                        <td>{{ $produit->id }}</td>
                        <td>{{ $produit->nom }}</td>
                        <td>{{ $produit->categorie }}</td>
                        <td>{{ $produit->description }}</td>
                        <td>{{ $produit->quantite }}</td>
                        <td>{{ $produit->prix }}</td>
                        <td>
                            <buuton class="btn btn-success p-1 m-0 ajouter-au-panier" data-id="{{ $produit->id }}" title="Ajouter au panier"><i class="fa-solid fa-plus"></i></button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <!-- Liens de pagination -->
        <div class="my-3 d-flex justify-content-center">
                {{ $produits->links() }}
            </div>
        </div>
@endsection
@push('scripts')
    @vite(['resoueces/js/app.js'])
    <script type="module">
        $(document).ready(function(){

            $('#rech').keyup(function(e){
                e.preventDefault();
                let search = $(this).val();
                $.ajax({
                    url : "{{ route('accueil') }}",
                    type : 'GET',
                    data : {search : search},
                    success : function(response){
                        // remplace le tableau
                        $('#produits-tbody').html(response.table);

                        // Remplace les liens de pagination
                        $('.my-3.d-flex.justify-content-center').html(response.pagination);
                    },
                    error : function(xhr){
                        console.error('Erreur lors de la recherche :', xhr.responseText);
                    }
                })
            })

            $(document).on('click', '.ajouter-au-panier', function(e) {
                e.preventDefault();

                let produitId = $(this).data('id');
                let quantite = 1; // Par défaut, ou ajoutez une saisie dynamique

                $.ajax({
                    url: "{{ route('panier.ajouter') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        produit_id: produitId,
                        quantite: quantite
                    },
                    success: function(response) {
                        // $('.badge').html("{{ count(session('panier', [])) }}");
                        location.reload();
                    },
                    error: function(xhr) {
                        alert('Erreur : ' + xhr.responseText);
                    }
                });
            });

        });
    </script>
@endpush