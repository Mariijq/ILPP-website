<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $columns = ['title', 'short_description', 'detailed_description'];

        foreach ($columns as $column) {

            DB::table('projects')->get()->each(function ($project) use ($column) {
                $value = $project->{$column};

                // If value exists and is NOT valid JSON array/object
                if ($value && !is_array(json_decode($value, true))) {
                    DB::table('projects')
                        ->where('id', $project->id)
                        ->update([
                            $column => json_encode(['en' => $value])
                        ]);
                }
            });

            // Convert column to jsonb (PostgreSQL)
            DB::statement("
                ALTER TABLE projects
                ALTER COLUMN {$column}
                TYPE jsonb
                USING {$column}::jsonb
            ");
        }
    }

    public function down(): void
    {
        $columns = ['title', 'short_description', 'detailed_description'];

        foreach ($columns as $column) {
            DB::statement("
                ALTER TABLE projects
                ALTER COLUMN {$column}
                TYPE text
                USING {$column}::text
            ");
        }
    }
};
