@extends('layout')

@section('content')
<h1>Statistiques Générales</h1>

<div class="row mt-4">
    <div class="col-md-6">
        <h3>Commandes par Client</h3>
        <ul class="list-group">
            @foreach($commandesParClient as $client)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    {{ $client->nom }}
                    <span class="badge bg-primary rounded-pill">{{ $client->commandes_count }} commandes</span>
                </li>
            @endforeach
        </ul>
    </div>

    <div class="col-md-6">
        <h3>Chiffre d'affaires par Produit</h3>
        <table class="table border">
            <thead><tr><th>Produit</th><th>Total CA</th></tr></thead>
            <tbody>
                @foreach($caParProduit as $item)
                <tr>
                    <td>{{ $item->nom }}</td>
                    <td>{{ number_format($item->chiffre_affaires, 2) }} DH</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
