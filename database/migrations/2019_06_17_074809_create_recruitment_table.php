<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecruitmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recruitment', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->text('title_vn');
            $table->text('title_en')->nullable();
            $table->text('title_cn')->nullable();
            $table->text('image_link');
            $table->text('short_desc_vn');
            $table->text('short_desc_en')->nullable();
            $table->text('short_desc_cn')->nullable();
            $table->text('content_vn');
            $table->text('content_en')->nullable();
            $table->text('content_cn')->nullable();
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
        Schema::dropIfExists('recruitment');
    }
}
