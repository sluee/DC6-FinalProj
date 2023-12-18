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
        Schema::create('payroll_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('emp_id')->constrained('employees', 'id')->onDelete('cascade');
            $table->foreignId('payroll_id')->constrained('payrolls', 'id')->onDelete('cascade');
            $table->double('daysWorked');
            $table->double('overtimeHours')->nullable();
            $table->double('overtimeAmount')->nullable();
            $table->double('totalDeductions')->nullable();
            $table->double('totalBasicPay')->nullable();
            $table->double('netAmount');
            $table->double('grossAmount');
            $table->double('personalDeduction');
            $table->double('cashAdvance');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payroll_items');
    }
};
