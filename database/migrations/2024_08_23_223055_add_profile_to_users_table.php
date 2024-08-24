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
        Schema::table('users', function (Blueprint $table) {
            $table->string('lastname')->after('name');
            $table->string('rut')->nullable()->unique()->after('email');
            $table->string('phone')->nullable()->after('rut');
            $table->string('university')->nullable()->after('phone');
            $table->string('studies')->nullable()->after('studies');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'lastname',
                'rut',
                'phone',
                'university',
                'studies'
            ]);
        });
    }
};
