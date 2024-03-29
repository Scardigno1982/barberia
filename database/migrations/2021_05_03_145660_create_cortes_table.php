<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCortesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cortes', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->foreignId('clientes_id')->constrained();
            $table->foreignId('tipos_id')->constrained();
            $table->date('fecha');
            $table->text('descripcion');
            $table->foreignId('barbers_id')->constrained();
            $table->integer('monto');
            $table->softDeletes();
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
        Schema::dropIfExists('cortes');
    }
}
