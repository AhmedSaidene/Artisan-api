<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();

            $table->string('nom', 45);
            //$table->string('prenom', 45)->nullable();
            $table->string('email', 45)->unique();
            $table->string('adresse',45);
            $table->string('cp',45);
            $table->string('ville',45);
            $table->string('tel',45);

            $table->foreignId('typeClient_id')->constrained('type_clients');
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
        Schema::dropIfExists('clients');
    }
}
