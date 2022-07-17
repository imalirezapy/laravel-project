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
        Schema::create("factor-details", function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("factor_id");
            $table->foreign("factor_id")->references("id")->on("factors");

            $table->unsignedBigInteger("food_id");
            $table->foreign("food_id")->references("id")->on("foods");

            $table->integer("count");



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
        Schema::dropIfExists("factor-details");
    }
};
