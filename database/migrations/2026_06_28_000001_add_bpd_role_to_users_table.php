<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('admin', 'kepala_dusun', 'kepala_desa', 'bpd') DEFAULT 'kepala_desa'");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('admin', 'kepala_dusun', 'kepala_desa') DEFAULT 'kepala_desa'");
    }
};
