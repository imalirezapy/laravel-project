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
        Schema::create("profile-details", function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("user_id");
            $table->foreign("user_id")->references("id")->on("users");

            $table->unsignedBigInteger("factor_profile_id")->nullable();
            $table->foreign("factor_profile_id")->references("id")->on("factor-profile");

            $table->unsignedBigInteger("state_id");
            $table->foreign("state_id")->references("id")->on("states");

            $table->bigInteger("post", 20);

            $table->text("address");

            $table->string("delivery")->nullable();

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
        Schema::dropIfExists("profile-details");
    }
};
