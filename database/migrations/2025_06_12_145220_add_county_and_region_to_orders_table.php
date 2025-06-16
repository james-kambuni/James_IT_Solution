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
        Schema::table('orders', function (Blueprint $table) {
    $table->unsignedBigInteger('county_id')->nullable()->after('user_id');
    $table->unsignedBigInteger('region_id')->nullable()->after('county_id');

    $table->foreign('county_id')->references('id')->on('counties')->onDelete('set null');
    $table->foreign('region_id')->references('id')->on('regions')->onDelete('set null');
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            //
        });
    }
};
