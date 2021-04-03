<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class IntroductionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('introductions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('team_id');
            $table->integer('accept_opponents')->default(0);
            $table->integer('accept_members')->default(0);
            $table->string('local')->nullable();
            $table->unsignedBigInteger('deputy')->nullable();
            $table->string('logo_pic')->nullable();
            $table->string('team_pic')->nullable();
            $table->text('coment')->nullable();
            $table->timestamps();
            
            $table->foreign('team_id')->references('id')->on('teams');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('introductions');
    }
}
