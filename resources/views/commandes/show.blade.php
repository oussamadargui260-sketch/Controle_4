@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-7">
        <div class="card shadow">
            <div class="card-header bg-dark text-white">Détails de la Commande #{{ $commande->id }}</div>
            <div class="card-body">
                <h6>Client : {{ $commande->client->nom }}</h6>
                <hr>
                <table class="table">
                    <thead><tr><th>Produit</th><th>Qté</th><th>Prix Unit.</th><th>Total</th></tr></thead>
                    <tbody>
                        @foreach($commande->details as $detail)
                        <tr>
                            <td>{{ $detail->produit->nom }}</td>
                            <td>{{ $detail->quantite }}</td>
                            <td>{{ $detail->prix_unitaire }} DH</td>
                            <td>{{ $detail->quantite * $detail->prix_unitaire }} DH</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-5">
        <div class="card shadow">
            <div class="card-header bg-info text-white">Ajouter un produit</div>
            <div class="card-body">
                <form action="{{ route('commandes.add_product', $commande) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label>Produit</label>
                        <select name="produit_id" class="form-select">
                            @foreach($produits as $produit)
                                <option value="{{ $produit->id }}">{{ $produit->nom }} ({{ $produit->prix }} DH)</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Quantité</label>
                        <input type="number" name="quantite" class="form-control" value="1" min="1">
                    </div>
                    <button type="submit" class="btn btn-info w-100 text-white">Ajouter à la liste</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
