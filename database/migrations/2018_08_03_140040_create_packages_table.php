<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packages',function(Blueprint $table) {
            $table->increments('id');
            $table->integer('service_id');
            $table->integer('cycle_id');
            $table->integer('all_sessions');
            $table->integer('week_sessions');
            $table->integer('time');
            $table->string('price');
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
        Schema::dropTable('packages');
    }
}
