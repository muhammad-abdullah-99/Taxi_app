<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('saved_cards', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('app_users')->cascadeOnDelete();
            $table->text('moyasar_token');
            $table->string('card_brand', 20);
            $table->string('last_four', 4);
            $table->string('exp_month', 2);
            $table->string('exp_year', 4);
            $table->string('card_holder_name');
            $table->boolean('is_default')->default(false);
            $table->boolean('is_active')->default(true);
            $table->string('fingerprint')->nullable();
            $table->timestamp('last_used_at')->nullable();
            $table->integer('usage_count')->default(0);
            $table->timestamps();
            $table->softDeletes();
            $table->index(['user_id', 'is_default']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('saved_cards');
    }
};
