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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();

            // to saving_accounts
            $table->foreignId('account_id')->constrained('saving_accounts')->onDelete('cascade');
            $table->foreignId('staff_id')->constrained('users')->onDelete('cascade');

            $table->string('type', 50);
            $table->decimal('amount', 15, 2);
            $table->date('date');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};