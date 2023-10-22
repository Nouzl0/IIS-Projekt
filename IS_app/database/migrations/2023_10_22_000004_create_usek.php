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
        Schema::create('usek', function (Blueprint $table) {
            $table->integer('poradie_useku');
            $table->unsignedBigInteger('id_zastavka_zaciatok');
            $table->unsignedBigInteger('id_zastavka_koniec');
            $table->string('meno_useku', 45);
            $table->string('dlzka_useku', 45)->nullable();
            $table->time('cas_useku');
            $table->string('usekcol', 45)->nullable();
            $table->unsignedBigInteger('id_trasa');

            $table->primary(['poradie_useku', 'id_zastavka_zaciatok', 'id_zastavka_koniec', 'id_trasa']);

            $table->index('id_zastavka_zaciatok');
            $table->index('id_zastavka_koniec');
            $table->unique('meno_useku', 'id_usek_UNIQUE');
            $table->index('id_trasa');

            $table->foreign('id_zastavka_zaciatok')
                ->references('id_zastavka')
                ->on('zastavka')
                ->onUpdate('NO ACTION')
                ->onDelete('NO ACTION');

            $table->foreign('id_zastavka_koniec')
                ->references('id_zastavka')
                ->on('zastavka')
                ->onUpdate('NO ACTION')
                ->onDelete('NO ACTION');

            $table->foreign('id_trasa')
                ->references('id_trasa')
                ->on('trasa')
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
        Schema::dropIfExists('usek');
    }
};
