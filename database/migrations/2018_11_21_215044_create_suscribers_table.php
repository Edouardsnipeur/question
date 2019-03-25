<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuscribersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suscribers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nom');
            $table->string('prenon');
            $table->string('email')->unique();
            $table->string('theme')->default(null);
            $table->string('telephone');
            $table->string('residence');
            $table->string('sexe')->default('H');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('suscribers');
    }
}
