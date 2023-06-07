<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMemberGrowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member_grows', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->integer('left');
            $table->integer('right');
            $table->integer('grow_l');
            $table->integer('grow_r');
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
        Schema::dropIfExists('member_grows');
    }
}
