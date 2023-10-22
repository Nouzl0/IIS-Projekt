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
        Schema::create('udrzba', function (Blueprint $table) {
            $table->id('id_udrzba');
            $table->dateTime('zaciatok_udrzby')->nullable();
            $table->unsignedBigInteger('id_vozidlo');
            $table->unsignedBigInteger('id_uzivatel_spravca');
            $table->timestamps();

            $table->foreign('id_vozidlo')
                ->references('id_vozidlo')
                ->on('vozidlo')
                ->onUpdate('NO ACTION')
                ->onDelete('NO ACTION');

            $table->foreign('id_uzivatel_spravca')
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
        Schema::dropIfExists('udrzba');
    }
};
