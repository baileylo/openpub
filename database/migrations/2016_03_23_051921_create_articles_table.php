<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->enum('type', ['page', 'post'])->default('page');
            $table->string('slug');
            $table->string('title');
            $table->text('description');
            $table->text('markdown');
            $table->text('html');
            $table->boolean('is_html')->default(true);
            $table->string('template');
            $table->dateTime('published_at')->nullable();
            $table->dateTime('updated_at')->nullable();

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
        Schema::drop('articles');
    }
}
