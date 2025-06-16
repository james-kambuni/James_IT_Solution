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
    Schema::table('orders', function (Blueprint $table) {
        $table->string('fullname');
        $table->string('phone');
        $table->string('email')->nullable();
        $table->string('county');
        $table->string('region')->nullable();
        $table->text('order_notes')->nullable();
        $table->boolean('agreed_to_terms')->default(false);
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
