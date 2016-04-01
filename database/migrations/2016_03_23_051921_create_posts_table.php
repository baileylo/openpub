<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('published_at')->nullable();
            $table->dateTime('updated_at')->nullable();
            $table->string('slug');
            $table->string('title');
            $table->text('description');
            $table->text('markdown');
            $table->text('html');
            $table->integer('user_id')->unsigned();

            $table->unique('slug');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('posts');
    }
}
