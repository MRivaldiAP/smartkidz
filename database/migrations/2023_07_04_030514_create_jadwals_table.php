<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('jadwals', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->date('tanggal');
            $table->string('airlines', 255);
            $table->string('dewasa', 255);
            $table->string('cwb', 255);
            $table->string('cwob', 255);
            $table->string('infant', 255);
            $table->integer('allotment');
            $table->integer('min_departure');
            $table->integer('min_deposit');
            $table->string('starting', 255);
            $table->string('commission', 255);
            $table->string('point', 255);
            $table->string('status', 255);
            $table->unsignedBigInteger('produk_id');
            $table->foreign('produk_id')->references('id')->on('produks')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwals');
    }
};
