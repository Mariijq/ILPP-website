<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        // TITLE
        DB::statement("
            ALTER TABLE publications
            ALTER COLUMN title DROP DEFAULT,
            ALTER COLUMN title TYPE jsonb
            USING jsonb_build_object('en', title)
        ");

        // SHORT DESCRIPTION
        DB::statement("
            ALTER TABLE publications
            ALTER COLUMN short_description TYPE jsonb
            USING jsonb_build_object('en', short_description)
        ");

        // DETAILED DESCRIPTION
        DB::statement("
            ALTER TABLE publications
            ALTER COLUMN detailed_description TYPE jsonb
            USING jsonb_build_object('en', detailed_description)
        ");
    }

    public function down(): void
    {
        DB::statement("
            ALTER TABLE publications
            ALTER COLUMN title TYPE varchar
            USING title->>'en'
        ");

        DB::statement("
            ALTER TABLE publications
            ALTER COLUMN short_description TYPE text
            USING short_description->>'en'
        ");

        DB::statement("
            ALTER TABLE publications
            ALTER COLUMN detailed_description TYPE text
            USING detailed_description->>'en'
        ");
    }
};
