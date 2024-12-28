<?php
namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facture extends Model
{



    protected $fillable = ['nom_client', 'total'];

    public function produits()
    {
        return $this->belongsToMany(Produit::class, 'facture_produit')
                    ->withPivot('quantite', 'prix')
                    ->withTimestamps();
    }

    // use HasFactory;

    // protected $fillable = ['client_id', 'total'];

    // public function client()
    // {
    //     return $this->belongsTo(Client::class);
    // }

    // public function produits()
    // {
    //     return $this->belongsToMany(Produit::class, 'facture_produit')
    //                 ->withPivot('quantite', 'prix_unitaire');
    // }
}
