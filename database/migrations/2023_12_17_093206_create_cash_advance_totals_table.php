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
        Schema::create('cash_advance_totals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('emp_id')->constrained('employees', 'id')->onDelete('cascade');
            $table->double('totalCashAdvance');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cash_advance_totals');
    }
};
