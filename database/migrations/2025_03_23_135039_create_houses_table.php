<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHousesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('houses', function (Blueprint $table) {
            $table->id();
            $table->string('street', 20);
            $table->string('ward', 20);
            $table->string('district', 20);
            $table->string('city', 20);
            $table->float('area');
            $table->float('price');
            $table->text('description');
            $table->string('type', 20);
            $table->integer('bedrooms');
            $table->integer('bathrooms');
            $table->text('image');
            $table->softDeletes();
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
        Schema::dropIfExists('houses');
    }
}
