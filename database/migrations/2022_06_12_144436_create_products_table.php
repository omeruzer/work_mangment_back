<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->string('img')->nullable()->default(null);
            $table->string('name');
            $table->decimal('price',20,2);
            $table->decimal('cors',20,2);
            $table->string('code');
            $table->integer('qty');
            // $table->string('sizes');
            $table->longText('content')->nullable()->default(null);
            // $table->integer('packQty');
            $table->bigInteger('category_id')->unsigned();
            $table->bigInteger('pattern_id')->unsigned();
            $table->bigInteger('material_id')->unsigned();
            $table->bigInteger('brand_id')->unsigned();
            $table->bigInteger('season_id')->unsigned();
            $table->timestamps();
            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('pattern_id')->references('id')->on('patterns')->onDelete('cascade');
            $table->foreign('material_id')->references('id')->on('materials')->onDelete('cascade');
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
            $table->foreign('season_id')->references('id')->on('seasons')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
