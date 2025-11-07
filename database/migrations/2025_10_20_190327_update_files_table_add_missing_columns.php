<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('files', function (Blueprint $table) {
            if (!Schema::hasColumn('files', 'user_id')) {
                $table->unsignedBigInteger('user_id')->after('id');
            }
            if (!Schema::hasColumn('files', 'file_name')) {
                $table->string('file_name')->after('user_id');
            }
            if (!Schema::hasColumn('files', 'file_path')) {
                $table->string('file_path')->after('file_name');
            }
            if (!Schema::hasColumn('files', 'file_size')) {
                $table->bigInteger('file_size')->nullable()->after('file_path');
            }
        });
    }

    public function down(): void
    {
        Schema::table('files', function (Blueprint $table) {
            $table->dropColumn(['user_id', 'file_name', 'file_path', 'file_size']);
        });
    }
};

