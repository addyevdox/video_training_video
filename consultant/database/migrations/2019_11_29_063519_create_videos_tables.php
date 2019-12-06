<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideosTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->unsignedInteger('user_id');
            $table->string('title');
            $table->text('description');
            $table->string('video')->nullable();
        });

        Schema::create('video_comments', function (Blueprint $table) {

            $table->increments('id');
            $table->timestamps();
            $table->unsignedInteger('user_id');
            $table->string('comment');
            $table->integer('video_id');
        });

        Schema::create('video_survey_questions', function (Blueprint $table) {

            $table->increments('id');
            $table->timestamps();
            $table->string('question');
            $table->integer('video_id');
        });

        Schema::create('video_survey_answers', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('comment');
            $table->integer('question_id');
        });

        Schema::create('survey_replys', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->unsignedInteger('user_id');
            $table->string('question');
            $table->string('answer');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('videos');
        Schema::drop('video_comments');
        Schema::drop('video_survey_questions');
        Schema::drop('video_survey_answers');
        Schema::drop('survey_replys');
    }
}
