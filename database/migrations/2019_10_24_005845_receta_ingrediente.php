<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RecetaIngrediente extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recipe_ingredient', function (Blueprint $table) {
            //
            $table->integer('recipe_id')->unsigned();

            $table->integer('ingredient_id')->unsigned();

            $table->foreign('recipe_id')->references('id')->on('recipes')
                ->onDelete('cascade');

            $table->foreign('ingredient_id')->references('id')->on('ingredients')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('recipes_ingredient', function (Blueprint $table) {
            //
        });
    }
}
