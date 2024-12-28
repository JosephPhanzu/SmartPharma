<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageViews;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\FactureController;
use App\Http\Controllers\PanierController;

Route::get('/', [PageViews::class, 'accueil'])->name('accueil');
Route::get('/getproduit', [ProduitController::class, 'getproduit'])->name('getProduit');
Route::get('/addprod', [PageViews::class, 'ajoutProd'])->name('ajoutProd');

Route::post('/produit/ajout', [ProduitController::class, 'ajout'])->name('produit.ajout');

// Route pour la fature
Route::post('/factures', [FactureController::class, 'creerFacture'])->name('factures.creer');
Route::get('/factures/{facture}', [FactureController::class, 'afficherFacture'])->name('facture.show');
Route::post('/factures/{facture}/telecharger', [FactureController::class, 'telecharger'])->name('facture.telecharger');

Route::match(['get', 'post'], '/panier', [PanierController::class, 'afficher'])->name('panier.afficher');
Route::post('/panier/ajouter', [PanierController::class, 'ajouter'])->name('panier.ajouter');
Route::post('/panier/supprimer', [PanierController::class, 'supprimer'])->name('panier.supprimer');
Route::post('/panier/mettre-a-jour', [PanierController::class, 'mettreAJour'])->name('panier.mettreAJour');

