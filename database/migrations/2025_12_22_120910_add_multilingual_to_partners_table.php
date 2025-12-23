<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB; // make sure this is included

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('partners', function (Blueprint $table) {
            DB::statement("
                ALTER TABLE partners
                ALTER COLUMN name
                TYPE jsonb
                USING jsonb_build_object(
                    'en', name,
                    'mk', name,
                    'al', name
                );
            ");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('partners', function (Blueprint $table) {
            // optional: convert back to string if needed
        });
    }
};
