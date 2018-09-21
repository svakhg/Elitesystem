<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNameColumnToTowelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('towels', function(Blueprint $table){
            $table->string('name')->after('id')->default('Peshqir');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('towels', function(Blueprint $table){
            $table->dropColumn('name')->after('id')->default('Peshqir');
        });
    }
}
