<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\Client;
use App\Models\CommandeDetail;
use App\Models\Produit;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommandeController extends Controller
{
    public function index()
    {
        $commandes = Commande::with(['client', 'details'])
            ->latest()
            ->paginate(10);

        return view('commandes.index', compact('commandes'));
    }

    public function create()
    {
        $clients = Client::all();
        $produits = Produit::all();
        return view('commandes.create', compact('clients', 'produits'));
    }
    public function store(Request $request)
    {

        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'date_commande' => 'required|date',
            'produits' => 'required|array',
            'produits.*.id' => 'exists:produits,id',
            'produits.*.quantite' => 'integer|min:1'
        ]);
        DB::transaction(function () use ($validated) {
            $commande = Commande::create([
                'client_id' => $validated['client_id'],
                'date_commande' => $validated['date_commande'],
            ]);

            foreach ($validated['produits'] as $item) {
                $produit = Produit::find($item['id']);
                CommandeDetail::create([
                    'commande_id' => $commande->id,
                    'produit_id' => $produit->id,
                    'quantite' => $item['quantite'],
                    'prix_unitaire' => $produit->prix
                ]);
            }
        });
        return redirect()->route('commandes.index')->with('success', 'Commande ajoutée avec succès.');
    }

    public function edit(Commande $commande)
    {
        $clients = Client::all();
        return view('commandes.edit', compact('commande', 'clients'));
    }

    public function update(Request $request, Commande $commande)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'date_commande' => 'required|date',
            'statut' => 'required|string'
        ]);
        $commande->update($validated);

        return redirect()->route('commandes.index')->with('success', 'Commande mise à jour.');
    }

    //public function confirmDelete(Commande $commande)
  //  {
        //return view('commandes.delete', compact('commande'));
   // }
   public function show(Commande $commande)
{
    $produits = Produit::all();
    return view('commandes.show', compact('commande','produits'));
}
    public function destroy(Commande $commande)
    {
        $commande->delete();
        return redirect()->route('commandes.index')->with('success', 'Commande supprimée.');
    }


    public function addProduit(Request $request, Commande $commande)
{
    $request->validate([
        'produit_id' => 'required|exists:produits,id',
        'quantite' => 'required|integer|min:1',
    ]);

    $commande->details()->create([
        'produit_id' => $request->produit_id,
        'quantite' => $request->quantite,
        'prix_unitaire' => Produit::find($request->produit_id)->prix,
    ]);

    return redirect()->route('commandes.show', $commande)
                     ->with('success', 'Produit ajouté avec succès');
}

    public function stats()
    {
        $commandesParClient = Client::withCount('commandes')->get();


        $caParProduit = DB::table('commande_details')
            ->join('produits', 'commande_details.produit_id', '=', 'produits.id')
            ->select('produits.nom', DB::raw('SUM(quantite * prix_unitaire) as chiffre_affaires'))
            ->groupBy('produits.id', 'produits.nom')
            ->get();

        return view('commandes.stats', compact('commandesParClient', 'caParProduit'));
    }
}
