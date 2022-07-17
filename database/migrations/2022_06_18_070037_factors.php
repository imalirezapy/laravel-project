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
        Schema::create("factors", function (Blueprint $table){
            $table->id();
            $table->unsignedBigInteger("user_id");
            $table->foreign("user_id")->references("id")->on("users");
            $table->unsignedBigInteger("profile_details_id")->nullable();
            $table->foreign("profile_details_id")->references("id")->on("profile_details");
            $table->integer('total')->nullable();
            $table->text("delivery")->nullable();
            $table->unsignedBigInteger("coupon_id")->nullable();
            $table->foreign("coupon_id")->references("id")->on("coupons");
            $table->text("gateway")->nullable();
            $table->bigInteger("final_total")->nullable();
            $table->boolean("complete")->default(false);
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
        Schema::dropIfExists("factors");
    }
};
