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
        Schema::dropIfExists('inventories');

        Schema::create('inventories', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('movement');
            $table->bigInteger('current_quantity');
            $table->string('ship_url', 200);
            $table->foreign('ship_url')->references('url')->on('ships');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventories');
    }
};
