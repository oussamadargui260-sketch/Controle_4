<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('commande_details', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('commande_id');
            $table->unsignedBigInteger('produit_id');

            $table->integer('quantite');
            $table->decimal('prix_unitaire', 10, 2);

            $table->timestamps();

            $table->foreign('commande_id')
                  ->references('id')->on('commandes')
                  ->onDelete('cascade');

            $table->foreign('produit_id')
                  ->references('id')->on('produits')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('commande_details');
    }
};
