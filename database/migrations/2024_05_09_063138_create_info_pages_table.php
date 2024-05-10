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
        Schema::create('info_pages', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('img1')->nullable();
            $table->string('img_text1')->nullable();
            $table->string('heading1')->nullable();
            $table->text('section1')->nullable();
            $table->string('img2')->nullable();
            $table->string('img_text2')->nullable();
            $table->string('heading2')->nullable();
            $table->text('section2')->nullable();
            $table->string('img3')->nullable();
            $table->string('img_text3')->nullable();
            $table->string('heading3')->nullable();
            $table->text('section3')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('info_pages');
    }
};
