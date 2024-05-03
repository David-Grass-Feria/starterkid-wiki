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
        Schema::create('wikis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->index()->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('title');
            $table->string('slug');
            $table->text('description');
            $table->string('focus_keyword');
            $table->longText('content');
            $table->boolean('status')->default(true);
            
            //$table->string('title');
            //$table->string('color');
            //$table->string('range');
            //$table->string('country');
            //$table->longText('body');
            //$table->longText('about');
            //$table->boolean('active')->default(false);
            //$table->string('radio');
            //$table->date('date');
            //$table->dateTime('date_time');
            //$table->time('time');
            //$table->string('youtube_video_link');
            //$table->string('vimeo_video_link');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wikis');
    }
};