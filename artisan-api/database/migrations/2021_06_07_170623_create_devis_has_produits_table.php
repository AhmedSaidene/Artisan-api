<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDevisHasProduitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('devis_has_produits', function (Blueprint $table) {
            $table->id();
            $table->float('prix_par_achat',10,3);
            $table->float('prix_par_vente_unitaire',10,3);
            $table->float('prix_par_total_HT',10,3);
            $table->integer('quantite');
            $table->float('tva',3,2);
            $table->string('reference');
            $table->string('desc');

             $table->foreignId('groupe_ligne_doc_id')->constrained('groupe_ligne_docs');
            $table->foreignId('produit_id')->constrained('produit');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('devis_has_produits');
    }
}
