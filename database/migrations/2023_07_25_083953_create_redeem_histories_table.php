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
        Schema::create('redeem_histories', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('booking_code', 255);
            $table->string('group', 255)->nullable();
            $table->date('tanggal');
            $table->integer('quantity');
            $table->integer('debit')->nullable();
            $table->integer('kredit')->nullable();
            $table->integer('point');
            $table->integer('remark')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('redeem_histories');
    }
};
