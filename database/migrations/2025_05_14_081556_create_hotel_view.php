<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("create view hotels as SELECT id, link, name, location, rating, stars, unified_name, 'Google' AS source
FROM hotel_google
UNION ALL
SELECT id, link, name, location, rating, stars, unified_name, 'Ostrovok' AS source
FROM hotel_ostrovok
UNION all
SELECT id, link, name, location, rating, stars, unified_name, 'Yt' AS source
FROM hotel_yt;");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("drop view hotels");
    }
};
