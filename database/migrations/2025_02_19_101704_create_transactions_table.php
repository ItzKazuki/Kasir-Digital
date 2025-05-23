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
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade');
            $table->foreignId('member_id')->nullable()->constrained('members')->onDelete('set null');
            $table->decimal('total_price', 15)->default(0);
            $table->decimal('point_usage', 15)->default(0)->nullable();
            $table->decimal('cash', 15)->default(0);
            $table->decimal('cash_change', 15)->default(0);
            $table->enum('payment_method', ['cash', 'debit', 'credit', 'qris'])->default('cash');
            $table->enum('payment_status', ['paid', 'unpaid', 'pending'])->default('pending');
            // $table->timestamps();
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