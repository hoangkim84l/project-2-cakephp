<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('infoes', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('title_vn', 250);
            $table->string('title_en', 250)->nullable();
            $table->string('title_cn', 250)->nullable();
            $table->text('image_list')->nullable();
            $table->text('content_vn');
            $table->text('content_en')->nullable();
            $table->text('content_cn')->nullable();
            $table->text('meta_key')->nullable();
            $table->text('meta_desc')->nullable();
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
        Schema::dropIfExists('info');
    }
}
