<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscriptions',function(Blueprint $table){
            $table->increments('id');
            $table->integer('member_id');
            $table->integer('package_id');
            $table->string('payed_price');
            $table->date('starts_at');
            $table->date('expires_at');
            $table->integer('sessions_left');
            $table->string('status')->default('active');
            $table->integer('deleted')->default(0);
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
        Schema::dropTable('subscriptions');
    }
}
