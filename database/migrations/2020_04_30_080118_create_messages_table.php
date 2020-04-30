<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->unsigned()->default(0)->index('user_id');
            $table->string('currency_from', 3)->nullable()->index('currency_from');
            $table->string('currency_to', 3)->nullable()->index('currency_to');
            $table->double('amount_sell')->unsigned()->default(0);
            $table->double('amount_buy')->unsigned()->default(0);
            $table->double('rate')->unsigned()->default(0);
            $table->dateTime('time_placed');
            $table->string('originating_country', 2)->nullable()->index('originating_country');
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
        Schema::dropIfExists('messages');
    }
}
