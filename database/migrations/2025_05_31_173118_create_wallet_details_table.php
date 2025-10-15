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
        Schema::create('wallet_details', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(); 
            $table->unsignedBigInteger('wallet_id')->nullable();
            $table->foreign('wallet_id')->references('id')->on('wallets')->onDelete('CASCADE');
            $table->decimal('amount', 10, 2)->nullable(); // الرصيد الحالي
            $table->string('details')->nullable(); // تفاصيل الشحن
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wallet_details');
    }
};
