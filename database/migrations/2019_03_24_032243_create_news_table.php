<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title_vn', 250);
            $table->string('title_en', 250);
            $table->string('title_cn', 250);
            $table->text('slug')->nullable();
            $table->text('meta_key')->nullable();
            $table->text('meta_desc')->nullable();
            $table->string('image_link', 250);
            $table->text('content_vn')->nullable();
            $table->text('content_en')->nullable();
            $table->text('content_cn')->nullable();
            $table->integer('views');
            $table->text('bedrooms')->nullable();
            $table->text('bathrooms')->nullable();
            $table->text('garages')->nullable();
            $table->text('owns')->nullable();
            $table->string('status', 10)->nullable();
            $table->string('enddate', 30)->nullable();
            $table->text('viewtype')->nullable();
            $table->text('amenities')->nullable();
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
        Schema::dropIfExists('news');
    }
}
