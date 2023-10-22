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
        Schema::create('zaznam_udrzby', function (Blueprint $table) {
            $table->unsignedBigInteger('id_udrzba');
            $table->unsignedBigInteger('id_uzivatel_technik');

            $table->primary(['id_udrzba', 'id_uzivatel_technik']);
            $table->index('id_udrzba');
            $table->index('id_uzivatel_technik');

            $table->foreign('id_udrzba')
                ->references('id_udrzba')
                ->on('udrzba')
                ->onUpdate('NO ACTION')
                ->onDelete('NO ACTION');

            $table->foreign('id_uzivatel_technik')
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
        Schema::dropIfExists('zaznam_udrzby');
    }
};
