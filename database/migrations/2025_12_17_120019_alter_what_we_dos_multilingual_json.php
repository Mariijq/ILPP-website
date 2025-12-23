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
        $columns = ['title', 'leadership', 'research', 'public_policy'];

        // Remove default values for safety
        foreach ($columns as $column) {
            DB::statement("ALTER TABLE what_we_dos ALTER COLUMN {$column} DROP DEFAULT;");
        }

        // Wrap old string values into JSON
        DB::table('what_we_dos')->get()->each(function ($item) use ($columns) {
            foreach ($columns as $column) {
                $value = $item->{$column} ?? '';

                if (!is_array(json_decode($value, true))) {
                    DB::table('what_we_dos')->where('id', $item->id)->update([
                        $column => json_encode(['en' => $value]),
                    ]);
                }
            }
        });

        // Convert columns to jsonb type
        foreach ($columns as $column) {
            DB::statement("ALTER TABLE what_we_dos ALTER COLUMN {$column} TYPE jsonb USING {$column}::jsonb;");
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        foreach (['title', 'leadership', 'research', 'public_policy'] as $column) {
            DB::statement("
                ALTER TABLE what_we_dos 
                ALTER COLUMN {$column} TYPE text 
                USING ({$column} ->> 'en');
            ");
        }
    }
};
