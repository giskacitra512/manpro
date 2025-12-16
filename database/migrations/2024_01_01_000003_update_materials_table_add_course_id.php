<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('materials', function (Blueprint $table) {
            // Hapus kolom lama
            $table->dropColumn(['semester', 'mata_kuliah']);

            // Tambahkan foreign key ke courses
            $table->foreignId('course_id')->after('file_path')->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('materials', function (Blueprint $table) {
            $table->dropForeign(['course_id']);
            $table->dropColumn('course_id');

            // Kembalikan kolom lama
            $table->integer('semester')->after('file_path');
            $table->string('mata_kuliah')->after('semester');
        });
    }
};
