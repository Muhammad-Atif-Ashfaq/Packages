<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('referral_package_id')->nullable()->constrained()->on('referral_packages')->onDelete('set null');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('role');
            $table->unsignedBigInteger('referred_by')->nullable()->index();
            $table->foreign('referred_by')->references('id')->on('users')->onDelete('set null');
            $table->string('total_investment')->default('0');
            $table->string('deposit_amount')->default('0');
            $table->string('monthly_profit')->default('0');
            $table->string('referral_profit')->default('0');
            $table->string('expected_referral_earning')->default('0');
            $table->string('total_profit')->default('0');
            $table->string('available_balance')->default('0');
            $table->string('total_withdrawals')->default('0');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
