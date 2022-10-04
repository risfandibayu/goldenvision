<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSendgoldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sendgolds', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('alamat_id');
            $table->integer('gold_id');
            $table->integer('qty');
            $table->integer('status');
            $table->string('no_resi');
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
        Schema::dropIfExists('sendgolds');
    }
}
