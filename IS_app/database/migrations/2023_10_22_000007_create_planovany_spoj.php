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
        Schema::create('planovany_spoj', function (Blueprint $table) {
            $table->id('id_plan_trasy');
            $table->dateTime('zaciatok_trasy')->nullable();
            $table->unsignedBigInteger('id_trasa');
            $table->unsignedBigInteger('id_vozidlo')->nullable();
            $table->unsignedBigInteger('id_uzivatel_dispecer')->nullable();
            $table->unsignedBigInteger('id_uzivatel_sofer')->nullable();
            $table->string('opakovanie');
            $table->dateTime('platny_do');
            $table->timestamps();

            $table->foreign('id_trasa')
                ->references('id_linka')
                ->on('trasa')
                ->onUpdate('NO ACTION')
                ->onDelete('NO ACTION');

            $table->foreign('id_vozidlo')
                ->references('id_vozidlo')
                ->on('vozidlo')
                ->onUpdate('NO ACTION')
                ->onDelete('NO ACTION');

            $table->foreign('id_uzivatel_dispecer')
                ->references('id_uzivatel')
                ->on('uzivatel')
                ->onUpdate('NO ACTION')
                ->onDelete('NO ACTION');

            $table->foreign('id_uzivatel_sofer')
                ->references('id_uzivatel')
                ->on('uzivatel')
                ->onUpdate('NO ACTION')
                ->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('planovany_spoj');
    }
};
