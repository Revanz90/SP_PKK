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
        Schema::create('credits', function (Blueprint $table) {
            $table->id();
            $table->integer('nominal_uang');
            $table->string('keterangan');
            $table->timestamp('tanggal_transfer');
            $table->enum('status_credit', ['baru', 'diterima', 'ditolak'])->default('baru');
            $table->unsignedBigInteger('author_id');
            $table->string('author_name');
            $table->enum('status_ketua', ['baru', 'diterima', 'ditolak'])->default('baru');
            $table->double('loan_interest')->default(0);
            $table->double('penalty')->default(0);
            $table->string('due_date')->default(0);
            $table->double('total_terbayar')->default(0);
            $table->timestamps();

            $table->foreign('author_id')->references('id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('credits');
    }
};
