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
    if (!Schema::hasTable('users')) {
    Schema::table('users', function (Blueprint $table) {
        $table->timestamp('name_verified_at')->nullable();
    });
}
}

public function down()
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn('name_verified_at');
    });
}
};
