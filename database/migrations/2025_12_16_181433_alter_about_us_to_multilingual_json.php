<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $columns = ['vision', 'mision', 'goals'];

        foreach ($columns as $column) {

            DB::table('about_us')->get()->each(function ($about) use ($column) {
                $value = $about->{$column};

                // Wrap old string values into { "en": "..." }
                if ($value && !is_array(json_decode($value, true))) {
                    DB::table('about_us')
                        ->where('id', $about->id)
                        ->update([
                            $column => json_encode(['en' => $value])
                        ]);
                }
            });

            DB::statement("
                ALTER TABLE about_us
                ALTER COLUMN {$column}
                TYPE jsonb
                USING {$column}::jsonb
            ");
        }
    }

    public function down(): void
    {
        $columns = ['vision', 'mision', 'goals'];

        foreach ($columns as $column) {
            DB::statement("
                ALTER TABLE about_us
                ALTER COLUMN {$column}
                TYPE text
                USING {$column}::text
            ");
        }
    }
};
