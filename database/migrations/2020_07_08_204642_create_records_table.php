<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('records', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->text('autores');
            $table->text('titulo');
            $table->text('desc_f');
            $table->text('editora');
            $table->text('assunto');
            $table->text('local_p');
            $table->text('localizacao');
            $table->string('edicao');
            $table->text('ano');
            $table->text('idioma');
            $table->string('isbn');
            $table->string('issn');
            $table->string('tipo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('records');
    }
}
