<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSocialusers2Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('socialusers2', function (Blueprint $table) {
              $table->id();
			  $table->string('username');
			  $table->string('email')->unique();
			  $table->string('phone');
			  $table->string('socialid');
			  $table->string('is_active');
			  $table->string('network');
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
        Schema::dropIfExists('socialusers2');
    }
}
