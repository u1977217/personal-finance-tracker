<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->integer('year');
            $table->text('description')->nullable();
            $table->integer('pages')->nullable();

            $table->unsignedBigInteger('saver_id')->nullable();
            $table->foreign('saver_id')
                  ->references('id')
                  ->on('savers')
                  ->onDelete('set null');

            $table->unsignedBigInteger('genre_id')->nullable();
            $table->foreign('genre_id')
                  ->references('id')
                  ->on('genres')
                  ->onDelete('set null');

            $table->unsignedBigInteger('status_id')->nullable();
            $table->foreign('status_id')
                  ->references('id')
                  ->on('statuses')
                  ->onDelete('set null');

            // user_id for ownership
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            $table->dropForeign(['saver_id']);
            $table->dropForeign(['genre_id']);
            $table->dropForeign(['status_id']);
            $table->dropForeign(['user_id']);
        });

        Schema::dropIfExists('books');
    }
};
