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
        Schema::create('tids', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('wallet_id')->nullable()->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->string('hash_id')->unique();
            $table->double('amount');
            $table->string('screenshot')->nullable();
            $table->string('exchange')->nullable();
            $table->double('fees');
            $table->boolean('status')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tids');
    }
};
