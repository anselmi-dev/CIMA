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
        Schema::table('admin_bank_accounts', function (Blueprint $table) {
            $table->foreignId('bank_id')->after('bank_details')->constrained()->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('admin_bank_accounts', function (Blueprint $table) {
            $table->dropForeign(['bank_id']);
            $table->dropColumn('bank_id');
        });
    }
};
