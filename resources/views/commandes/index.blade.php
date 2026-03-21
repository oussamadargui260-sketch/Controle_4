@extends('layout')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Liste des Commandes</h1>
    <a href="{{ route('commandes.create') }}" class="btn btn-primary">Nouvelle Commande</a>
</div>

<table class="table table-striped border">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Client</th>
            <th>Date</th>
            <th>Produits (Détails)</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($commandes as $commande)
        <tr>
            <td>{{ $commande->id }}</td>
            <td>{{ $commande->client->nom }}</td>
            <td>{{ \Carbon\Carbon::parse($commande->date_commande)->format('d/m/Y H:i') }}</td>
            <td>
                <ul class="list-unstyled mb-0 small">
                    @foreach($commande->details as $detail)
                        <li>• {{ $detail->produit->nom }} (x{{ $detail->quantite }})</li>
                    @endforeach
                </ul>
            </td>
            <td>
                <a href="{{ route('commandes.edit', $commande) }}" class="btn btn-sm btn-warning">Modifier</a>
                <a href="{{ route('commandes.confirm', $commande) }}" class="btn btn-sm btn-danger">Supprimer</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="d-flex justify-content-center">
    {{ $commandes->links() }}
</div>
@endsection
