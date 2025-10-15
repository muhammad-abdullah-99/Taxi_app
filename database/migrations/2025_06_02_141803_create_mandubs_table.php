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
        Schema::create('mandubs', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();               // الاسم
            $table->decimal('amount', 10, 2)->nullable();     // المبلغ
            $table->integer('count')->nullable();             // العدد
            $table->decimal('spent', 10, 2)->nullable();       // الصرف
            $table->string('code')->nullable();               // الكود
            $table->decimal('percentage', 10, 2)->nullable();   // النسبة
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mandubs');
    }
};
