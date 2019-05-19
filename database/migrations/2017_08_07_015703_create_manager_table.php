<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateManagerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('managers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email', 50)->unique();
            $table->string('phone', 20)->unique();
            $table->string('password');
            $table->string('avatar')->nullable();;
            $table->string('address')->nullable();;
            $table->timestamp('dateofbirth');
            $table->string('facebook')->nullable();
            $table->string('skype')->nullable();
            $table->enum('status', ['active','disable','pending']);
            $table->rememberToken();
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
        Schema::dropIfExists('managers');
    }
}
