<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $columns = ['name', 'designation', 'review'];

        foreach ($columns as $column) {

            // 1. Drop default constraint (if any) to allow casting
            DB::statement("ALTER TABLE testimonials ALTER COLUMN {$column} DROP DEFAULT;");

            // 2. Wrap existing values into JSON safely
            DB::table('testimonials')->get()->each(function ($item) use ($column) {
                $value = $item->{$column} ?? '';
                if (! is_array(json_decode($value, true))) {
                    DB::table('testimonials')->where('id', $item->id)->update([
                        $column => json_encode(['en' => $value]),
                    ]);
                }
            });

            // 3. Alter column type to JSONB
            DB::statement("ALTER TABLE testimonials ALTER COLUMN {$column} TYPE jsonb USING {$column}::jsonb;");
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $columns = ['name', 'designation', 'review'];

        foreach ($columns as $column) {
            DB::statement("ALTER TABLE testimonials ALTER COLUMN {$column} TYPE text USING {$column}::text;");
        }
    }
};
