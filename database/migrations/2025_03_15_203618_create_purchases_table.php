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
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->string('description'); // البيان
            $table->decimal('amount', 10, 2); // المبلغ
            $table->decimal('tax', 10, 2); // الضريبة
            $table->decimal('total', 10, 2); // الإجمالي
            $table->string('image')->nullable(); // المرفقات (اختياري)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchases');
    }
};
