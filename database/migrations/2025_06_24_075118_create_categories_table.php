<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('categories', function (Blueprint $table) {
            // Cek dulu apakah kolom sudah ada sebelum menambahkannya
            if (!Schema::hasColumn('categories', 'name')) {
                $table->string('name')->after('id');
            }

            if (!Schema::hasColumn('categories', 'slug')) {
                $table->string('slug')->unique()->after('name');
            }

            if (!Schema::hasColumn('categories', 'image')) {
                $table->string('image')->nullable()->after('slug');
            }
        });
    }

    public function down()
    {
        Schema::table('categories', function (Blueprint $table) {
            // Hapus kolom jika migration di-rollback
            $table->dropColumn(['name', 'slug', 'image']);
        });
    }
};
