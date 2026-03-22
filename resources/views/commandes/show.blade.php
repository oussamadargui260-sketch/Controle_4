@extends('layout')

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

    
@endsection
