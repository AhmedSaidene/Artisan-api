<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModelDevisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('model_devis', function (Blueprint $table) {
            $table->id();
            $table->string('IBAN', 45);

            $table->string('cgv', 45)->nullable();
            $table->string('piedPage', 45)->nullable();
            $table->string('header', 45)->nullable();
            $table->string('lib', 45)->nullable();
           
            $table->foreignId('entreprise_id')->constrained('entreprise');

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
        Schema::dropIfExists('model_devis');
    }
}
