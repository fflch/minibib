<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmprestimosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emprestimos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('instance_id');
            $table->date('data_emprestimo');
            $table->date('data_devolucao');
            $table->unsignedBigInteger('user_id');
            $table->string('n_usp');
            $table->foreign('instance_id')->references('id')->on('instances');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $table->dropForeign(['instance_id']);
        $table->dropForeign(['user_id']);
        Schema::dropIfExists('emprestimos');
    }
}
