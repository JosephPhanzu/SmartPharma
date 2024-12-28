@extends('index')

@section('title', 'Facture')

@section('contenuMain')
<div class="container" style="height:350px">

    @include('factures.partials.blockFacture', ['facture' => $facture])

    <div class="my-2">
        <form action="{{ route('facture.telecharger', $facture->id) }}" method="POST">
            @csrf
            <button class="btn btn-success">Générer le PDF</button>
        </form>
    </div>
</div>
@endsection
