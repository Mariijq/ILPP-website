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
                $columns = ['title', 'subtitle', 'short_description', 'detailed_description'];

        foreach ($columns as $column) {
            DB::table('news')->get()->each(function ($news) use ($column) {
                $value = $news->{$column};

                // Only fix rows where the value is a string, not JSON
                if ($value && !is_array(json_decode($value, true))) {
                    DB::table('news')->where('id', $news->id)->update([
                        $column => json_encode(['en' => $value])
                    ]);
                }
            });

            // Alter column type to jsonb if using PostgreSQL
            DB::statement("ALTER TABLE news ALTER COLUMN {$column} TYPE jsonb USING {$column}::jsonb;");
        }

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
                $columns = ['title', 'subtitle', 'short_description', 'detailed_description'];
        foreach ($columns as $column) {
            DB::statement("ALTER TABLE news ALTER COLUMN {$column} TYPE text USING {$column}::text;");
        }

    }
};
