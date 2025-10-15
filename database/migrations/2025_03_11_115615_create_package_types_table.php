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
        Schema::create('package_types', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('type')->nullable();
            $table->integer('days')->nullable();   
            $table->decimal('cost', 10, 2)->nullable(); 
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
        
    }

  
    public function down(): void
    {
        Schema::dropIfExists('package_types');
    }
};
