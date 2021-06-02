<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produits', function (Blueprint $table) {
            
            $table->id();
            $table->string('lib',45);
            $table->string('img',200);
            $table->string('fabricant',45);
            $table->string('reference',45);
            $table->double('prix_achat', 10, 3);
            $table->double('prix_vente', 10, 3);
            $table->text('desc');
            $table->double('tva', 3, 2);

            $table->foreignId('type_prestation_id')->constrained('type_prestations');
            $table->foreignId('type_traveux_id')->constrained('type_traveux');
            $table->foreignId('entreprise_id')->constrained('entreprises');
            $table->foreignId('categorie_id')->constrained('categories');
            
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
        Schema::dropIfExists('produits');
    }
}
