<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasColumn('comments', 'flag_reason')) {
            Schema::table('comments', function (Blueprint $table) {
                $table->text('flag_reason')->nullable()->after('status');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('comments', 'flag_reason')) {
            Schema::table('comments', function (Blueprint $table) {
                $table->dropColumn('flag_reason');
            });
        }
    }
};