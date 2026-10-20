<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration
{
    public function up(): void
    {
        Schema::table('concerts', function (Blueprint $table) {
            $table->unsignedInteger('position')->default(0)->index()->after('image');
        });

        /* Keep the current order (newest first) for concerts created before this column existed. */
        DB::table('concerts')
            ->orderByDesc('created_at')
            ->orderByDesc('id')
            ->pluck('id')
            ->each(fn (int $id, int $index) => DB::table('concerts')->where('id', $id)->update(['position' => $index + 1]));
    }

    public function down(): void
    {
        Schema::table('concerts', function (Blueprint $table) {
            $table->dropColumn('position');
        });
    }
};
