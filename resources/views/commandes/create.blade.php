@extends('layout')

@section('content')
<h1>Ajouter une Commande</h1>

<form action="{{ route('commandes.store') }}" method="POST" class="card p-4 shadow-sm">
    @csrf
    <div class="mb-3">
        <label class="form-label">Client</label>
        <select name="client_id" class="form-select @error('client_id') is-invalid @enderror">
            <option value="">-- Choisir un client --</option>
            @foreach($clients as $client)
                <option value="{{ $client->id }}">{{ $client->nom }}</option>
            @endforeach
        </select>
        @error('client_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Date de commande</label>
        <input type="datetime-local" name="date_commande" class="form-control @error('date_commande') is-invalid @enderror">
        @error('date_commande') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <hr>
    <h5>Produits (Exemple simplifié pour 1 produit)</h5>
    <div class="row">
        <div class="col-md-8">
            <select name="produits[0][id]" class="form-select">
                @foreach($produits as $produit)
                    <option value="{{ $produit->id }}">{{ $produit->nom }} ({{ $produit->prix }} DH)</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4">
            <input type="number" name="produits[0][quantite]" class="form-control" placeholder="Quantité" min="1" value="1">
        </div>
    </div>

    <button type="submit" class="btn btn-success mt-4">Enregistrer la commande</button>
    <a href="{{ route('commandes.index') }}" class="btn btn-secondary mt-4">Annuler</a>
</form>
@endsection
