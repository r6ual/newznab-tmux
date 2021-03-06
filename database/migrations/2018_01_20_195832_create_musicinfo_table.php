<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMusicinfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('musicinfo', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
            $table->increments('id');
            $table->string('title');
            $table->string('asin', 128)->nullable()->unique('ix_musicinfo_asin');
            $table->string('url', 1000)->nullable();
            $table->integer('salesrank')->unsigned()->nullable();
            $table->string('artist')->nullable();
            $table->string('publisher')->nullable();
            $table->dateTime('releasedate')->nullable();
            $table->string('review', 3000)->nullable();
            $table->string('year', 4);
            $table->integer('genres_id')->nullable();
            $table->string('tracks', 3000)->nullable();
            $table->boolean('cover')->default(0);
            $table->timestamps();
        });
        DB::statement('ALTER TABLE musicinfo ADD FULLTEXT ix_musicinfo_artist_title_ft (artist, title)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('musicinfo');
    }
}
