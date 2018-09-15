<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTitlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('titles', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('name');
            $table->string('cover_variant')->nullable();
            $table->string('special_issue')->nullable();
            $table->mediumInteger('yearmonth')->nullable();
            $table->smallInteger('month')->nullable();
            $table->smallInteger('year')->nullable();
            $table->string('front_cover_path')->nullable();
            $table->string('front_cover_name')->nullable();
            $table->text('front_cover_authors')->nullable();
            $table->string('back_cover_path')->nullable();
            $table->string('back_cover_name')->nullable();
            $table->text('back_cover_authors')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('titles');
    }
}
