<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Check if the column exists using a raw query
        $columnExists = DB::select("SHOW COLUMNS FROM users LIKE 'remember_token'");

        if (empty($columnExists)) {
            Schema::table('users', function (Blueprint $table) {
                $table->rememberToken()->after('password');
            });
        }
    }

    public function down(): void
    {
        // Check if the column exists using a raw query
        $columnExists = DB::select("SHOW COLUMNS FROM users LIKE 'remember_token'");

        if (!empty($columnExists)) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('remember_token');
            });
        }
    }
};
