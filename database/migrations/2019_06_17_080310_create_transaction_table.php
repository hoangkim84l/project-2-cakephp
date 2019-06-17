<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('idnews', 200)->nullable();
            $table->string('status', 50)->nullable();
            $table->string('iduser', 50)->nullable();
            $table->string('user_email', 250)->nullable();
            $table->string('user_phone', 50)->nullable();
            $table->text('security')->nullable();
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
        Schema::dropIfExists('transaction');
    }
}
