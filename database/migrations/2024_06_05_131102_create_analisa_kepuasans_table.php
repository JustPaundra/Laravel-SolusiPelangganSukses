<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('analisa_kepuasan', function (Blueprint $table) {
            $table->id('id_tiket');
            $table->string('pemesan');
            $table->string('sektor');
            $table->integer('skor_kepuasan');
            $table->integer('skor_customer_effort');
            $table->string('foto_bukti')->nullable();
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('analisa_kepuasan');
    }
};
