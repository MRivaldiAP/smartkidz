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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('judul', 255);
            $table->string('pic', 255);
            $table->text('gender');
            $table->text('cust');
            $table->text('tanggal_lahir');
            $table->text('passport');
            $table->text('exp_passport');
            $table->text('url_passport');
            $table->integer('allotment');
            $table->integer('total');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
