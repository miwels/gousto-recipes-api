<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecipiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recipies', function(Blueprint $table) {
            $table->integer('id');
            $table->timestamps();
            $table->text('box_type');
            $table->text('title');
            $table->text('slug');
            $table->text('short_title')->nullable();
            $table->text('marketing_description')->default('0');
            $table->integer('calories_kcal')->default('0');
            $table->integer('protein_grams')->default('0');
            $table->integer('fat_grams')->default('0');
            $table->integer('carbs_grams')->default('0');
            $table->text('bulletpoint1')->nullable();
            $table->text('bulletpoint2')->nullable();
            $table->text('bulletpoint3')->nullable();
            $table->text('recipe_diet_type_id')->nullable();
            $table->text('season')->nullable();
            $table->text('base')->nullable();
            $table->text('protein_source')->nullable();
            $table->integer('preparation_time_minutes')->default('0');
            $table->text('shelf_life_days')->default('0');
            $table->text('equipment_needed')->nullable();
            $table->text('origin_country')->nullable();
            $table->text('recipe_cuisine')->nullable();
            $table->text('in_your_box')->nullable();
            $table->integer('gousto_reference')->default('0');
            $table->tinyInteger('rating')->default('1');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('recipies');
    }
}
