<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntreprisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entreprises', function (Blueprint $table) {
            
            $table->id();
            $table->string('lib',100);
            $table->string('email',45);
            $table->string('adresse',45);
            $table->string('tel',45);
            $table->string('logo',200);
            
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
        Schema::dropIfExists('entreprises');
    }
}
