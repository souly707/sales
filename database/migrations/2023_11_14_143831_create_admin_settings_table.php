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
        Schema::create('admin_settings', function (Blueprint $table) {
            $table->id();
            $table->string('system_name');
            $table->string('phone');
            $table->string('photo')->nullable();
            $table->string('address');
            $table->string('general_alert')->nullable();
            $table->string('added_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->unsignedTinyInteger('active')->default(1);
            $table->string('com_code');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_settings');
    }
};
