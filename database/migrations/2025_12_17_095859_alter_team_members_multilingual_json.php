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
        // Drop default values first
        DB::statement('ALTER TABLE team_members ALTER COLUMN name DROP DEFAULT');
        DB::statement('ALTER TABLE team_members ALTER COLUMN position DROP DEFAULT');
        DB::statement('ALTER TABLE team_members ALTER COLUMN bio DROP DEFAULT');

        // Now cast columns to JSON
        DB::statement('ALTER TABLE team_members ALTER COLUMN name TYPE json USING name::json');
        DB::statement('ALTER TABLE team_members ALTER COLUMN position TYPE json USING position::json');
        DB::statement('ALTER TABLE team_members ALTER COLUMN bio TYPE json USING bio::json');
    
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('ALTER TABLE team_members ALTER COLUMN name TYPE varchar USING name::varchar');
        DB::statement('ALTER TABLE team_members ALTER COLUMN position TYPE varchar USING position::varchar');
        DB::statement('ALTER TABLE team_members ALTER COLUMN bio TYPE text USING bio::text');
    }
};
