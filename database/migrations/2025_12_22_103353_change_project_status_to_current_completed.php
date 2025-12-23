<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    // 🔑 IMPORTANT for PostgreSQL ENUM
    public $withinTransaction = false;

    public function up(): void
    {
        // Add new enum values
        DB::statement("ALTER TYPE projects_status ADD VALUE IF NOT EXISTS 'Current'");
        DB::statement("ALTER TYPE projects_status ADD VALUE IF NOT EXISTS 'Completed'");

        // Now it's safe to use them
        DB::statement("UPDATE projects SET status = 'Current' WHERE status = 'Ongoing'");
        DB::statement("UPDATE projects SET status = 'Completed' WHERE status = 'Finished'");
    }

    public function down(): void
    {
        DB::statement("UPDATE projects SET status = 'Ongoing' WHERE status = 'Current'");
        DB::statement("UPDATE projects SET status = 'Finished' WHERE status = 'Completed'");
    }
};
