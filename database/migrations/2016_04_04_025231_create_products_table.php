<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->enum('category', ['beat', 'karaoke']);
            $table->string('name');
            $table->string('slug', 125)->unique();
            $table->text('description')->nullable();
            $table->decimal('price_usd', 10, 2);
            $table->decimal('price_vnd', 10, 0);
            $table->string('image')->nullable();
            $table->bigInteger('view')->default(0);
            $table->integer('rating')->default(0);
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
        Schema::drop('products');
    }
}
