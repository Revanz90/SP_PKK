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
        Schema::create('installments', function (Blueprint $table) {
            $table->id();
            $table->integer('nominal_uang');
            $table->string('keterangan');
            $table->timestamp('tanggal_transfer');
            $table->enum('status', ['baru', 'disimpan', 'diterima', 'ditolak'])->default('baru');
            $table->unsignedBigInteger('author_id');
            $table->string('author_name');
            $table->unsignedBigInteger('credit_id');
            $table->timestamps();

            $table->foreign('author_id')->references('id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('installments');
    }
};
