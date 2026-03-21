<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Client;
use App\Models\Produit;
use App\Models\Commande;
use App\Models\CommandeDetail;
use App\Models\DetailCommandes;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ----- Clients -----
        $clients = [
            ['nom' => 'Oussama', 'email' => 'oussama@example.com'],
            ['nom' => 'Aya', 'email' => 'aya@example.com'],
            ['nom' => 'Youssef', 'email' => 'youssef@example.com'],
            ['nom' => 'Sara', 'email' => 'sara@example.com'],
            ['nom' => 'Khalid', 'email' => 'khalid@example.com'],
        ];

        foreach ($clients as $c) {
            Client::create($c);
        }

        // ----- Produits -----
        $produits = [
            ['nom' => 'PC Portable', 'prix' => 5000, 'stock' => 10],
            ['nom' => 'Souris', 'prix' => 150, 'stock' => 50],
            ['nom' => 'Clavier', 'prix' => 300, 'stock' => 30],
            ['nom' => 'Écran 24"', 'prix' => 1200, 'stock' => 20],
            ['nom' => 'Casque Audio', 'prix' => 450, 'stock' => 40],
        ];

        foreach ($produits as $p) {
            Produit::create($p);
        }

        // ----- Commandes -----
        $commande1 = Commande::create([
            'client_id' => 1,
            'date_commande' => now()
        ]);

        $commande2 = Commande::create([
            'client_id' => 2,
            'date_commande' => now()
        ]);

        $commande3 = Commande::create([
            'client_id' => 3,
            'date_commande' => now()
        ]);

        // ----- DetailCommandes -----
        $details = [
            ['commande_id' => $commande1->id, 'produit_id' => 1, 'quantite' => 2, 'prix_unitaire' => 5000],
            ['commande_id' => $commande1->id, 'produit_id' => 2, 'quantite' => 1, 'prix_unitaire' => 150],
            ['commande_id' => $commande2->id, 'produit_id' => 3, 'quantite' => 1, 'prix_unitaire' => 300],
            ['commande_id' => $commande2->id, 'produit_id' => 5, 'quantite' => 2, 'prix_unitaire' => 450],
            ['commande_id' => $commande3->id, 'produit_id' => 4, 'quantite' => 1, 'prix_unitaire' => 1200],
        ];

        foreach ($details as $d) {
            CommandeDetail::create($d);
        }
    }
}
