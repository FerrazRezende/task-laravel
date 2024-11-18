<?php

use App\Enums\StatusTarefa;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTarefasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tarefas', function (Blueprint $table) {
            $table->id();
            $table->string('titulo', 255);
            $table->text('descricao');
            $table->enum('status', StatusTarefa::values())->default(StatusTarefa::EM_ABERTO);
            $table->timestamp('data_criacao')->useCurrent();
            $table->timestamp('data_modificacao')->nullable();
            $table->timestamp('data_conclusao')->nullable();
            $table->unsignedBigInteger('user_id');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tarefas');
    }
}
