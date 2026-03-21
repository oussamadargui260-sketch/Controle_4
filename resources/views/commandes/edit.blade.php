@extends('layouts.app')

@section('content')
<div class="card shadow-sm mx-auto" style="max-width: 700px;">
    <div class="card-header bg-warning text-dark"><h5>Modifier la commande #{{ $commande->id }}</h5></div>
    <div class="card-body">
        <form action="{{ route('commandes.update', $commande) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Client</label>
                <select name="client_id" class="form-select">
                    @foreach($clients as $client)
                        <option value="{{ $client->id }}" {{ $commande->client_id == $client->id ? 'selected' : '' }}>
                            {{ $client->nom }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Statut</label>
                <select name="statut" class="form-select">
                    <option value="en_attente" {{ $commande->statut == 'en_attente' ? 'selected' : '' }}>En attente</option>
                    <option value="livree" {{ $commande->statut == 'livree' ? 'selected' : '' }}>Livrée</option>
                    <option value="annulee" {{ $commande->statut == 'annulee' ? 'selected' : '' }}>Annulée</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary w-100">Mettre à jour</button>
        </form>
    </div>
</div>
@endsection
