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
        $columns = ['title', 'description'];

        foreach ($columns as $column) {

            // Step 1: Set null or non-JSON values to {"en": ""}
            DB::table('histories')->get()->each(function ($history) use ($column) {
                $value = $history->{$column};

                if (!$value) {
                    $value = '';
                }

                if (!is_array(json_decode($value, true))) {
                    DB::table('histories')
                        ->where('id', $history->id)
                        ->update([
                            $column => json_encode(['en' => $value])
                        ]);
                }
            });

            // Step 2: Remove default if exists
            DB::statement("ALTER TABLE histories ALTER COLUMN {$column} DROP DEFAULT");

            // Step 3: Alter column type safely
            DB::statement("
                ALTER TABLE histories
                ALTER COLUMN {$column}
                TYPE jsonb
                USING {$column}::jsonb
            ");
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $columns = ['title', 'description'];

        foreach ($columns as $column) {
            DB::statement("
                ALTER TABLE histories
                ALTER COLUMN {$column}
                TYPE text
                USING {$column}::text
            ");
        }
    }
};
