<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTypeTraveauxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('type_traveaux', function (Blueprint $table) {
            $table->id();
            $table->string('img',200);
            $table->json('lib');
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
        Schema::dropIfExists('type_traveaux');
    }
}
