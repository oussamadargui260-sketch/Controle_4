@extends('layout')

@section('content')
<div class="card border-danger mx-auto" style="max-width: 500px;">
    <div class="card-header bg-danger text-white">Confirmation de suppression</div>
    <div class="card-body text-center">
        <p>Êtes-vous sûr de vouloir supprimer la commande <strong>#{{ $commande->id }}</strong> ?</p>
        <p class="text-muted small">Cette action supprimera également tous les détails associés.</p>

        <form action="{{ route('commandes.destroy', $commande) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Oui, Supprimer définitivement</button>
            <a href="{{ route('commandes.index') }}" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
</div>
@endsection
