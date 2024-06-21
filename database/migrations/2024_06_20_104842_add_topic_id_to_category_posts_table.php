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
        Schema::table('category_posts', function (Blueprint $table) {
            $table->foreignId('topic_id')->constrained('topics')->nullable()->after('category_id');
            $table->integer('comment_count')->default(0)->after('views');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('category_posts', function (Blueprint $table) {
            //
        });
    }
};
