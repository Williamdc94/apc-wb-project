<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::table('files', function (Blueprint $table) {
        $table->string('original_name')->nullable();
        $table->double('original_size')->default(0);
        $table->double('compressed_size')->default(0);
        $table->double('compression_ratio')->default(0);
        $table->string('compressed_path')->nullable();
    });
}

public function down()
{
    Schema::table('files', function (Blueprint $table) {
        $table->dropColumn(['original_name', 'original_size', 'compressed_size', 'compression_ratio', 'compressed_path']);
    });
}

};
