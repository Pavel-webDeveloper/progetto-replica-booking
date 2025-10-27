<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apartments', function (Blueprint $table) {
            $table->id();
            $table->string('titolo');
            $table->string('slug')->unique();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->text('descrizione');
            $table->foreignId('category_id')->nullable()->constrained()->onDelete('set null');
            $table->decimal('prezzo_per_notte', 8, 2);
            $table->integer('numero_stanze');
            $table->integer('posti_letto');

            // geolocalizzazione
            $table->string('città');
            $table->string('regione');
            $table->string('indirizzo');
            $table->decimal('latitudine', 10 ,8);
            $table->decimal('longitudine', 10 ,8);

            // servizi
            $table->boolean('wifi');
            $table->boolean('disponibile');

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
        Schema::dropIfExists('apartments');
    }
}
