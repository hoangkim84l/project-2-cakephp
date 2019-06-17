<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ads', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('title_vn', 250);
            $table->string('title_en', 250);
            $table->string('title_cn', 250);
            $table->string('price');
            $table->string('dis_count');
            $table->text('slug')->nullable();
            $table->text('meta_key')->nullable();
            $table->text('meta_desc')->nullable();
            $table->string('image_link', 250);
            $table->text('content_vn')->nullable();
            $table->text('content_en')->nullable();
            $table->text('content_cn')->nullable();
            $table->integer('views');
            $table->string('area', 200)->nullable();
            $table->string('address', 200)->nullable();
            $table->string('typeId');
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
        Schema::dropIfExists('ads');
    }
}
