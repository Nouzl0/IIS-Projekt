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
        Schema::create('trasa', function (Blueprint $table) {
            $table->id('id_trasa');
            $table->string('meno_trasy', 45)->nullable();
            $table->string('info_trasy', 240)->nullable();
            $table->unsignedBigInteger('id_linka');
            $table->timestamps();

            $table->unique('id_trasa', 'idTrasy_UNIQUE');

            $table->foreign('id_linka')
                ->references('id_linka')
                ->on('linka')
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
        Schema::dropIfExists('trasa');
    }
};
