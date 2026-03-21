<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    use HasFactory;
    protected $fillable = ['nom', 'description', 'prix', 'stock_actuel'];
    public function details()
    {
        return $this->hasMany(CommandeDetail::class);
    }
}
