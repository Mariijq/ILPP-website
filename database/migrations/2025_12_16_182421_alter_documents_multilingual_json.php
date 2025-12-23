<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $columns = ['title', 'description'];

        foreach ($columns as $column) {

            // 1. Drop default to avoid cast error
            DB::statement("ALTER TABLE documents ALTER COLUMN {$column} DROP DEFAULT");

            // 2. Convert existing plain text to JSON
            DB::table('documents')->get()->each(function ($doc) use ($column) {
                $value = $doc->{$column};

                if ($value && !is_array(json_decode($value, true))) {
                    DB::table('documents')
                        ->where('id', $doc->id)
                        ->update([
                            $column => json_encode(['en' => $value])
                        ]);
                }
            });

            // 3. Change column type to jsonb
            DB::statement("
                ALTER TABLE documents
                ALTER COLUMN {$column}
                TYPE jsonb
                USING {$column}::jsonb
            ");
        }
    }

    public function down(): void
    {
        $columns = ['title', 'description'];

        foreach ($columns as $column) {
            DB::statement("
                ALTER TABLE documents
                ALTER COLUMN {$column}
                TYPE text
                USING {$column}::text
            ");
        }
    }
};
