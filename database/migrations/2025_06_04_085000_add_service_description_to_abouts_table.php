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
    Schema::table('abouts', function (Blueprint $table) {
        $table->text('service_description')->nullable()->after('service');
    });
}

public function down()
{
    Schema::table('abouts', function (Blueprint $table) {
        $table->dropColumn('service_description');
    });
}

};
