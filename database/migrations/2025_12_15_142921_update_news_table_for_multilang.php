<?php

use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // TITLE
        DB::statement('ALTER TABLE news ALTER COLUMN title DROP DEFAULT');
        DB::statement("
            ALTER TABLE news
            ALTER COLUMN title TYPE jsonb
            USING jsonb_build_object('en', title)
        ");

        // SUBTITLE
        DB::statement('ALTER TABLE news ALTER COLUMN subtitle DROP DEFAULT');
        DB::statement("
            ALTER TABLE news
            ALTER COLUMN subtitle TYPE jsonb
            USING CASE
                WHEN subtitle IS NULL THEN NULL
                ELSE jsonb_build_object('en', subtitle)
            END
        ");

        // SHORT DESCRIPTION
        DB::statement('ALTER TABLE news ALTER COLUMN short_description DROP DEFAULT');
        DB::statement("
            ALTER TABLE news
            ALTER COLUMN short_description TYPE jsonb
            USING CASE
                WHEN short_description IS NULL THEN NULL
                ELSE jsonb_build_object('en', short_description)
            END
        ");

        // DETAILED DESCRIPTION
        DB::statement('ALTER TABLE news ALTER COLUMN detailed_description DROP DEFAULT');
        DB::statement("
            ALTER TABLE news
            ALTER COLUMN detailed_description TYPE jsonb
            USING jsonb_build_object('en', detailed_description)
        ");

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("
            ALTER TABLE news
            ALTER COLUMN title TYPE varchar(255)
            USING title->>'en'
        ");

        DB::statement("
            ALTER TABLE news
            ALTER COLUMN subtitle TYPE varchar(255)
            USING subtitle->>'en'
        ");

        DB::statement("
            ALTER TABLE news
            ALTER COLUMN short_description TYPE varchar(500)
            USING short_description->>'en'
        ");

        DB::statement("
            ALTER TABLE news
            ALTER COLUMN detailed_description TYPE text
            USING detailed_description->>'en'
        ");
    }
};
