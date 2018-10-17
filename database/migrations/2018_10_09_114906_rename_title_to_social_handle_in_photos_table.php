<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameTitleToSocialHandleInPhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('photos', function (Blueprint $table) {
            $table->string('social_handle')->nullable();
        });

        DB::update('update photos set social_handle = title');

        Schema::table('photos', function (Blueprint $table) {
            $table->string('title')->nullable()->change();
            $table->string('social_handle')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::update('update photos set title = social_handle');

        Schema::table('photos', function (Blueprint $table) {
            $table->dropColumn('social_handle');
        });
    }
}
