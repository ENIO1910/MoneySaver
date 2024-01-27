<?php

use App\Enums\Categories;
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
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->integer('money');
            $table->enum('category', Categories::valuesToList());
            $table->foreignId('user_id')->constrained()->on('users')->onDelete('cascade');
            $table->timestamps();

            $table->foreignId('wallet_id')->constrained()->on('wallets')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expense');
    }
};
