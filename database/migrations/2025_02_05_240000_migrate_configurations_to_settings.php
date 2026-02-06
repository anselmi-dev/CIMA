<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Migra datos de configurations a settings y elimina la tabla configurations si existe.
     */
    public function up(): void
    {
        if (! Schema::hasTable('configurations')) {
            return;
        }

        $configurations = DB::table('configurations')->get();

        foreach ($configurations as $row) {
            DB::table('settings')->updateOrInsert(
                ['key' => $row->key],
                ['value' => $row->value]
            );
        }

        Schema::dropIfExists('configurations');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No se recrea configurations para evitar pérdida de datos en settings
    }
};
