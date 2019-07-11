<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banners', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('subtitle');
            $table->string('description')->nullable();
            $table->longText('content')->nullable();
            $table->longText('photo_url')->nullable();
            $table->string('button_text')->nullable();
            $table->longText('button_link')->nullable();
            $table->longText('video_link')->nullable();
            $table->string('position')->nullable();
            $table->string('type');
            $table->string('slug');
            $table->tinyInteger('status')->default(1);
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
        Schema::dropIfExists('banners');
    }
}
