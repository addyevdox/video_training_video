<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeleteSomeFieldsUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(array('bio', 'gender', 'dob', 'country', 'city'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('bio')->nullable();
            $table->string('gender')->nullable();
            $table->date('dob')->nullable();
            $table->string('country')->nullable();
            $table->string('city')->nullable();

        });
    }
}
