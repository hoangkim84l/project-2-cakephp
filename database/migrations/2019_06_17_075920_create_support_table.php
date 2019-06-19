<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supports', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name', 200)->nullable();
            $table->string('gmail', 200)->nullable();
            $table->string('skype', 200)->nullable();
            $table->string('phone', 200)->nullable();
            $table->string('hotline', 200)->nullable();
            $table->string('site_title', 200)->nullable();
            $table->text('meta_key')->nullable();
            $table->text('meta_desc')->nullable();
            $table->string('zalo', 200)->nullable();
            $table->string('facebook', 200)->nullable();
            $table->string('logo', 200)->nullable();
            $table->text('address')->nullable();
            $table->text('chat_zalo')->nullable();
            $table->text('chat_facebook')->nullable();
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
        Schema::dropIfExists('support');
    }
}
