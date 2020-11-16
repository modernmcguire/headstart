<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use ModernMcGuire\Headstart\Enums\PageStatus;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->index();
            $table->string('slug')->index();

            $table->string('title');
            $table->unsignedBigInteger('author_id');
            $table->string('status')->default(PageStatus::Draft);
            $table->string('meta_description')->nullable();
            $table->datetime('published_at')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('author_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pages');
    }
}
