@extends('index')

@section('title', 'Produits')

@section('contenuMain')
    <div class="row">
        <div class="">
            <h1 class="ms-5 fs-3">Ajout Produits</h1>
        </div>
    </div>
    <div class="row mt-3 w-100 p-0 m-0">
        <form  class="form-inline p-0 m-0" id="form-ajoutProd" style="height:350px">
            @csrf
            <div class="row p-0 m-0">
                <div class="d-flex justify-content-around p-0 m-0 my-2">
                    <div class="form-group col-md-5">
                        <input type="text" class="form-control" id="nom" name="nom" placeholder="Nom Produit" required>
                    </div>
                    <div class="form-group col-md-5">
                        <input type="number" class="form-control" id="quantite" name="quantite" placeholder="Quantité" required>
                    </div>
                </div>
                <div class="d-flex justify-content-around my-2 p-0 m-0">
                    <div class="form-group col-md-5">
                        <input type="number" class="form-control" name="prix" id="prix" placeholder="Prix" required>
                    </div>
                    <div class="form-group col-md-5">
                        <input type="text" class="form-control" id="categorie" name="categorie" placeholder="Catégorie" required>
                    </div>
                </div>
                <div class="row justify-content-center my-2">
                    <div class="form-group col-md-7">
                        <input type="date" class="form-control" name="date" id="date" placeholder="Date de peremption" title="Date de peremption" required>
                    </div>
                </div>
                <div class="row justify-content-center col-md-12 my-2">
                    <div class="form-group col-md-10">
                        <textarea class="form-control m-2" name="description" placeholder="Description" id="description" required></textarea>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="d-flex justify-content-center col-md-12">
                        <button class="col-md-8 text-white btn-block rounded buttonAjoutProd">
                            Ajouter
                        </button>
                    </div>
                </div>
                <div class="row my-2 col-md-12 justify-content-center">
                    <div class="alert d-none col-md-10" id="block-info"></div>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    @vite(['resources/js/app.js', 'resources/css/app.css'])
    <script type="module">
        $(document).ready(function(){
            $('#form-ajoutProd').submit(function(e){
                e.preventDefault();
                $.ajaxSetup({
                    headers : {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var formData = {
                    _token: $('input[name="_token"]').val(),
                    nom: $('#nom').val(),
                    description: $('#description').val(),
                    quantite: $('#quantite').val(),
                    prix: $('#prix').val(),
                    date: $('#date').val(),
                    categorie: $('#categorie').val(),
                };

                $.ajax({
                    url : "{{ route('produit.ajout') }}",
                    type : "POST",
                    data : formData,
                    success : function(response){
                        
                        if (response.message.includes('Echec')) {
                            $('#block-info').removeClass('alert-success').addClass('alert-danger');
                        }else{
                            $('#block-info').removeClass('alert-danger').addClass('alert-success');
                        }
                        $('#block-info').removeClass('d-none').html(response.message);
                        setTimeout(() => {
                            location.reload();
                        }, 2000);
                    },
                    error : function(xhr){
                        alert('Erreur : ' + xhr.responseJSON.message);
                    }
                });
            });
        });
    </script>
@endpush