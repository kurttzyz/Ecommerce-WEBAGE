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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            // Payment info
            $table->string('payment_method');
            $table->string('payment_status')->default('pending');
            $table->string('transaction_id')->nullable();
            $table->decimal('amount', 10, 2)->default(0.00);

            // Credit Card fields
            $table->string('card_number')->nullable();
            $table->string('expiry')->nullable();
            $table->string('cvc')->nullable();

            // PayPal
            $table->string('paypal_email')->nullable();

            // Bank Transfer
            $table->string('account_name')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('iban')->nullable();

            // GCash
            $table->string('gcash_name')->nullable();
            $table->string('gcash_number')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
