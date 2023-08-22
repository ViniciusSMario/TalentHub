<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSoftDeleteToTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('vagas', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('candidatos', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('triagems', function (Blueprint $table) {
            $table->softDeletes();
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
            $table->dropSoftDeletes();
        });
        Schema::table('vagas', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('candidatos', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('triagems', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
}
