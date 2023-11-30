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
        Schema::create('treasuries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedTinyInteger('is_master')->defaultValue(0);
            $table->unsignedBigInteger('last_receipt_exchange');
            $table->unsignedBigInteger('last_receipt_collect');
            $table->unsignedBigInteger('added_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->date('date'); // For Search
            $table->unsignedBigInteger('com_code');
            $table->unsignedTinyInteger('active')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('treasuries');
    }
};
