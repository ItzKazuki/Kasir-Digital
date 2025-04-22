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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->decimal('total_sales', 15, 2);
            $table->integer('total_transactions');
            $table->decimal('total_profit', 15, 2);
            $table->decimal('cash_sales', 15, 2);
            $table->decimal('other_sales', 15, 2);
            $table->decimal('expenses', 15, 2);
            $table->decimal('net_profit', 15, 2);
            $table->decimal('cash_before', 15, 2);
            $table->decimal('cash_after', 15, 2);
            $table->decimal('cash_difference', 15, 2);
            $table->string('created_by');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
