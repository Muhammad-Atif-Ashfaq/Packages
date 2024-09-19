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
        Schema::create('referral_packages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('min_amount');
            $table->string('max_amount')->nullable();
            $table->string('bonus_for_reaching_tier');
            $table->string('monthly_downline_return');
            $table->string('fixed_bonus_for_recruits_tier');
            $table->string('second_profit')->default(0);
            $table->string('third_profit')->default(0);
            $table->string('fourth_profit')->default(0);
            $table->string('fifth_profit')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('referral_packages');
    }
};