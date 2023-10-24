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
            $table->unsignedBigInteger('poradie_useku');
            $table->unsignedBigInteger('id_zastavka_zaciatok');
            $table->unsignedBigInteger('id_zastavka_koniec');
            $table->unsignedBigInteger('dlzka_useku_km')->nullable();
            $table->unsignedBigInteger('cas_useku_minuty');
            $table->unsignedBigInteger('id_trasa');
            $table->timestamps();

            $table->primary(['poradie_useku', 'id_zastavka_zaciatok', 'id_zastavka_koniec', 'id_trasa']);

            $table->index('id_zastavka_zaciatok');
            $table->index('id_zastavka_koniec');
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
