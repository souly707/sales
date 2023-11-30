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
        Schema::create('treasuries_deliveries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('treasury_id')->constrained()->cascadeOnDelete(); // الخزنة التي سوف تستلم
            $table->unsignedBigInteger('treasury_can_delivery_id'); // الخزنة التي سيتم تسليمها
            $table->unsignedBigInteger('added_by');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('com_code');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('treasuries_deliveries');
    }
};
