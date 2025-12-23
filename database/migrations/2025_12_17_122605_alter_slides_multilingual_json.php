<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Wrap existing values into JSON
        DB::table('slides')->get()->each(function ($slide) {
            DB::table('slides')->where('id', $slide->id)->update([
                'title'    => json_encode(['en' => $slide->title]),
                'subtitle' => $slide->subtitle ? json_encode(['en' => $slide->subtitle]) : json_encode(['en' => '']),
            ]);
        });

        // Remove default values before type change
        DB::statement("ALTER TABLE slides ALTER COLUMN title DROP DEFAULT");
        DB::statement("ALTER TABLE slides ALTER COLUMN subtitle DROP DEFAULT");

        // Alter columns to JSON
        DB::statement("ALTER TABLE slides ALTER COLUMN title TYPE json USING title::json");
        DB::statement("ALTER TABLE slides ALTER COLUMN subtitle TYPE json USING subtitle::json");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE slides ALTER COLUMN title TYPE varchar USING title->>'en'");
        DB::statement("ALTER TABLE slides ALTER COLUMN subtitle TYPE varchar USING subtitle->>'en'");
    }
};
