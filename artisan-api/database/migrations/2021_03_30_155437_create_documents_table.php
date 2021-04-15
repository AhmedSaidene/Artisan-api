<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('type', 45);
            $table->string('IBAN', 45);
            $table->string('SWIFT_BIC', 45);
            $table->string('total_HT', 45);
            $table->double('total_TVA', 3, 2);
            $table->string('total_TTC', 45);
            $table->string('status', 45);
            $table->string('cgv', 45);
            $table->string('pied_page', 45);

            $table->foreignId('client_id')->constrained('clients');
            $table->foreignId('type_prestation_id')->constrained('type_prestation');
            $table->foreignId('type_traveux_id')->constrained('type_traveux');
            $table->foreignId('interventions_id')->constrained('interventions');
            $table->foreignId('modelDevis_id')->constrained('model_devis');
            
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
        Schema::dropIfExists('documents');
    }
}
