<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableMovimento extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movimento', function (Blueprint $table) {
            $table->id();
            $table->foreignId('carteira_origen')->nullable()->index();
            $table->decimal('valor');
            $table->string('status');
            $table->foreignId('carteira_destino')->index();
            $table->enum('notificou',['S','N'])->nullable()->default('N');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('carteira_origen')->references('id')->on('carteira');
            $table->foreign('carteira_destino')->references('id')->on('carteira');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movimento');
    }
}
