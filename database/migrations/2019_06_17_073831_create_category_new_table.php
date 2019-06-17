<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryNewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_new', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('title_vn', 250);
            $table->string('title_en', 250);
            $table->string('title_cn', 250);
            $table->string('sortororder');
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
        Schema::dropIfExists('category_new');
    }
}
