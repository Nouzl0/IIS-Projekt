<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zastavka', function (Blueprint $table) {
            $table->id('id_zastavka');
            $table->string('meno_zastavky', 45)->nullable();
            $table->string('adresa_zastavky', 45)->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('zastavka');
    }
};
