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
            $table->unsignedBigInteger('admin_id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('member_id');

            $table->date('purchase_date');
            $table->decimal('total_price');
            $table->string('detail');
            $table->decimal('total_keuntungan');

            $table->foreign('admin_id')->references('id')->on('admins');
            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('member_id')->references('id')->on('members');
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
