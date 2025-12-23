<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $columns = ['title', 'description'];

        foreach ($columns as $column) {

            // 1. Drop default if exists
            DB::statement("ALTER TABLE gallery_images ALTER COLUMN {$column} DROP DEFAULT");

            // 2. Convert existing values to JSON format
            DB::table('gallery_images')->get()->each(function ($image) use ($column) {
                $value = $image->{$column};

                if ($value && !is_array(json_decode($value, true))) {
                    DB::table('gallery_images')->where('id', $image->id)->update([
                        $column => json_encode(['en' => $value])
                    ]);
                }
            });

            // 3. Alter column type to jsonb
            DB::statement("ALTER TABLE gallery_images ALTER COLUMN {$column} TYPE jsonb USING {$column}::jsonb");
        }
    }

    public function down(): void
    {
        $columns = ['title', 'description'];

        foreach ($columns as $column) {
            DB::statement("ALTER TABLE gallery_images ALTER COLUMN {$column} TYPE text USING {$column}::text");
        }
    }
};
