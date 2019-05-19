<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShoppingcartTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {   
        /*
        Schema::create('shoppingcart', function (Blueprint $table) {
            $table->string('identifier', 255);
            $table->string('instance', 255);
            $table->longText('content');
            $table->nullableTimestamps();

            $table->primary(['identifier', 'instance']);
        });*/
    }
    /**
     * Reverse the migrations.
     */
    public function down()
    {
        //Schema::dropIfExists('shoppingcart');
    }
}
