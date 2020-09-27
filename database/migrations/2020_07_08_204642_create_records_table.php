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
            $table->text('desc_fisica')->nullable();
            $table->text('editora')->nullable();
            $table->text('assunto')->nullable();
            $table->text('local_publicacao')->nullable();
            $table->text('localizacao')->nullable();
            $table->string('edicao')->nullable();
            $table->text('ano');
            $table->text('idioma');
            $table->string('isbn')->nullable();
            $table->string('issn')->nullable();
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
